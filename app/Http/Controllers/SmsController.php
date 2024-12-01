<?php

namespace App\Http\Controllers;

use App\Models\SmsConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsController extends Controller
{

    public function index()
    {
        $shop_id = Auth::guard('merchant')->user()->shop_id;

        $sms = SmsConfig::where('shop_id', $shop_id)->first();

        return view('merchant.sms.index', [
            'shop_id' => $shop_id,
            'api_key' =>  $sms ? $sms->api_key : '',
            'sender_id' => $sms ? $sms->sender_id : '',
            'status' => $sms ? $sms->status : '',
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
}
