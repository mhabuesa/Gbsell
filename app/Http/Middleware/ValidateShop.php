<?php

namespace App\Http\Middleware;

use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateShop
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the shopUrl from route parameter
        $shopUrl = $request->route('shopUrl');

        // Validate the shop based on shopUrl
        $shop = Shop::where('url', $shopUrl)->first();

        if (!$shop) {
            return response()->view('errors.404', ['message' => 'Shop not found'], 404);
        }

        // Share the shop_id and shop_url globally
        view()->share('shop_id', $shop->shop_id);
        view()->share('shop_url', $shop->url);

        // Add shop_id and shop_url to the request
        $request->merge(['shop_id' => $shop->shop_id, 'shop_url' => $shop->url]);

        return $next($request);
    }
}
