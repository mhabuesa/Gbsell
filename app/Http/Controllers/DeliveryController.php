<?php

namespace App\Http\Controllers;

use App\Models\DeliverySystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{

    public function index()
    {
        $auth = Auth::guard('merchant')->user();

        if($auth->permission != 1){
            return redirect()->route('accessDeny');
        }
        $shop_id = $auth->shop_id;

        // Fetch all required payment methods in a single query
        $delivery = DeliverySystem::where('shop_id', $shop_id)
            ->whereIn('method', ['redx', 'steadfast', 'pathao'])
            ->get()
            ->keyBy('method');

        return view('merchant.delivery.index', [
            'shop_id' => $shop_id,
            'redx' => $delivery->get('redx'),
            'steadfast' => $delivery->get('steadfast'),
            'pathao' => $delivery->get('pathao'),
        ]);

    }


    public function delivery_redx(Request $request, $id)
    {
        $method = $request->input('method');
        $delivery_check = DeliverySystem::where('shop_id', $id)->where('method', $method)->exists();

        if($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        if ($delivery_check) {
            DeliverySystem::where('shop_id', $id)->where('method', $method)->update([
                'app_secret' => $request->input('app_secret'),
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Delivery Method Updated Successfully');

        } else {
            DeliverySystem::create([
                'shop_id' => $id,
                'method' => $method,
                'app_secret' => $request->input('app_secret'),
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Delivery Method Created Successfully');
        }
    }


    public function delivery_steadfast(Request $request, $id)
    {
        $method = $request->input('method');
        $delivery_check = DeliverySystem::where('shop_id', $id)->where('method', $method)->exists();

        if($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        if ($delivery_check) {
            DeliverySystem::where('shop_id', $id)->where('method', $method)->update([
                'api_key' => $request->input('api_key'),
                'app_secret' => $request->input('app_secret'),
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Delivery Method Updated Successfully');

        } else {
            DeliverySystem::create([
                'shop_id' => $id,
                'method' => $method,
                'api_key' => $request->input('api_key'),
                'app_secret' => $request->input('app_secret'),
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Delivery Method Created Successfully');
        }
    }


    public function delivery_pathao(Request $request, $id)
    {
        $method = $request->input('method');
        $delivery_check = DeliverySystem::where('shop_id', $id)->where('method', $method)->exists();

        if($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        if ($delivery_check) {
            DeliverySystem::where('shop_id', $id)->where('method', $method)->update([
                'store_id' => $request->input('store_id'),
                'client_id' => $request->input('client_id'),
                'client_secret' => $request->input('client_secret'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Delivery Method Updated Successfully');

        } else {
            DeliverySystem::create([
                'shop_id' => $id,
                'method' => $method,
                'store_id' => $request->input('store_id'),
                'client_id' => $request->input('client_id'),
                'client_secret' => $request->input('client_secret'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'status' => $status,
            ]);
            return redirect()->back()->with('success', 'Delivery Method Created Successfully');
        }
    }
}
