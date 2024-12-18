<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\BannerItem;
use App\Models\BannerImage;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class FrontendController extends Controller
{
    public function index()
    {
        $bestSellers = Order::with('shop')
            ->select('shop_id', DB::raw('COUNT(*) as total_delivered_orders'))
            ->where('status', 'delivered')
            ->groupBy('shop_id')
            ->orderByDesc('total_delivered_orders')
            ->take(4)
            ->get();
        $shops = Shop::where('status', 1)->latest()->get();
        $products = Product::where('status', 1)->latest()->paginate(18);

        return view('frontend.home.index', [
            'bestSellers' => $bestSellers,
            'shops' => $shops,
            'products' => $products,
        ]);
    }

    public function searchAll(Request $request)
    {
        $search = $request->input('q');
        $products = Product::where('status', 1)->where('name', 'like', '%' . $search . '%')->paginate(18);
        $shops = Shop::where('status', 1)->where('name', 'like', '%' . $search . '%')->latest()->get();
        $recent_products = Product::where('status', 1)->latest()->take(10)->get();
        return view('frontend.home.search', [
            'products' => $products,
            'shops' => $shops,
            'recent_products' => $recent_products
        ]);
    }

    public function order_track(Request $request){
        $data = Order::where('order_id', $request->order_id)->first();
        return view('frontend.home.track', [
            'data' => $data
        ]);
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
            ->latest()
            ->paginate(18);

        $topRatedProducts = Product::select('products.*', DB::raw('AVG(reviews.rating) as avg_rating'))
            ->join('reviews', 'products.id', '=', 'reviews.product_id')
            ->whereIn('products.id', $products->pluck('id'))
            ->groupBy('products.id')
            ->orderByDesc('avg_rating')
            ->take(5)
            ->get();

        $topSellingProducts = OrderProduct::select('product_id', DB::raw('SUM(quantity) as sold'))
            ->groupBy('product_id')
            ->where('shop_id', $shop->shop_id)
            ->orderBy('sold', 'desc')
            ->take(5)
            ->get();

        $recent = json_decode(Cookie::get('recent'), true) ?? [];

        // Check if $recent is empty
        if (!empty($recent)) {
            // Extract product IDs
            $productIds = array_column($recent, 'product_id');

            // Filter products based on shop_id
            $recentProducts = Product::whereIn('id', $productIds)
                ->where('shop_id', $shop->shop_id) // Match shop_id
                ->orderByRaw('FIELD(id, ' . implode(',', $productIds) . ')') // Maintain order
                ->get();
        } else {
            // Handle case where recent is empty (optional)
            $recentProducts = collect(); // Empty collection
        }


        return view('frontend.shop.index', [
            'shop' => $shop,
            'products' => $products,
            'banner' => $banner,
            'bannerItems' => $bannerItems,
            'topRatedProducts' => $topRatedProducts,
            'topSellingProducts' => $topSellingProducts,
            'recentProducts' => $recentProducts
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

        $recent_products = Product::where('shop_id', $shop->shop_id)->where('status', 1)->orderBy('id', 'desc')->take(10)->get();

        return view('frontend.shop.category', [
            'shop' => $shop,
            'category' => $category,
            'products' => $products,
            'recent_products' => $recent_products,
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

        $recent = json_decode(Cookie::get('recent'), true) ?? [];
        $recent = array_filter($recent, fn($item) => $item['product_id'] != $product->id || $item['shop_id'] != $product->shop_id);
        array_unshift($recent, ['product_id' => $product->id, 'shop_id' => $product->shop_id]);
        $recent = array_slice($recent, 0, 5);
        Cookie::queue('recent', json_encode($recent), 43200); // 30 days



        $variants = Variant::where('product_id', $product->id)
            ->groupBy('attribute_id')
            ->selectRaw('sum(attribute_id) as sum, attribute_id')
            ->get();

        $attribute = $product->variant->sortBy('current_price')->first();
        $colors = Variant::where('product_id', $product->id)->where('attribute_id', $attribute->attribute_id)->get();

        $reviews = Review::where('product_id', $product->id)->where('status', 1)->get();
        $ratingsCount = Review::where('product_id', $product->id)
            ->where('status', 1)
            ->selectRaw('
                SUM(rating = 5) as fiveStarReviews,
                SUM(rating = 4) as fourStarReviews,
                SUM(rating = 3) as threeStarReviews,
                SUM(rating = 2) as twoStarReviews,
                SUM(rating = 1) as oneStarReviews,
                COUNT(*) as totalReviews
            ')
            ->first();

        $averageRating = $ratingsCount->totalReviews > 0 ? (
            ($ratingsCount->fiveStarReviews * 5 +
                $ratingsCount->fourStarReviews * 4 +
                $ratingsCount->threeStarReviews * 3 +
                $ratingsCount->twoStarReviews * 2 +
                $ratingsCount->oneStarReviews) /
            $ratingsCount->totalReviews
        ) : 0;

        $ratingOutOf10 = ($averageRating / 5) * 10;
        $ratingOutOf5 = ($averageRating / 5) * 5;


        $reletedProducts = Product::where('category_id', $product->category_id)->where('status', 1)->latest()->take(6)->get();


        return view('frontend.shop.single_product', [
            'shop' => $shop,
            'product' => $product,
            'variants' => $variants,
            'colors' => $colors,
            'reviews' => $reviews,
            'ratingsCount' => $ratingsCount,
            'ratingOutOf10' => $ratingOutOf10,
            'ratingOutOf5' => $ratingOutOf5,
            'reletedProducts' => $reletedProducts,
        ]);
    }

    public function track(Request $request, $shopUrl)
    {
        $data = Order::where('order_id', $request->order_id)->first();
        $shop = Shop::where('url', $shopUrl)->first();
        if (!$shop) {
            return response()->view('errors.404', ['message' => 'Shop not found'], 404);
        }
        return view('frontend.shop.track_order', [
            'shop' => $shop,
            'data' => $data
        ]);
    }

    function search(Request $request)
    {

        $shop = Shop::where('url', $request->shopUrl)->first();
        $search = $request->q;
        $products = Product::where('shop_id', $shop->shop_id)
            ->where('name', 'like', '%' . $search . '%')
            ->where('status', 1)
            ->paginate(10);
        $recent_products = Product::where('shop_id', $shop->shop_id)->where('status', 1)->orderBy('id', 'desc')->take(10)->get();
        return view('frontend.shop.search', [
            'shop' => $shop,
            'products' => $products,
            'recent_products' => $recent_products
        ]);
    }
}
