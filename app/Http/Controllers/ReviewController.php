<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Coupon;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Review store for customer
    function customer_review(Request $request, $shopUrl)
    {
        if (!in_array(Auth::guard('merchant')->user()->permission, ['1', '2', '3'])) {
            return redirect()->route('accessDeny');
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'rating' => 'required',
            'review' => 'required',
        ]);

        Review::create([
            'shop_id' => $request->shop_id,
            'product_id' => $request->product_id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'rating' => $request->input('rating'),
            'review' => $request->input('review'),
        ]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }

    // Review List for merchant
    function review_list()
    {
        $shop_id = Auth::guard('merchant')->user()->shop_id;
        $new_reviews = Review::where('shop_id', $shop_id)->where('status', '0')->get();
        $approved_reviews = Review::where('shop_id', $shop_id)->where('status', '1')->latest()->get();
        $shopUrl = Shop::where('shop_id', $shop_id)->first()->url;
        return view('merchant.review.index', compact('new_reviews', 'approved_reviews', 'shopUrl'));
    }

    public function review_destroy(string $id)
    {
        $refiew = Review::find($id);
        try {
            $refiew->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Review Deleted Successfully'], 200);
    }

    public function review_approve(string $id)
    {
        $refiew = Review::find($id);
        $refiew->status = 1;
        $refiew->save();
        return redirect()->back()->with('success', 'Review Approved Successfully!');
    }
}
