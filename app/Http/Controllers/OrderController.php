<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Billing;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\SmsConfig;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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


        $order_id = '#cod'.uniqid().'_'. now()->format('dm');
        $subtotal = 0;

        foreach ($data as $value) {
             $after_subtotal = $value['quantity'] * $value['current_price'];
             $subtotal += $after_subtotal;
         }



        // if selected payment method is cod

        if($request->payment == 'cod'){
            $subtotal = 0;

           foreach ($data as $value) {
                $after_subtotal = $value['quantity'] * $value['current_price'];
                $subtotal += $after_subtotal;
            }

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



        // if selected payment method is bkash
        }elseif($request->payment == 'bkash'){

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


            // $post_data = array();
            // $post_data['shop_id'] = $shop->shop_id;
            // $post_data['order_id'] = $order_id;
            // $post_data['customer_id'] = $customer->id;
            // $post_data['subtotal'] = $subtotal;
            // $post_data['charge'] = $charge;
            // $post_data['total'] = $charge + $subtotal;
            // $post_data['payment_method'] = 'ssl';
            // $post_data['name'] = $request->name;
            // $post_data['email'] = $request->email;
            // $post_data['phone'] = $request->phone;
            // $post_data['amount'] = $charge + $subtotal;
            // $post_data['status'] = 'Pending';
            // $post_data['address'] = $request->address;
            // $post_data['transaction_id'] = $tran_id;
            // $post_data['currency'] = 'BDT';

            $tran_id = uniqid();


            $post_data = [
                // CUSTOMER INFORMATION
                'cus_name' => $request->name,
                'cus_email' => $request->email,
                'cus_add1' => $request->address,
                'cus_add2' => '',
                'cus_city' => $request->city,
                'cus_state' => '',
                'cus_postcode' => '',
                'cus_country' => 'Bangladesh',
                'cus_phone' => $request->phone,
                'cus_fax' => '',
                'total_amount' => $charge + $subtotal,
                'tran_id' => $tran_id,

                // SHIPMENT INFORMATION
                'ship_name' => $request->ship_name,
                'ship_add1' => $request->ship_address,
                'ship_add2' => '',
                'ship_city' => $request->ship_city,
                'ship_state' => '',
                'ship_postcode' => '',
                'ship_phone' => $request->ship_phone,
                'ship_country' => '',

                // Additional Information
                'shipping_method' => 'NO',
                'product_name' => 'computer',
                'product_category' => 'good',
                'product_profile' => 'Healthy Food',
                'currency' => 'BDT',
            ];


            Order::where('transaction_id', $tran_id)->updateOrInsert([
                'shop_id' => $shop->shop_id,
                'order_id' => $order_id,
                'customer_id' => $customer->id,
                'subtotal' => $subtotal,
                'charge' => $charge,
                'total' => $charge + $subtotal,
                'payment_method' => 'ssl',
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'amount' => $charge + $subtotal,
                'status' => 'Pending',
                'address' => $request->address,
                'transaction_id' => $tran_id,
                'currency' => 'BDT',
                'created_at' => Carbon::now(),
            ]);


            #Before  going to initiate the payment order status need to insert or update as Pending.
            // $update_product = DB::table('orders')
            //     ->where('transaction_id', $post_data['tran_id'])
            //     ->updateOrInsert([
            //         'name' => $post_data['cus_name'],
            //         'email' => $post_data['cus_email'],
            //         'phone' => $post_data['cus_phone'],
            //         'amount' => $post_data['total_amount'],
            //         'status' => 'Pending',
            //         'address' => $post_data['cus_add1'],
            //         'transaction_id' => $post_data['tran_id'],
            //         'currency' => $post_data['currency']
            //     ]);


            $sslc = new SslCommerzNotification($shop->shop_id);
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }


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

        return redirect()->route('home',$shopUrl)->with('success', 'Order Placed Successfully');
    }

    public function success(Request $request, )
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }
}
