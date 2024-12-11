<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Billing;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{

    public function invoice($shopUrl, $order_id)
    {
        // Shop validation is already done by the middleware
        $shop = Shop::where('url', $shopUrl)->first();

        // Fetch order details
        $order = Order::where('order_id', $order_id)->where('shop_id', $shop->shop_id)->first();

        if (!$order) {
            abort(404, 'Order not found');
        }
        $bill = Billing::where('order_id', $order->order_id)->first();
        $products = OrderProduct::where('order_id', $order->order_id)->get();

        // Pass the order and shop to the view or generate a PDF
        return view('frontend.shop.invoice', compact('shop', 'order', 'bill', 'products'));
    }
}
