<?php

namespace App\Providers;

use App\Models\Shop;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Middleware\ValidateShop;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\MerchantMiddleware;
use App\Models\Product;
use App\Models\Variant;

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
        // URL er first segment theke shop URL ber koro
        $shopUrl = request()->segment(1);

        // Shop er information retrieve koro
        $shop = Shop::where('url', $shopUrl)->first();

        // Shop er categories fetch koro
        $categories = $shop ? Category::where('shop_id', $shop->shop_id)->where('status', '1')->get() : collect();


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
    Paginator::useBootstrap();


    }
}
