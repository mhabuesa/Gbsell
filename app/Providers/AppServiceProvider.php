<?php

namespace App\Providers;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\AdminInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Middleware\ValidateShop;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\MerchantMiddleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::aliasMiddleware('merchant', MerchantMiddleware::class);
        Route::aliasMiddleware('ValidateShop', ValidateShop::class);

        // Globally data share for header file
        View::composer('layouts.frontend', function ($view) {
            //Get shop url to first segment of url
            $shopUrl = request()->segment(1);

            // Retrieve shop data from database
            $shop = Shop::where('url', $shopUrl)->first();

            //Fetch category data
            $categories = Cache::remember('shop_categories_' . $shop->id, 600, function () use ($shop) {
                return Category::where('shop_id', $shop->shop_id)->where('status', '1')->get();
            });



            // Cart data fetch
            $cartData = Cookie::get('cart') ? json_decode(Cookie::get('cart'), true) : null;

            // Check if cart data exists for the shop
            $data = isset($cartData[$shopUrl]) ? $cartData[$shopUrl] : [];

            // Initialize total variables
            $totalProducts = 0;
            $totalPrice = 0;

            // Iterate over cart items to calculate total products and price
            foreach ($data as $item) {
                $product = Product::find($item['product_id']);
                $variant = Variant::where('product_id', $item['product_id'])
                    ->where('attribute_id', $item['attribute_id'])
                    ->where('color_id', $item['color_id'])
                    ->first();
                if ($product) {
                    $totalProducts += 1; // Sum quantity for total products
                    $totalPrice += $variant->current_price * $item['quantity']; // Calculate total price
                }
            }


            // Pass the data to the view
            $view->with([
                'categories' => $categories,
                'shop' => $shop,
                'totalProducts' => $totalProducts,
                'totalPrice' => $totalPrice
            ]);
        });

        View::composer('frontend.home.app', function ($view) {

            $info = AdminInfo::first();
            $view->with([
                'info' => $info
            ]);
        });

        View::composer('layouts.backend', function ($view) {

            $info = AdminInfo::first();
            $view->with([
                'info' => $info
            ]);
        });

        View::composer('merchant.layout.app', function ($view) {

            // Merchant Notification Queries for Orders and Reviews
            $merchant = Auth::guard('merchant')->user();
            $shopId = $merchant->shop_id;

            $orderQuery = Order::where('shop_id', $shopId)
                ->where('status', 'pending')
                ->where('notify', '0')
                ->select('id', 'created_at', DB::raw("'order' as type"))
                ->latest();

            $reviewQuery = Review::where('shop_id', $shopId)
                ->where('notify', '0')
                ->select('id', 'created_at', DB::raw("'review' as type"))
                ->latest();

            $combinedData = $orderQuery->unionAll($reviewQuery)
                ->orderBy('created_at', 'desc')
                ->get();

            // Passing the combined data to the view
            $view->with([
                'combinedData' => $combinedData
            ]);
        });


        Paginator::useBootstrap();
    }
}
