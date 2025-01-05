<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    public function order(Request $request, $data = null)
    {
        $shop = Auth::guard('merchant')->user()->shop;

        // Query শুরু করি
        $query = Order::where('shop_id', $shop->shop_id);

        // `data` অনুসারে ফিল্টার প্রয়োগ
        switch ($data) {
            case 'pending':
            case 'delivering':
            case 'delivered':
            case 'cancel':
                $query->where('status', $data);
                break;

            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;

            case 'month':
                $query->whereMonth('created_at', Carbon::now()->month);
                break;

            default:
                // যদি `data` কিছু না হয়, সব অর্ডার দেখাও (ডিফল্ট আচরণ)
                break;
        }

        // `from` এবং `to` ডেটার ভিত্তিতে ফিল্টার
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
        }

        // ফাইনাল অর্ডার লিস্ট
        $orders = $query->get();

        // ভিউ রিটার্ন করা
        return view('merchant.report.order', [
            'orders' => $orders,
        ]);
    }

    public function product(Request $request, $data = null)
    {
        $shop = Auth::guard('merchant')->user()->shop;

        $query = OrderProduct::where('shop_id', $shop->shop_id);

        switch ($data) {
            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;

            case 'month':
                $query->whereMonth('created_at', Carbon::now()->month);
                break;

            default:
                break;
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
        }

        $orderProducts = $query->latest()->get();

        return view('merchant.report.product', [
            'orderProducts' => $orderProducts,
        ]);
    }
}
