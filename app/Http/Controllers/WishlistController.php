<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Pagination\LengthAwarePaginator;

class WishlistController extends Controller
{
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


        return view('frontend.shop.wishlist', [
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

}
