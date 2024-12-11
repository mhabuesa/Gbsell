<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageSaveTrait;
use App\Models\ProductMetaInfo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    use ImageSaveTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        return view('merchant.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        $attributes = Attribute::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        $colors = Color::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        return view('merchant.product.create', compact('categories', 'attributes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'condition' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'preview' => 'required|image',

        ]);


        $image = $this->saveImage('product/preview', $request->file('preview'), 260, 330);

        // Product Code Generation
        $product_code = 'PRD' . mt_rand(100000, 999999);
        $prd_count = Product::where('product_code', $product_code)->count();

        if ($prd_count > 0) {
            $product_code = $product_code . '-' . ($prd_count + 1);
        }

        // Slug Generation
        $slug = Str::slug($request->input('name'));
        $slugCount = Product::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = $slug . '-' . ($slugCount + 1);
        }

        // Status Check
        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }

        $product = Product::create([
            'shop_id' => Auth::guard('merchant')->user()->shop_id,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'current_price' => $request->current_price,
            'regular_price' => $request->regular_price,
            'product_code' => $product_code,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'warranty' => $request->warranty,
            'condition' => $request->condition,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'preview' => $image,
            'slug' => $slug,
            'status' => $status,
        ]);

        $gallery = $request->file('gallery');

        // Limit the number of images in the Gallery array
        $gallery = count($gallery) > 5 ? array_slice($gallery, 0, 5) : $gallery;

        foreach ($gallery as $image) {
            $gallery_image = $this->saveImage('product/gallery', $image, 260, 330);
            Gallery::create([
                'product_id' => $product->id,
                'image' => $gallery_image,
            ]);
        }

        // Attribute & Extra Price
        $attributes = $request->attribute_id;
        $color = $request->color_id;
        $current_price = $request->current_price;
        $regular_price = $request->regular_price;
        $quantity = $request->quantity;

        if($attributes){
            foreach ($attributes as $key => $value) {
                Variant::create([
                    'product_id' => $product->id,
                    'attribute_id' => $value,
                    'color_id' => $color[$key],
                    'current_price' => $current_price[$key],
                    'regular_price' => $regular_price[$key],
                    'quantity' => $quantity[$key],
                ]);
            }
        }

        if ($request->meta_title != '') {
            $keywords = $request->meta_keyword;

            // Initialize meta_keyword as an empty string
            $meta_keyword = '';

            // Concatenate all keywords into a single string
            if ($keywords) {
                foreach ($keywords as $value) {
                    $meta_keyword .= $value . ' '; // Concatenating the keyword with a space
                }
            }

            // Create ProductMetaInfo record
            ProductMetaInfo::create([
                'product_id' => $product->id,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => rtrim($meta_keyword) // Trim any trailing space
            ]);
        }




        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {


        $categories = Category::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        $attributes = Attribute::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        $colors = Color::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        $product = Product::where('slug', $slug)->first();
        return view('merchant.product.edit', compact('product','categories', 'attributes', 'colors'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'condition' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ]);

        $product = Product::find($id);
        $meta = ProductMetaInfo::where('product_id', $id)->first();

        if ($request->hasFile('preview')) {
            if (!empty($product->preview)) {
                $this->deleteImage(public_path($product->preview));
            }
            $product_preview = $this->saveImage('product/preview', $request->file('preview'), 260, 330);

            $product->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'brand' => $request->brand,
                'warranty' => $request->warranty,
                'condition' => $request->condition,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'preview' => $product_preview,
            ]);

        } else {
            $product->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'brand' => $request->brand,
                'warranty' => $request->warranty,
                'condition' => $request->condition,
                'short_description' => $request->short_description,
                'description' => $request->description,
            ]);
        }


        // Meta Update
        $keywords = $request->meta_keyword;

        // Initialize meta_keyword as an empty string
        $meta_keyword = '';

        // Concatenate all keywords into a single string
        if ($keywords) {
            foreach ($keywords as $value) {
                $meta_keyword .= $value . ' '; // Concatenating the keyword with a space
            }
        }

        if ($meta) {
            $meta->update([
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $meta_keyword,
            ]);
        } else {
            ProductMetaInfo::create([
                'product_id' => $product->id,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $meta_keyword,
            ]);
        }


        $gallery = $request->file('gallery');
        $gallery_check = Gallery::where('product_id', $id)->count(); // Already existing images

        if (!empty($gallery)) {
            $remaining_slots = 5 - $gallery_check; // How many more images can be uploaded

            // If no slots are available, redirect with an error
            if ($remaining_slots <= 0) {
                return redirect()->route('product.index')->with([
                    'success' => 'Product updated successfully.',
                    'error' => 'You can not upload more than 5 images.',
                ]);
            }

            // Limit the number of new images to the remaining slots
            $gallery = array_slice($gallery, 0, $remaining_slots);

            foreach ($gallery as $image) {
                $gallery_image = $this->saveImage('product/gallery', $image, 260, 330);
                Gallery::create([
                    'product_id' => $id,
                    'image' => $gallery_image,
                ]);
            }
        }


        return redirect()->route('product.index')->with('success', 'Product updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function status_update($id)
    {
        $product = Product::find($id);
        try {
            $product->update([
                'status' => $product->status == 0 ? 1 : 0,
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Product Status Updated Successfully'], 200);
    }

    public function deleteGallery(Request $request)
    {
        $gallery = Gallery::find($request->id);

        if ($gallery) {
            // Delete the image file from the storage (optional)
            if (file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }

            // Delete the record from the database
            $gallery->delete();

            // return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
            return response()->json(['success' => true, 'message' => 'Image deleted successfully'], 200);
        }

        return response()->json(['success' => false, 'message' => 'Image not found.']);
    }

    public function inventory($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $variants = Variant::where('product_id', $product->id)->get();
        $colors = Color::where('shop_id', $product->shop_id)->get();
        $attributes = Attribute::where('category_id', $product->category_id)->get();
        return view('merchant.product.inventory', compact('variants', 'product', 'colors', 'attributes'));
    }

    public function inventory_destroy($id)
    {
        $variant = Variant::find($id);
        $variant->delete();
        return response()->json(['success' => true, 'message' => 'Variant deleted successfully.']);
    }

    public function inventory_store(Request $request, $id)
    {
        // Attribute & Extra Price
        $attributes = $request->attribute_id;
        $colors = $request->color_id;
        $current_price = $request->current_price;
        $regular_price = $request->regular_price;
        $quantity = $request->quantity;
        $slug = Product::find($id)->slug;


        // Check if the variant exists, then update or create new variants
        foreach ($attributes as $key => $attribute) {
            $color = $colors[$key];
            $price_current = $current_price[$key];
            $price_regular = $regular_price[$key];
            $qty = $quantity[$key];

            // Check if variant exists
            if (Variant::where('product_id', $id)
                ->where('color_id', $color)
                ->where('attribute_id', $attribute)
                ->exists()) {

                // Increment the quantity if variant exists
                Variant::where('product_id', $id)
                    ->where('color_id', $color)
                    ->where('attribute_id', $attribute)
                    ->increment('quantity', $qty);

            } else {
                // Create a new variant if it doesn't exist
                Variant::create([
                    'product_id' => $id,
                    'attribute_id' => $attribute,
                    'color_id' => $color,
                    'current_price' => $price_current,
                    'regular_price' => $price_regular,
                    'quantity' => $qty,
                ]);
            }
        }

        return redirect()->route('product.inventory', $slug)->with('success', 'Inventory updated successfully.');
    }


    public function inventory_update(Request $request, $id)
    {
        $request->validate([
            'current_price' => 'required',
            'quantity' => 'required',
        ]);

        $variant = Variant::find($id);
        $slug = Product::find($variant->product_id)->slug;

        $variant->update([
            'attribute_id' => $request->attribute_id,
            'color_id' => $request->color_id,
            'current_price' => $request->current_price,
            'regular_price' => $request->regular_price,
            'quantity' => $request->quantity,
        ]);
        return redirect()->route('product.inventory', $slug)->with('success', 'Inventory updated successfully.');
    }
}
