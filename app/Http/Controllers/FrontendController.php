<?php

namespace App\Http\Controllers;

use App\Models\BannerImage;
use App\Models\BannerItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Variant;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function shop($shopUrl)
    {
        $shop = Shop::where('url', $shopUrl)->first();

        if (!$shop) {
            return response()->view('errors.404', ['message' => 'Shop not found'], 404);
        }

        $banner = BannerImage::where('shop_id', $shop->shop_id)->first();
        $bannerItems = BannerItem::where('shop_id', $shop->shop_id)->where('status', 1)->get();
        $products = Product::where('shop_id', $shop->shop_id)
        ->where('category_id', '!=', Category::where('status', 0)->pluck('id')->first())
        ->where('status', 1)
        ->get();


        return view('frontend.shop.index', [
            'shop' => $shop,
            'products' => $products,
            'banner' => $banner,
            'bannerItems' => $bannerItems
        ]);
    }

    public function category_product($shopUrl, $slug)
    {
        $shop = Shop::where('url', $shopUrl)->first();

        if (!$shop) {
            return response()->view('errors.404', ['message' => 'Shop not found'], 404);
        }

        $category = Category::where('shop_id', $shop->shop_id)->where('slug', $slug)->first();

        if (!$category) {
            return response()->view('errors.404', ['message' => 'Category not found'], 404);
        }
        $products = Product::where('category_id', $category->id)->where('status', 1)->paginate(10);

        return view('frontend.shop.category', [
            'shop' => $shop,
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function single_product($shopUrl, $slug)
    {
        $shop = Shop::where('url', $shopUrl)->first();

        if (!$shop) {
            return response()->view('errors.404', ['message' => 'Shop not found'], 404);
        }

        $product = Product::where('shop_id', $shop->shop_id)->where('slug', $slug)->first();

        if (!$product) {
            return response()->view('errors.404', ['message' => 'Product not found'], 404);
        }

        $variants = Variant::where('product_id', $product->id)
        ->groupBy('attribute_id')
        ->selectRaw('sum(attribute_id) as sum, attribute_id')
        ->get();

        // $colors = Variant::where('product_id', $product->id)
        //     ->groupBy('color_id')
        //     ->selectRaw('sum(color_id) as sum, color_id')
        //     ->get();

        $attribute = $product->variant->sortBy('current_price')->first();
        $colors = Variant::where('product_id', $product->id)->where('attribute_id', $attribute->attribute_id)->get();

        return view('frontend.shop.single_product', [
            'shop' => $shop,
            'product' => $product,
            'variants' => $variants,
            'colors' => $colors,
        ]);
    }
}