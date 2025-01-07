<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\SslOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Library\SslCommerz\SslCommerzNotification;

class SubscriptionController extends Controller
{
    function index()
    {
        $shop = Auth::guard('merchant')->user()->shop;

        // Calculate remaining days for expiry
        $expiry_date = $shop ? $shop->expiry_date : null;
        $remaining_days = null;
        if ($expiry_date) {
            $remaining_days = (new DateTime($expiry_date))->diff(new DateTime())->days;
        }

        return view('merchant.subscription.index', [
            'expiry_date' => $expiry_date,
            'remaining_days' => $remaining_days,
        ]);
    }
    function subscription(Request $request)
    {
        $Merchant = Auth::guard('merchant')->user();
        $shop = $Merchant->shop;
        $subscriptionAmounts = [
            '1' => '500',
            '2' => '3000',
            '3' => '5000',
        ];
        $amount = $subscriptionAmounts[$request->subscription] ?? '0';

            $post_data = [
                // CUSTOMER INFORMATION
                'cus_name' => $Merchant->name,
                'cus_email' => $Merchant->email,
                'cus_add1' => $shop->address,
                'cus_add2' => '',
                'cus_city' => $shop->city,
                'cus_state' => '',
                'cus_postcode' => '',
                'cus_country' => 'Bangladesh',
                'cus_phone' => $Merchant->phone,
                'cus_fax' => '',
                'total_amount' => $amount,
                'tran_id' => uniqid(),

                // SHIPMENT INFORMATION
                'ship_name' => $Merchant->name,
                'ship_add1' => $shop->address,
                'ship_add2' => '',
                'ship_city' => $shop->city,
                'ship_state' => '',
                'ship_postcode' => '1217',
                'ship_phone' => $Merchant->phone,
                'ship_country' => 'Bangladesh',

                // Additional Information
                'shipping_method' => 'payment',
                'product_name' => 'subscription',
                'product_category' => 'good',
                'product_profile' => 'Healthy Food',
                'currency' => 'BDT',

            ];


            SslOrder::where('transaction_id', $post_data['tran_id'])->updateOrInsert([
                'name' => $Merchant->name,
                'email' => $Merchant->email,
                'phone' => $Merchant->phone,
                'amount' => $amount,
                'coupon_code' => 0,
                'discount' => 0,
                'address' => $shop->address,
                'transaction_id' => $post_data['tran_id'],
                'currency' => 'BDT',
                'delivery_charge' => 0,
                'city' => $shop->city,
                'ship_name' => $Merchant->name,
                'ship_email' => $Merchant->email,
                'ship_phone' => $Merchant->phone,
                'ship_city' => $shop->city,
                'ship_address' => $shop->address,
                'note' => '',
                'status' => 'Pending',
                'product_type' => 'subscription',
                'shop_id' => $shop->shop_id,
                'shop_url' => $shop->url,
                'ship_check' => 0,
                'order_id' => 'subPay'.random_int(1000, 9999),
                'package_type' => $request->subscription,
                'created_at' => Carbon::now(),
            ]);

            $owner = 'owner';

            $sslc = new SslCommerzNotification($owner);
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
    }
}
