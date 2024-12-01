<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageSaveTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use ImageSaveTrait;
    public function index()
    {
        $shop_id = Auth::guard('merchant')->user()->shop_id;
        $categories = Category::where('shop_id', $shop_id)->get();
        return view('merchant.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('merchant.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);

        $exists = Category::where('shop_id', Auth::guard('merchant')->user()->shop_id)->where('name', $request->name)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Category Already Exists');
        }

        $image = $this->saveImage('category', $request->file('image'), 400, 400);

        // Slug Generation
        $slug = Str::slug($request->input('name'));
        $slugCount = Category::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = $slug . '-' . ($slugCount + 1);
        }

        Category::create([
            'shop_id' => Auth::guard('merchant')->user()->shop_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'slug' => $slug,
            'status' => 1,
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
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
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('merchant.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);

        if ($request->hasFile('image')) {
            $this->deleteImage(public_path($category->image));
            $image = $this->saveImage('category', $request->file('image'), 400, 400);

            Category::find($id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image,
            ]);
        } else {
            Category::find($id)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }

        return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $category = Category::find($id);
        if ($category->name == 'Uncategorized') {
            return response()->json(['success' => false, 'message' => 'Uncategorized Category Can\'t Be Deleted'], 200);
        }

        $uncategorized = Category::where('shop_id', Auth::guard('merchant')->user()->shop_id)->where('name', 'Uncategorized')->first();
        $product = Product::where('category_id', $id);
        if ($product) {
            $product->update([
                'category_id' => $uncategorized->id
            ]);
        }

        try {
            $this->deleteImage(public_path($category->image));
            $category->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Category Deleted Successfully'], 200);
    }

    public function status_update($id)
    {
        $category = Category::find($id);
        try {
            $category->update([
                'status' => $category->status == 0 ? 1 : 0,
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Category Status Updated Successfully'], 200);
    }
}
