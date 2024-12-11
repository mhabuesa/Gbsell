<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    function customer_auth(Request $request, $shopUrl)
    {
        $shop = Shop::where('url', $shopUrl)->first();
        return view('frontend.customer.auth', compact('shop'));
    }

    function customer_register(Request $request, $shopUrl)
    {
        $shop = Shop::where('url', $shopUrl)->first();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(?:\+8801|01)[3-9]\d{8}$/'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        // Get the input phone number
        $phone = $request->input('phone');

        // Check if the phone number starts with +88
        if (str_starts_with($phone, '+88')) {
            $phone = substr($phone, 3); // Remove +88 from the phone number
        }

        $exists = Customer::where('phone', $phone)->first();
        if ($exists) {
            if ($exists->status == 'verified') {
                return redirect()->back()->with('error', 'Your account is already verified. Please login');
            } else {
                $otp = random_int(100000, 999999);
                $exists->update([
                    'otp' => $otp
                ]);

                $url = "http://bulksmsbd.net/api/smsapi";
                $api_key = "K9YXIwC5K6nifLYd4XL3";
                $senderid = "8809617612585";
                $number = "$phone";
                $message = "Thank you for verifying your account with {$shop->name}!\n Your verification code is: {$otp}.\n Please use this code to complete your verification process.\n\n{$shop->name} Team";

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

                return redirect()->route('customer.verify', ['shopUrl' => $shopUrl, 'phone' => $phone]);
            }
        } else {

            $otp = mt_rand(100000, 999999);
            Customer::create([
                'shop_id' => $shop->shop_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $phone,
                'otp' => $otp
            ]);

            $url = "http://bulksmsbd.net/api/smsapi";
            $api_key = "K9YXIwC5K6nifLYd4XL3";
            $senderid = "8809617612585";
            $number = "$phone";
            $message = "Your verification code is: {$otp}.\n Thank you for verifying your account with {$shop->name}! \n\n{$shop->name} Team";

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

            return redirect()->route('customer.verify', ['shopUrl' => $shopUrl, 'phone' => $phone]);
        }
    }

    function customer_verify(Request $request, $shopUrl, $phone)
    {
        if (!Customer::where('phone', $phone)->first()) {
            return redirect()->route('customer.auth', ['shopUrl' => $shopUrl])->with('error', 'Phone number not found. Please register first.');
        }

        $shop = Shop::where('url', $shopUrl)->first();

        if (!$shop) {
            return redirect()->route('home')->with('error', 'Shop not found.');
        }

        return view('frontend.customer.verify', compact('shop', 'phone'));
    }

    function customer_verified(Request $request, $shopUrl, $phone)
    {
        $request->validate([
            'otp' => ['required'],
        ]);

        $otp = $request->input('otp');
        $shop = Shop::where('url', $shopUrl)->first();
        $customer = Customer::where('phone', $phone)->first();
        if ($customer->otp != $otp) {
            return redirect()->back()->with('error', 'Invalid OTP. Please check the code and try again.');
        }

        $customer->update([
            'status' => 'verified'
        ]);
        Auth::guard('customer')->login($customer);

        return redirect()->route('account', ['shopUrl' => $shopUrl])->with('success', 'Welcome back!');
    }


    function resend_otp($shopUrl, $phone)
    {
        $shop = Shop::where('url', $shopUrl)->first();

        $customer = Customer::where('phone', $phone)->first();
        $customer->update([
            'otp' => mt_rand(100000, 999999)
        ]);
        $otp = $customer->otp;

        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = "K9YXIwC5K6nifLYd4XL3";
        $senderid = "8809617612585";
        $number = "$phone";
        $message = "Your verification code is: {$otp}.\n Thank you for verifying your account with {$shop->name}! \n\n{$shop->name} Team";

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

        return redirect()->route('customer.verify', ['shopUrl' => $shopUrl, 'phone' => $phone])->with('success', 'OTP sent successfully.');
    }

    function customer_logout($shopUrl)
    {
        $shop = Shop::where('url', $shopUrl)->first();
        Auth::guard('customer')->logout();
        return redirect()->route('home', ['shopUrl' => $shopUrl])->with('success', 'Logout successfully.');
    }

    function customer_logedin(Request $request, $shopUrl)
    {
        $request->validate([
            'login_phone' => ['required', 'regex:/^(?:\+8801|01)[3-9]\d{8}$/'],
            'login_password' => ['required'],
        ]);

        $shop = Shop::where('url', $shopUrl)->first();
        if (!$shop) {
            return redirect()->route('home')->with('error', 'Shop not found.');
        }


        $phone = $request->input('login_phone');
        if (str_starts_with($phone, '+88')) {
            $phone = substr($phone, 3);
        }


        if (Auth::guard('customer')->attempt(['phone' => $phone, 'password' => $request->login_password])) {
            return redirect()->route('home', ['shopUrl' => $shop->url])->with('success', 'Welcome back!');
        }

        return redirect()->back()->with('error', 'Invalid credentials. Please check your Phone and password and try again.');
    }

    function forgot_password($shopUrl)
    {
        $shop = Shop::where('url', $shopUrl)->first();
        return view('frontend.customer.forgot_password', compact('shop'));
    }


    function forgot_otp(Request $request, $shopUrl)
    {
        $request->validate([
            'phone' => ['required', 'regex:/^(?:\+8801|01)[3-9]\d{8}$/'],
        ]);

        $shop = Shop::where('url', $shopUrl)->first();

        $phone = $request->input('phone');
        if (str_starts_with($phone, '+88')) {
            $phone = substr($phone, 3);
        }

        $customer = Customer::where('phone', $phone)->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'Phone number not found. Please register first.');
        }

        $customer->update([
            'otp' => mt_rand(100000, 999999)
        ]);
        $otp = $customer->otp;

        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = "K9YXIwC5K6nifLYd4XL3";
        $senderid = "8809617612585";
        $number = "$phone";
        $message = "Your verification code is: {$otp}.\n Thank you for verifying your account with {$shop->name}! \n\n{$shop->name} Team";

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

        return redirect()->route('forgot.otp.verify', ['shopUrl' => $shopUrl, 'phone' => $phone])->with([
            'success' => 'OTP sent successfully. Please check your phone and enter the OTP.',
            'phone' => $phone
        ]);
    }


    function forgot_otp_verify($shopUrl, $phone)
    {
        $shop = Shop::where('url', $shopUrl)->first();
        if (!$shop) {
            return redirect()->route('home')->with('error', 'Shop not found.');
        }
        return view('frontend.customer.forgot_otp_verify', compact('shop', 'phone'));
    }


    function forget_new_password(Request $request, $shopUrl, $phone)
    {
        $request->validate([
            'otp' => ['required', 'numeric', 'digits:6'],
        ]);

        $shop = Shop::where('url', $shopUrl)->first();
        $customer = Customer::where('phone', $phone)->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'Phone number not found. Please register first.');
        }
        if ($customer->otp == $request->otp) {
            $customer->update([
                'status' => 'verified',

            ]);
            return view('frontend.customer.forgot_new_password', compact('shop', 'phone'))->with('success', 'OTP verified successfully. Please enter new password.');;
        }
        return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
    }


    function forget_password_update(Request $request, $shopUrl, $phone)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
        ]);
        $customer = Customer::where('phone', $phone)->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'Phone number not found. Please register first.');
        }
        $customer->update([
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('customer.auth', ['shopUrl' => $shopUrl])->with('success', 'Password changed successfully. Please login.');
    }
}
