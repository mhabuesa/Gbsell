<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Upazila;
use App\Models\Variant;
use App\Models\District;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function checkout($shopUrl, $coupon_code = null)
    {
        $shop = Shop::where('url', $shopUrl)->first();

        if (!$shop) {
            return redirect()->route('home')->with('error', 'Shop not found.');
        }

        $coupon_code = $coupon_code ?: ''; // Blank manage
        
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

        $discount = 0;
        $coupon = Coupon::where('coupon_code', $coupon_code)->where('shop_id', $shop->shop_id)->where('status', 1)->where('expire_date', '>=', date('Y-m-d'))->where('quantity', '>', '0')->first();
        if ($coupon) {
            if($coupon->discount_type == 'percentage') {
                $discount = $totalPrice * ($coupon->discount / 100);
            }else{
                $discount = $coupon->discount;
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
            'discount' => $discount,
            'coupon_code' => $coupon_code,
        ]);
    }


}
