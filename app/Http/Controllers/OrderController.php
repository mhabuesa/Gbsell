<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Billing;
use App\Models\Variant;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\SmsConfig;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Events\InvoiceGenerated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\DeliverySystem;

class OrderController extends Controller
{
    function order_store(Request $request, $shopUrl)
    {

        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^(?:\+8801|01)[3-9]\d{8}$/'],
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

        $order_id = 'cod'. random_int(10000, 99999) .now()->format('dm');
        $subtotal = 0;

        foreach ($data as $value) {
             $after_subtotal = $value['quantity'] * $value['current_price'];
             $subtotal += $after_subtotal;
         }


         // Get the input phone number
         $phone = $request->input('phone');

         // Check if the phone number starts with +88
         if (str_starts_with($phone, '+88')) {
             $phone = substr($phone, 3); // Remove +88 from the phone number
         }


        // if selected payment method is Cash On Delivery
        if($request->payment == 'cod'){
            $customer = Customer::firstOrCreate(
                [
                    'phone' => $phone,
                ],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                ]
            );

            $total = $subtotal + $charge - $request->discount;

            Order::create([
                'shop_id' => $shop->shop_id,
                'order_id' => $order_id,
                'customer_id' => $customer->id,
                'subtotal' => $subtotal,
                'charge' => $charge,
                'coupon_code' => $request->coupon_code,
                'discount' => $request->discount,
                'total' => $total,
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
                $message = "Your order {$order_id} has been successfully placed. We will notify you once your order is shipped.\n\n{$shop->name} Team";

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

            $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();

            if ($coupon) {
                $coupon->quantity = $coupon->quantity - 1;
                $coupon->save();
            }

            Session::forget(['min_amount', 'discount_type', 'discount', 'coupon_code']);

            event(new InvoiceGenerated($order_id));

            return redirect()->route('order.placed', $shopUrl)->with(['order_id' => $order_id, 'success' => 'Order Placed Successfully']);



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


    // Customer Order Controller
    public function index(){
        if (!in_array(Auth::guard('merchant')->user()->permission, ['1', '2', '3'])) {
            return redirect()->route('accessDeny');
        }

        $merchant = Auth::guard('merchant')->user();
        $orders = Order::where('shop_id', $merchant->shop_id)->whereIn('status', ['pending', 'processing'])->latest()->get();
        return view('merchant.order.index', compact('orders'));
    }
    public function deliver(){
        if (!in_array(Auth::guard('merchant')->user()->permission, ['1', '2', '3'])) {
            return redirect()->route('accessDeny');
        }
        $merchant = Auth::guard('merchant')->user();
        $orders = Order::where('shop_id', $merchant->shop_id)->where('delivery_status', 'sended')->where('status', 'delivering')->latest()->get();
        return view('merchant.order.deliver', compact('orders'));
    }
    public function complate(){
        if (!in_array(Auth::guard('merchant')->user()->permission, ['1', '2', '3'])) {
            return redirect()->route('accessDeny');
        }
        $merchant = Auth::guard('merchant')->user();
        $orders = Order::where('shop_id', $merchant->shop_id)->where('status', 'delivered')->latest()->get();
        return view('merchant.order.complate', compact('orders'));
    }

    public function cancel(){
        if (!in_array(Auth::guard('merchant')->user()->permission, ['1', '2', '3'])) {
            return redirect()->route('accessDeny');
        }
        $merchant = Auth::guard('merchant')->user();
        $orders = Order::where('shop_id', $merchant->shop_id)->whereIn('status', ['cancelled', 'cancel'])->latest()->get();
        return view('merchant.order.cancel', compact('orders'));
    }
    public function details($order_id){
        if (!in_array(Auth::guard('merchant')->user()->permission, ['1', '2', '3'])) {
            return redirect()->route('accessDeny');
        }
        $merchant = Auth::guard('merchant')->user();
        $products = OrderProduct::where('order_id', $order_id)->get();
        $shop = Shop::where('shop_id', $merchant->shop_id)->first();
        $order = Order::where('order_id', $order_id)->first();
        $redx = DeliverySystem::where('shop_id', $shop->shop_id)->where('method', 'redx')->where('status', '1')->first();
        $steadfast = DeliverySystem::where('shop_id', $shop->shop_id)->where('method', 'steadfast')->where('status', '1')->first();
        $pathao = DeliverySystem::where('shop_id', $shop->shop_id)->where('method', 'pathao')->where('status', '1')->first();
        return view('merchant.order.details', [
            'products' => $products,
            'order_id' => $order_id,
            'shopUrl' => $shop->url,
            'order' => $order,
            'redx' => $redx,
            'steadfast' => $steadfast,
            'pathao' => $pathao,
        ]);
    }

    function order_status_update(Request $request, $id)
    {
        if ($request->status == 'pending') {
            Order::find($id)->update([
                'status' => 'pending',
            ]);
        }elseif ($request->status == 'processing') {
            Order::find($id)->update([
                'status' => 'processing',
            ]);
        }elseif ($request->status == 'delivered') {
            Order::find($id)->update([
                'status' => 'delivered',
            ]);
        }elseif ($request->status == 'cancel') {
            Order::find($id)->update([
                'status' => 'cancel',
            ]);
        }
        return redirect()->back()->with('success', 'Order Status Updated Successfully!');
    }


}
