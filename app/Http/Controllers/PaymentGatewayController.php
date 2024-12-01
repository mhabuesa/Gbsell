<?php

namespace App\Http\Controllers;

use App\Models\PaymentGateway;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentGatewayController extends Controller
{

    public function index()
    {
        $shop_id = Auth::guard('merchant')->user()->shop_id;

        // Fetch all required payment methods in a single query
        $payment_methods = PaymentGateway::where('shop_id', $shop_id)
            ->whereIn('method', ['cod', 'ssl', 'bkash'])
            ->get()
            ->keyBy('method');

        return view('merchant.payment.index', [
            'shop_id' => $shop_id,
            'cod' => $payment_methods->get('cod'),
            'ssl' => $payment_methods->get('ssl'),
            'bkash' => $payment_methods->get('bkash'),
        ]);
    }


    public function payment_cod(Request $request, $id)
    {
        $method = $request->input('method');
        $payment_check = PaymentGateway::where('shop_id', $id)->where('method', $method)->exists();

        if ($payment_check) {

            PaymentGateway::where('shop_id', $id)->where('method', $method)->update([
                'note'=> $request->input('note'),
            ]);
            return redirect()->back()->with('success', 'Payment Method Updated Successfully');

        } else {
            PaymentGateway::create([
                'shop_id' => $id,
                'method' => $method,
                'note'=> $request->input('note'),
            ]);
            return redirect()->back()->with('success', 'Payment Method Created Successfully');
        }
    }

    function payment_ssl(Request $request, $id)
    {
        $method = $request->input('method');
        $payment_check = PaymentGateway::where('shop_id', $id)->where('method', $method)->exists();

        if($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        if ($payment_check) {
            PaymentGateway::where('shop_id', $id)->where('method', $method)->update([
                'store_id' => $request->input('store_id'),
                'store_password' => $request->input('store_password'),
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Payment Method Updated Successfully');
        } else {
            PaymentGateway::create([
                'shop_id' => $id,
                'method' => $method,
                'store_id' => $request->input('store_id'),
                'store_password' => $request->input('store_password'),
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Payment Method Created Successfully');
        }

    }


    public function payment_bkash(Request $request, $id)
    {
        $method = $request->input('method');
        $payment_check = PaymentGateway::where('shop_id', $id)->where('method', $method)->exists();

        if($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        if ($payment_check) {
            PaymentGateway::where('shop_id', $id)->where('method', $method)->update([
                'store_id' => $request->input('store_id'),
                'store_password' => $request->input('store_password'),
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Payment Method Updated Successfully');
        } else {
            PaymentGateway::create([
                'shop_id' => $id,
                'method' => $method,
                'store_id' => $request->input('store_id'),
                'store_password' => $request->input('store_password'),
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Payment Method Created Successfully');
        }
    }

}
