<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    function clearNotifications()
    {
         $orders = Order::where('shop_id', Auth::guard('merchant')->user()->shop_id)->where('notify', '0')->get();
         $reviews = Review::where('shop_id', Auth::guard('merchant')->user()->shop_id)->where('notify', '0')->get();

         DB::beginTransaction();
         try {
             foreach ($orders as $order) {
                 $order->update(['notify' => '1']);
             }

             foreach ($reviews as $review) {
                 $review->update(['notify' => '1']);
             }
             DB::commit();
             return response()->json(['status' => 'success']);

         } catch (\Exception $e) {
             DB::rollBack();
             return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
         }
     }

     function ordernotification($id){
         $order = Order::find($id);
         $order->update(['notify' => '1']);
         return redirect()->route('order.index')->with('order', $id);
     }

}
