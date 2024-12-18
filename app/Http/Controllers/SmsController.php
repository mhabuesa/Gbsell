<?php

namespace App\Http\Controllers;

use App\Models\SmsConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{

    public function index()
    {
        $auth = Auth::guard('merchant')->user();

        if ($auth->permission != 1) {
            return redirect()->route('accessDeny');
        }

        $shop_id = $auth->shop_id;
        $sms = SmsConfig::where('shop_id', $shop_id)->first();

        // Default balance value
        $balance = null;

        if ($sms && $sms->api_key) {
            $apiUrl = 'http://bulksmsbd.net/api/getBalanceApi?api_key=' . $sms->api_key;

            try {
                $response = Http::get($apiUrl);

                if ($response->ok()) {
                    $data = $response->json();

                    if ($data['response_code'] === 202) {
                        // Format balance to 2 decimals
                        $balance = number_format($data['balance'], 2);
                    }
                }
            } catch (\Exception $e) {
                // Handle exception (optional: log it)
                $balance = 'Error fetching balance';
            }
        }

        return view('merchant.sms.index', [
            'shop_id' => $shop_id,
            'api_key' => $sms ? $sms->api_key : '',
            'sender_id' => $sms ? $sms->sender_id : '',
            'status' => $sms ? $sms->status : '',
            'balance' => $balance,
        ]);
    }


    public function sms_update(Request $request, $id)
    {

        $exists = SmsConfig::where('shop_id', $id)->exists();

        if($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        if ($exists) {

            SmsConfig::where('shop_id', $id)->update([
                'api_key'=> $request->input('api_key'),
                'sender_id'=> $request->input('sender_id'),
                'status'=> $status,
            ]);
            return redirect()->back()->with('success', 'SMS Config Updated Successfully');

        } else {
            SmsConfig::create([
                'shop_id' => $id,
                'api_key'=> $request->input('api_key'),
                'sender_id'=> $request->input('sender_id'),
                'status'=> $status,
            ]);
            return redirect()->back()->with('success', 'Payment Method Created Successfully');
        }
    }

    public function getBalance()
    {
        $apiUrl = 'http://bulksmsbd.net/api/getBalanceApi?api_key=K9YXIwC5K6nifLYd4XL3';

        try {
            $response = Http::get($apiUrl);

            if ($response->ok()) {
                $data = $response->json();

                // Check response code and handle balance
                if ($data['response_code'] === 202) {
                    return response()->json(['balance' => number_format($data['balance'], 2)]); // Format balance to 2 decimals
                } else {
                    return response()->json(['error' => 'Invalid response code.'], 400);
                }
            } else {
                return response()->json(['error' => 'Failed to connect to API.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }
}
