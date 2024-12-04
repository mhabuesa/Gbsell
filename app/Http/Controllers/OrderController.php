<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Billing;
use App\Models\Variant;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\SmsConfig;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Events\InvoiceGenerated;
use Illuminate\Support\Facades\Cookie;
use App\Library\SslCommerz\SslCommerzNotification;

class OrderController extends Controller
{
    function order_store(Request $request, $shopUrl)
    {

        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'payment' => 'required',
        ]);

        $shop = Shop::where('url', $shopUrl)->first();
        $cartData = json_decode(Cookie::get('cart'), true);
        $data = $cartData[$shopUrl];


        if($request->delivery == 'interCity'){
            $charge = 100;
        }else{
            $charge = 150;
        }

        $order_id = '#cod'.uniqid().'_'. now()->format('dm');
        $subtotal = 0;

        foreach ($data as $value) {
             $after_subtotal = $value['quantity'] * $value['current_price'];
             $subtotal += $after_subtotal;
         }



        // if selected payment method is Cash On Delivery

        if($request->payment == 'cod'){
            $customer = Customer::firstOrCreate(
                [
                    'shop_id' => $shop->shop_id,
                    'phone' => $request->phone,
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                ]
            );

            Order::create([
                'shop_id' => $shop->shop_id,
                'order_id' => $order_id,
                'customer_id' => $customer->id,
                'subtotal' => $subtotal,
                'charge' => $charge,
                'total' => $charge + $subtotal,
                'payment_method' => 'cod',
            ]);

            foreach ($data as $order) {

                OrderProduct::create([
                    'shop_id' => $shop->shop_id,
                    'order_id' => $order_id,
                    'customer_id' => $customer->id,
                    'product_id' => $order['product_id'],
                    'attribute_id' => $order['attribute_id'],
                    'color_id' => $order['color_id'],
                    'quantity' => $order['quantity'],
                    'price' => $order['current_price'],
                ]);
            }

            if($request->ship_check == 'on'){

                $request->validate([
                    'ship_name' => 'required',
                    'ship_city' => 'required',
                    'ship_address' => 'required',
                    'ship_email' => 'required|email',
                    'ship_phone' => 'required',
                ]);

                Billing::create([
                    'shop_id' => $shop->shop_id,
                    'order_id' => $order_id,
                    'customer_id' => $customer->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'city' => $request->city,
                    'address' => $request->address,
                    'note' => $request->note,
                ]);

                Shipping::create([
                    'shop_id' => $shop->shop_id,
                    'order_id' => $order_id,
                    'ship_name' => $request->ship_name,
                    'ship_email' => $request->ship_email,
                    'ship_phone' => $request->ship_phone,
                    'ship_city' => $request->ship_city,
                    'ship_address' => $request->ship_address,
                ]);
            }else{

                Billing::create([
                    'shop_id' => $shop->shop_id,
                    'order_id' => $order_id,
                    'customer_id' => $customer->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'city' => $request->city,
                    'address' => $request->address,
                    'note' => $request->note,
                ]);

                Shipping::create([
                    'shop_id' => $shop->shop_id,
                    'order_id' => $order_id,
                    'ship_name' => $request->name,
                    'ship_email' => $request->email,
                    'ship_phone' => $request->phone,
                    'ship_city' => $request->city,
                    'ship_address' => $request->address,
                ]);

            }

            foreach ($data as $product) {
                Variant::where('product_id', $product['product_id'])
                ->where('attribute_id', $product['attribute_id'])
                ->where('color_id', $product['color_id'])
                ->decrement('quantity', $product['quantity']);
            }



            if (isset($cartData[$shopUrl])) {
                unset($cartData[$shopUrl]);
                Cookie::queue('cart', json_encode($cartData), 60 * 24 * 30);
            }


            $sslSmsApi = SmsConfig::where('shop_id', $shop->shop_id)
            ->where('status', 1)
            ->whereNotNull('api_key')
            ->whereNotNull('sender_id')
            ->first();

            if ($sslSmsApi) {
                $url = "http://bulksmsbd.net/api/smsapi";
                $api_key = "$sslSmsApi->api_key";
                $senderid = "$sslSmsApi->sender_id";
                $number = "$customer->phone";
                $message = "Thank you for your purchase at {$shop->name}!\n Your order {$order_id} has been successfully placed. We will notify you once your order is shipped.\n\n{$shop->name} Team";

                $data = [
                    "api_key" => $api_key,
                    "senderid" => $senderid,
                    "number" => $number,
                    "message" => $message
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                curl_close($ch);
            }


            event(new InvoiceGenerated($order_id));

            return redirect()->route('order.placed', $shopUrl)->with(['order_id' => $order_id, 'success' => 'Order Placed Successfully']);



        // if selected payment method is bkash
        }elseif($request->payment == 'bkash'){

            $customer = Customer::firstOrCreate(
                [
                    'shop_id' => $shop->shop_id,
                    'phone' => $request->phone,
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                ]
            );
            Order::create([
                'shop_id' => $shop->shop_id,
                'order_id' => $order_id,
                'customer_id' => $customer->id,
                'subtotal' => $subtotal,
                'charge' => $charge,
                'total' => $charge + $subtotal,
                'payment_method' => 'bkash',
            ]);

            foreach ($data as $order) {

                OrderProduct::create([
                    'shop_id' => $shop->shop_id,
                    'order_id' => $order_id,
                    'customer_id' => $customer->id,
                    'product_id' => $order['product_id'],
                    'attribute_id' => $order['attribute_id'],
                    'color_id' => $order['color_id'],
                    'quantity' => $order['quantity'],
                    'price' => $order['current_price'],
                ]);
            }

            if($request->shipCheck == 'on'){

                $request->validate([
                    'ship_name' => 'required',
                    'ship_city' => 'required',
                    'ship_address' => 'required',
                    'ship_email' => 'required|email',
                    'ship_phone' => 'required',
                ]);

                Billing::create([
                    'shop_id' => $shop->shop_id,
                    'order_id' => $order_id,
                    'customer_id' => $customer->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'city' => $request->city,
                    'address' => $request->address,
                    'note' => $request->note,
                ]);

                Shipping::create([
                    'shop_id' => $shop->shop_id,
                    'order_id' => $order_id,
                    'ship_name' => $request->ship_name,
                    'ship_email' => $request->ship_email,
                    'ship_phone' => $request->ship_phone,
                    'ship_city' => $request->ship_city,
                    'ship_address' => $request->ship_address,
                ]);
            }else{
                Billing::create([
                    'shop_id' => $shop->shop_id,
                    'order_id' => $order_id,
                    'customer_id' => $customer->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'city' => $request->city,
                    'address' => $request->address,
                    'note' => $request->note,
                ]);

                Shipping::create([
                    'shop_id' => $shop->shop_id,
                    'order_id' => $order_id,
                    'ship_name' => $request->name,
                    'ship_email' => $request->email,
                    'ship_phone' => $request->phone,
                    'ship_city' => $request->city,
                    'ship_address' => $request->address,
                ]);

            }

            if (isset($cartData[$shopUrl])) {
                unset($cartData[$shopUrl]);
                Cookie::queue('cart', json_encode($cartData), 60 * 24 * 30);
            }

        // if selected payment method is ssl
        }elseif($request->payment == 'ssl'){

            if($request->ship_check == 'on'){

                $request->validate([
                    'ship_name' => 'required',
                    'ship_city' => 'required',
                    'ship_address' => 'required',
                    'ship_email' => 'required|email',
                    'ship_phone' => 'required',
                ]);
            }


            $request = $request->all();
            return redirect()->route('sslpay',$shopUrl)->with([
                'data' => $data,
                'request' => $request,
            ]);

        }

    }

    function order_placed($shopUrl)
    {
        $order_id = session()->get('order_id');
        $cartData = json_decode(Cookie::get('cart'), true);

        if (isset($cartData[$shopUrl])) {
            unset($cartData[$shopUrl]);
        }

        if ($order_id === null) {
            $response = response()->redirectToRoute('home', $shopUrl);
        } else {
            $response = response()->view('frontend.shop.order_placed', [
                'order_id' => $order_id,
                'shopUrl' => $shopUrl,
            ]);
        }


        return $response->cookie('cart', json_encode($cartData), 60 * 24 * 30);
    }


}
