<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function dashboard()
    {
        $shop_id = Auth::guard('merchant')->user()->shop_id;
        $shop = Shop::where('shop_id', $shop_id)->first();

        // Calculate remaining days for expiry
        $expiry_date = $shop ? $shop->expiry_date : null;
        $remaining_days = null;
        if ($expiry_date) {
            $remaining_days = (new DateTime($expiry_date))->diff(new DateTime())->days;
        }

        // Analitics for dashboard
        $salesToday = Order::where('shop_id', $shop_id)->whereDate('created_at', Carbon::today())->sum('total');
        $salesThisWeek = Order::where('shop_id', $shop_id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total');
        $salesThisMonth = Order::where('shop_id', $shop_id)->whereMonth('created_at', Carbon::now()->month)->sum('total');
        $visitors = Shop::where('shop_id', $shop_id)->first()->visitors;
        $ordersThisMonth = Order::where('shop_id', $shop_id)->whereMonth('created_at', Carbon::now()->month)->count();
        $orderstotal = Order::where('shop_id', $shop_id)->count();

        $mostSoldProducts = OrderProduct::select('products.name', DB::raw('SUM(order_products.quantity) as total_sold'))
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->where('products.shop_id', $shop_id)
            ->groupBy('order_products.product_id', 'products.name')
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();

        $lowStockProducts = Product::join('variants', 'products.id', '=', 'variants.product_id')
            ->select('products.name', DB::raw('SUM(CAST(variants.quantity AS SIGNED)) as total_stock'))
            ->where('products.shop_id', $shop_id)
            ->groupBy('products.id', 'products.name')
            ->having('total_stock', '<', 5)
            ->orderBy('total_stock', 'asc')
            ->get();


        return view('merchant.dashboard', [
            'shop' => $shop,
            'expiry_date' => $expiry_date,
            'remaining_days' => $remaining_days,
            'salesToday' => $salesToday,
            'salesThisWeek' => $salesThisWeek,
            'salesThisMonth' => $salesThisMonth,
            'visitors' => $visitors,
            'ordersThisMonth' => $ordersThisMonth,
            'orderstotal' => $orderstotal,
            'mostSoldProducts' => $mostSoldProducts,
            'lowStockProducts' => $lowStockProducts,
        ]);
    }
}
