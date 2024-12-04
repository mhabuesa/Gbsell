<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Color;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Attribute;
use App\Models\District;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use App\Models\Upazila;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function checkout($shopUrl)
    {

        $shop = Shop::where('url', $shopUrl)->first();

        if (!$shop) {
            return redirect()->route('home')->with('error', 'Shop not found.');
        }

        $cartData = json_decode(Cookie::get('cart'), true);

        if (!$cartData || !isset($cartData[$shopUrl])) {
            return redirect()->route('home', $shopUrl)->with('error', 'Your Cart is empty. Please add items to your cart.');
        }

        $data = $cartData[$shopUrl];

        foreach ($data as &$item) {
            $product = Product::find($item['product_id']); // Fetch product by ID
            $attribute = Attribute::find($item['attribute_id'])->name; // Fetch attribute by ID
            $color = Color::find($item['color_id'])->name; // Fetch color by ID
            $item['product_name'] = $product->name ;
            $item['preview'] = $product->preview ;
            $item['attribute'] = $attribute ;
            $item['color'] = $color ;
        }

        // Initialize total variables
        $totalProducts = 0;
        $totalPrice = 0;

        // Iterate over cart items to calculate total products and price
        foreach ($data as $value) {
            $variant = Variant::where('product_id', $value['product_id'])
                      ->where('attribute_id', $value['attribute_id'])
                      ->where('color_id', $value['color_id'])
                      ->first();
            if ($variant) {
                $totalProducts += 1; // Sum quantity for total products
                $totalPrice += $variant->current_price * $value['quantity']; // Calculate total price
            }
        }


        $hasSslPayment = PaymentGateway::where('shop_id', $shop->shop_id)
        ->where('method', 'ssl')
        ->where('status', 1)
        ->whereNotNull('store_id')
        ->whereNotNull('store_password')
        ->exists();

        $hasBkashPayment = PaymentGateway::where('shop_id', $shop->shop_id)
        ->where('method', 'bkash')
        ->where('status', 1)
        ->whereNotNull('store_id')
        ->whereNotNull('store_password')
        ->exists();
        $codMessage = PaymentGateway::where('shop_id', $shop->shop_id)->where('method', 'cod')->first();
        $cities = District::all();

        return view('frontend.shop.checkout',[
            'shop' => $shop,
            'data' => $data,
            'totalPrice' => $totalPrice,
            'hasSslPayment' => $hasSslPayment,
            'hasBkashPayment' => $hasBkashPayment,
            'codMessage' => $codMessage,
            'cities' => $cities,
        ]);
    }

    
}
