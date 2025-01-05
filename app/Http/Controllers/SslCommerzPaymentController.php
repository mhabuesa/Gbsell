<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Billing;
use App\Models\Variant;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\SslOrder;
use App\Models\SmsConfig;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Events\InvoiceGenerated;
use App\Models\CartVariantProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request, $shopUrl)
    {
        $data = session('data');
        $requestData = session('request');

        if ($requestData['delivery'] == 'interCity') {
            $charge = 100;
        } else {
            $charge = 150;
        }

        $ship_check = '';
        if (empty($requestData['ship_check'])) {
            $ship_check = 0;
        } else {
            $ship_check = 1;
        }

        $order_id = 'ssl' . random_int(10000, 99999) . now()->format('dm');
        $subtotal = 0;

        foreach ($data as $value) {
            $after_subtotal = $value['quantity'] * $value['current_price'];
            $subtotal += $after_subtotal;
        }


        foreach ($data as $order) {

            CartVariantProduct::create([
                'shop_id' => $requestData['shop_id'],
                'order_id' => $order_id,
                'product_id' => $order['product_id'],
                'attribute_id' => $order['attribute_id'],
                'color_id' => $order['color_id'],
                'quantity' => $order['quantity'],
                'price' => $order['current_price'],
            ]);
        }

        $post_data = [
            // CUSTOMER INFORMATION
            'cus_name' => $requestData['name'],
            'cus_email' => $requestData['email'],
            'cus_add1' => $requestData['address'],
            'cus_add2' => '',
            'cus_city' => $requestData['city'],
            'cus_state' => '',
            'cus_postcode' => '',
            'cus_country' => 'Bangladesh',
            'cus_phone' => $requestData['phone'],
            'cus_fax' => '',
            'total_amount' => $charge + $subtotal - $requestData['discount'],
            'tran_id' => uniqid(),

            // SHIPMENT INFORMATION
            'ship_name' => $requestData['ship_name'],
            'ship_add1' => $requestData['ship_address'],
            'ship_add2' => '',
            'ship_city' => $requestData['ship_city'],
            'ship_state' => '',
            'ship_postcode' => '1217',
            'ship_phone' => $requestData['ship_phone'],
            'ship_country' => '',

            // Additional Information
            'shipping_method' => 'NO',
            'product_name' => 'computer',
            'product_category' => 'good',
            'product_profile' => 'Healthy Food',
            'currency' => 'BDT',

        ];


        SslOrder::where('transaction_id', $post_data['tran_id'])->updateOrInsert([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'phone' => $requestData['phone'],
            'amount' => $charge + $subtotal,
            'coupon_code' => $requestData['coupon_code'],
            'discount' => $requestData['discount'],
            'address' => $requestData['address'],
            'transaction_id' => $post_data['tran_id'],
            'currency' => 'BDT',
            'delivery_charge' => $charge,
            'city' => $requestData['city'],
            'ship_name' => $requestData['ship_name'],
            'ship_email' => $requestData['ship_email'],
            'ship_phone' => $requestData['ship_phone'],
            'ship_city' => $requestData['ship_city'],
            'ship_address' => $requestData['ship_address'],
            'note' => $requestData['note'],
            'status' => 'Pending',
            'shop_id' => $requestData['shop_id'],
            'shop_url' => $requestData['shop_url'],
            'ship_check' => $ship_check,
            'order_id' => $order_id,
            'created_at' => Carbon::now(),
        ]);


        $sslc = new SslCommerzNotification($requestData['shop_id']);
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }


    public function success(Request $request,)
    {
        $info = SslOrder::where('transaction_id', $request->tran_id)->first();

        // Subscription Package Start
        $shop = Shop::where('shop_id', $info->shop_id)->first();

        if ($info->product_type == 'subscription') {

            $subscriptionPeriods = [
                '1' => 1,  // 1 month
                '2' => 6,  // 6 months
                '3' => 12, // 12 months
            ];

            if (isset($subscriptionPeriods[$info->package_type])) {
                $shop->expiry_date = Carbon::parse($shop->expiry_date)
                    ->addMonths($subscriptionPeriods[$info->package_type]); // Correct key usage
                $shop->save();
            } else {
                return redirect()->route('subscription.index')->with('error', 'Invalid Package Type');
            }

            return redirect()->route('subscription.index')->with('success', 'Order Placed Successfully');
        }
        // Subscription Package End


        $cartData = CartVariantProduct::where('order_id', $info->order_id)->get();

        // Get the input phone number
        $phone = $info->phone;

        // Check if the phone number starts with +88
        if (str_starts_with($phone, '+88')) {
            $phone = substr($phone, 3); // Remove +88 from the phone number
        }
        $customer = Customer::firstOrCreate(
            [
                'phone' => $phone,
            ],
            [
                'name' => $info->name,
                'email' => $info->email,
                'address' => $info->address,
            ]
        );

        Order::create([
            'shop_id' => $info->shop_id,
            'order_id' => $info->order_id,
            'customer_id' => $customer->id,
            'subtotal' => $info->amount - $info->delivery_charge,
            'charge' => $info->delivery_charge,
            'coupon_code' => $info->coupon_code,
            'discount' => $info->discount,
            'total' => $info->amount - $info->discount,
            'payment_method' => 'ssl',
        ]);

        foreach ($cartData as $order) {

            OrderProduct::create([
                'shop_id' => $order->shop_id,
                'order_id' => $order->order_id,
                'customer_id' => $customer->id,
                'product_id' => $order->product_id,
                'attribute_id' => $order->attribute_id,
                'color_id' => $order->color_id,
                'quantity' => $order->quantity,
                'price' => $order->price,
            ]);
        }


        if ($info->ship_check == '1') {

            Billing::create([
                'shop_id' => $info->shop_id,
                'order_id' => $info->order_id,
                'customer_id' => $customer->id,
                'name' => $info->name,
                'email' => $info->email,
                'phone' => $info->phone,
                'city' => $info->city,
                'address' => $info->address,
                'note' => $info->note,
            ]);

            Shipping::create([
                'shop_id' => $info->shop_id,
                'order_id' => $info->order_id,
                'ship_name' => $info->ship_name,
                'ship_email' => $info->ship_email,
                'ship_phone' => $info->ship_phone,
                'ship_city' => $info->ship_city,
                'ship_address' => $info->ship_address,
            ]);
        } else {

            Billing::create([
                'shop_id' => $info->shop_id,
                'order_id' => $info->order_id,
                'customer_id' => $customer->id,
                'name' => $info->name,
                'email' => $info->email,
                'phone' => $info->phone,
                'city' => $info->city,
                'address' => $info->address,
                'note' => $info->note,
            ]);

            Shipping::create([
                'shop_id' => $info->shop_id,
                'order_id' => $info->order_id,
                'ship_name' => $info->name,
                'ship_email' => $info->email,
                'ship_phone' => $info->phone,
                'ship_city' => $info->city,
                'ship_address' => $info->address,
            ]);
        }

        $shop = Shop::where('shop_id', $info->shop_id)->first();

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
            $message = "Your order {$info->order_id} has been successfully placed. We will notify you once your order is shipped.\n\n{$shop->name} Team";

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

        $products = CartVariantProduct::where('order_id', $info->order_id)->get();

        foreach ($products as $product) {
            Variant::where('product_id', $product->product_id)
                ->where('attribute_id', $product->attribute_id)
                ->where('color_id', $product->color_id)
                ->decrement('quantity', $product->quantity);
        }
        CartVariantProduct::where('order_id', $info->order_id)->delete();

        $coupon = Coupon::where('coupon_code', $info->coupon_code)->first();

        if ($coupon) {
            $coupon->quantity = $coupon->quantity - 1;
            $coupon->save();
        }
        Session::forget(['min_amount', 'discount_type', 'discount', 'coupon_code']);

        event(new InvoiceGenerated($info->order_id));

        return redirect()->route('order.placed', $shop->url)->with(['order_id' => $info->order_id, 'success' => 'Order Placed Successfully']);
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('ssl_orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'shop_url')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('ssl_orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            return redirect()->route('home', $order_details->shop_url)->with('error', 'Order Payment Failed');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            return redirect()->route('home', $order_details->shop_url)->with('error', 'Order Payment Failed');
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('ssl_orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'shop_url')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('ssl_orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            return redirect()->route('home', $order_details->shop_url)->with('error', 'Transaction is Cancelled');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            return redirect()->route('home', $order_details->shop_url)->with('error', 'Transaction is Invalid');
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('ssl_orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('ssl_orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
