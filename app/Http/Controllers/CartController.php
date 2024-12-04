<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function getAttribute(Request $request)
    {
        $colors = Variant::where('product_id', $request->product_id)
            ->where('attribute_id', $request->attribute_id)
            ->get();

        $str = '';
        foreach ($colors as $color) {
            $str .= '<option value="' . $color->color_id . '">' . $color->color->name . '</option>';
        }

        return response($str);
    }




    public function getPrice(Request $request)
    {
        $product_id = $request->product_id;
        $attribute_id = $request->attribute_id;
        $color_id = $request->color_id;

        $variant = Variant::where('product_id', $product_id)
            ->where('attribute_id', $attribute_id)
            ->where('color_id', $color_id)
            ->first();

        if ($variant) {
            return response()->json([
                'success' => true,
                'data' => [
                    'current_price' => $variant->current_price,
                    'regular_price' => $variant->regular_price,
                    'quantity' => $variant->quantity
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Variant not found!'
            ]);
        }
    }

    public function cart_store(Request $request, $shopUrl)
    {
        $current_price = Variant::where('product_id', $request->product_id)->where('attribute_id', $request->attribute_id)->where('color_id', $request->color_id)->first()->current_price;


        $cartData = json_decode(Cookie::get('cart'), true);

        // If no cart data exists, initialize it
        if (!$cartData) {
            $cartData = [];
        }

        // Check if the shopUrl already exists in the cart
        if (isset($cartData[$shopUrl])) {
            $productExists = false;

            foreach ($cartData[$shopUrl] as $product) {
                if ($product['product_id'] == $request->product_id && $product['attribute_id'] == $request->attribute_id && $product['color_id'] == $request->color_id) {
                    $productExists = true;
                    break;
                }
            }

            if ($productExists) {
                return redirect()->back()->with('error', 'Product already exists in cart.');
            }
        }

        // Prepare product data for the cart
        $productData = [
            'product_id' => $request->product_id,
            'attribute_id' => $request->attribute_id,
            'color_id' => $request->color_id,
            'current_price' => $current_price,
            'quantity' => $request->quantity,
        ];

        // Add product to the respective shop's cart
        $cartData[$shopUrl][] = $productData;

        // Save updated cart to cookies
        Cookie::queue('cart', json_encode($cartData), 60 * 24 * 30);


        if($request->submit_button == 'add_to_cart'){
            return redirect()->back()->with('success', 'Product added to cart successfully.');
        }else{
            return redirect()->route('cart', $shopUrl)->with('success', 'Product added to cart successfully.');
        }
    }
    //Cart View
    public function cart($shopUrl)
    {
        $shop = Shop::where('url', $shopUrl)->first();

        if (!$shop) {
            return redirect()->route('home')->with('error', 'Shop not found.');
        }

        $cartData = json_decode(Cookie::get('cart'), true);

        if (!$cartData || !isset($cartData[$shopUrl])) {
            return view('frontend.shop.cart', ['shop' => $shop])->with('error', 'Cart is empty.');
        }

        $data = $cartData[$shopUrl];

        foreach ($data as &$item) {
            $product = Product::find($item['product_id']); // Fetch product by ID
            $attribute = Attribute::find($item['attribute_id'])->name; // Fetch attribute by ID
            $color = Color::find($item['color_id'])->name; // Fetch color by ID
            $item['product_name'] = $product->name ;
            $item['preview'] = $product->preview ;
            $item['attribute'] = $attribute ;
            $item['color'] = $color ;
        }

        // Initialize total variables
        $totalProducts = 0;
        $totalPrice = 0;

        // Iterate over cart items to calculate total products and price
        foreach ($data as $value) {
            $variant = Variant::where('product_id', $value['product_id'])
                      ->where('attribute_id', $value['attribute_id'])
                      ->where('color_id', $value['color_id'])
                      ->first();
            if ($variant) {
                $totalProducts += 1; // Sum quantity for total products
                $totalPrice += $variant->current_price * $value['quantity']; // Calculate total price
            }
        }

        return view('frontend.shop.cart', [
            'shop' => $shop,
            'data' => $data,
            'totalPrice' => $totalPrice,
        ]);
    }

    //Update Cart Data
    public function updateCart(Request $request)
    {
        $cart = json_decode(Cookie::get('cart'), true);
        $shopUrl = $request->shop_url;
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $attributeId = $request->attribute_id;  // Added attribute_id
        $colorId = $request->color_id;  // Added color_id

        // Check if the cart exists for the shop
        if (isset($cart[$shopUrl])) {
            // Loop through the products in the cart
            foreach ($cart[$shopUrl] as &$item) {
                // Update the item if product_id, attribute_id, and color_id match
                if ($item['product_id'] == $productId && $item['attribute_id'] == $attributeId && $item['color_id'] == $colorId) {
                    $item['quantity'] = $quantity;  // Update the quantity
                    break;  // Exit the loop once the product is found
                }
            }

            // Update the cart in cookies
            Cookie::queue('cart', json_encode($cart), 60 * 24 * 7); // Store for 7 days

            return response()->json(['success' => true, 'message' => 'Cart updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Product not found in cart.']);
    }


    //Delete Product from cart
    public function deleteProduct(Request $request, $shopUrl)
    {
        // Retrieve cart data from cookies
        $cartData = json_decode(Cookie::get('cart'), true);

        if (!$cartData || !isset($cartData[$shopUrl])) {
            return response()->json(['success' => false, 'message' => 'Cart is empty or shop URL is invalid.']);
        }

        // Get product ID
        $productId = $request->input('product_id');

        // Remove product from the shop's cart
        $shopCart = &$cartData[$shopUrl]; // Reference to the shop's cart array

        foreach ($shopCart as $index => $product) {
            if ($product['product_id'] == $productId) {
                unset($shopCart[$index]); // Remove product
                break;
            }
        }

        // Remove shop from cart if no products left
        if (empty($shopCart)) {
            unset($cartData[$shopUrl]);
        }

        // Update cookies
        Cookie::queue('cart', json_encode($cartData), 60 * 24 * 30); // Save updated cart for 30 days

        return response()->json(['success' => true, 'message' => 'Product removed successfully.']);
    }


    public function setShipping(Request $request)
    {
        // Set or update the shipping cookie
        $shippingCost = $request->shipping_cost;
        setcookie('shipping', $shippingCost, time() + (60 * 60 * 24 * 7), "/");

        // Return JSON response
        return response()->json([
            'status' => 'success',
            'message' => 'Shipping cost updated successfully.',
        ]);
    }




}



