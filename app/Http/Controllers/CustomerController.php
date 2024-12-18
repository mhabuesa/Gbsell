<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Customer;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerController extends Controller
{

    public function cart_coupon(Request $request, $shopUrl){

        $request->validate([
            'coupon_code' => 'required',
        ]);

        $shop = Shop::where('url', $shopUrl)->first();

        $coupon = Coupon::where('shop_id', $shop->shop_id)->where('coupon_code', $request->coupon_code)->first();
        if($coupon){
            if($coupon->status == 1 && $coupon->expire_date >= date('Y-m-d') && $coupon->quantity > 0){
                if ($coupon->min_amount > $request->subtotal) {
                    return redirect()->back()->with('error', 'Minimum amount should be ৳' . $coupon->min_amount . '!');
                } else {
                    // Clear existing session data related to coupons
                    Session::forget(['min_amount', 'discount_type', 'discount']);

                    // Set new coupon data in session
                    $request->session()->put([
                        'min_amount' => $coupon->min_amount,
                        'discount_type' => $coupon->discount_type,
                        'discount' => $coupon->discount,
                        'coupon_code' => $coupon->coupon_code,
                    ]);

                    return redirect()->back()->with('success', 'Coupon applied successfully!');
                }


            }
            else{
                return redirect()->back()->with('error', 'Coupon expired, please try another coupon!');
            }
        }
        else{
            return redirect()->back()->with('error', 'Invalid Coupon, please try again!');
        }
        return redirect()->route('cart', $shopUrl);
    }

    public function coupon_remove($shopUrl){

        Session::forget(['min_amount', 'discount_type', 'discount', 'coupon_code']);
        return redirect()->route('cart', $shopUrl);
    }



    public function ordered_list($shopUrl){
        $shop = Shop::where('url', $shopUrl)->first();
        $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)->where('shop_id', $shop->shop_id)->paginate(10);
        return view('frontend.customer.ordered_list', compact('shop', 'orders'));
    }


    function  wishlist($shopUrl) {

        $shop = Shop::where('url', $shopUrl)->first();

        // Retrieve wishlist data from cookies
        $wishlist = json_decode(Cookie::get('wishlist'), true);

        $productIds = [];
        if (isset($wishlist[$shopUrl])) {
            // Reverse the cookie order to get the latest added product first
            $productIds = array_reverse(array_column($wishlist[$shopUrl], 'product_id'));
        }

        // Retrieve products from the database
        $products = Product::whereIn('id', $productIds)
            ->where('status', 1)
            ->get();

        // Reorder products to match the reversed cookie order
        $orderedProducts = $products->sortBy(function ($product) use ($productIds) {
            return array_search($product->id, $productIds); // Match reversed order
        });

        // Manual pagination
        $currentPage = request()->input('page', 1); // Current page number
        $perPage = 10; // Number of items per page
        $items = $orderedProducts->slice(($currentPage - 1) * $perPage, $perPage)->values(); // Slice the collection

        $paginatedProducts = new LengthAwarePaginator(
            $items,
            $orderedProducts->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );


        return view('frontend.customer.wishlist', [
            'shop' => $shop,
            'products' => $paginatedProducts,
        ]);
    }

    function wishlist_store($shopUrl, $product_id)
    {
        $wishlist = json_decode(Cookie::get('wishlist'), true);

        // Initialize wishlist if empty
        if (!$wishlist) {
            $wishlist = [];
        }

        // Check if shop exists in wishlist
        if (isset($wishlist[$shopUrl])) {
            // Extract all product IDs from the shop's wishlist
            $productIds = array_column($wishlist[$shopUrl], 'product_id');

            // Check if the product ID already exists
            if (in_array($product_id, $productIds)) {
                return redirect()->back()->with('error', 'Product already exists in Wishlist.');
            }
        }

        // Add the product to the wishlist
        $wishlist[$shopUrl][] = ['product_id' => $product_id];

        // Save updated wishlist to cookies
        Cookie::queue('wishlist', json_encode($wishlist), 60 * 24 * 30);

        return redirect()->back()->with('success', 'Product added to Wishlist successfully.');
    }

    function wishlist_remove($shopUrl, $product_id)
    {
        $shop = Shop::where('url', $shopUrl)->first();
        $wishlist = json_decode(Cookie::get('wishlist'), true);

        if (isset($wishlist[$shopUrl])) {
            foreach ($wishlist[$shopUrl] as $key => $item) {
                if ($item['product_id'] == $product_id) {
                    unset($wishlist[$shopUrl][$key]);
                    break;
                }
            }
        }

        // Save updated wishlist to cookies
        Cookie::queue('wishlist', json_encode($wishlist), 60 * 24 * 30);

        return redirect()->back()->with('success', 'Product removed from Wishlist successfully.');
    }



    public function account($shopUrl){
        $shop = Shop::where('url', $shopUrl)->first();
        $customerId = Auth::guard('customer')->user()->id;

        // Count orders for the customer
        $pending_order = Order::where('customer_id', $customerId)->where('shop_id', $shop->shop_id)->whereIn('status', ['pending', 'delivering', 'processing'])->count();
        $completed_order = Order::where('customer_id', $customerId)->where('shop_id', $shop->shop_id)->where('status', 'delivered')->count();
        $cancelled_order = Order::where('customer_id', $customerId)->where('shop_id', $shop->shop_id)->where('status', 'cancelled')->count();
        return view('frontend.customer.account',[
            'shop' => $shop,
            'pending_order' => $pending_order,
            'completed_order' => $completed_order,
            'cancelled_order' => $cancelled_order,
        ]);
    }
    public function account_setting($shopUrl){
        $shop = Shop::where('url', $shopUrl)->first();
        return view('frontend.customer.account_setting', compact('shop'));
    }


    function account_update(Request $request, $shopUrl){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(?:\+8801|01)[3-9]\d{8}$/'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

         // Get the input phone number
         $phone = $request->input('phone');
         // Check if the phone number starts with +88
         if (str_starts_with($phone, '+88')) {
             $phone = substr($phone, 3); // Remove +88 from the phone number
         }
        $shop = Shop::where('url', $shopUrl)->first();
        $customerId = Auth::guard('customer')->user()->id;
        if($request->password == ''){
            Customer::where('id', $customerId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $phone,
                'address' => $request->address,
            ]);
        }else{
            Customer::where('id', $customerId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $phone,
                'address' => $request->address,
                'password' => bcrypt($request->password),
            ]);
        }
        return redirect()->back()->with('success', 'Account updated successfully.');
    }

    public function order_cancel($shopUrl, $id)
    {

        $order = Order::where('id', $id)->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $orderProduct = OrderProduct::where('order_id', $order->order_id)->get();

        foreach ($orderProduct as $item) {
            Variant::where('product_id', $item->product_id)
            ->where('attribute_id', $item->attribute_id)
            ->where('color_id', $item->color_id)
            ->increment('quantity', $item->quantity);
        }

        // $orderProduct->delete();

        // $order->delete();

        // Status update
        $order->status = 'cancelled'; // Or any status logic
        $order->save();

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }



}
