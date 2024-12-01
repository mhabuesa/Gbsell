<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;

// Index View
Route::get('/', [FrontendController::class, 'index'])->name('index');


// Shop View
// Route::get('/{shopName}', [FrontendController::class, 'shop'])->name('shop');

Route::prefix('{shopUrl}')
    ->middleware('ValidateShop') // Validate the shop based on shopUrl
    ->group(function () {
        Route::get('/', [FrontendController::class, 'shop'])->name('home');
        Route::get('/category/{slug}', [FrontendController::class, 'category_product'])->name('category.product');
        Route::get('/products', [FrontendController::class, 'products'])->name('shop.products');
        Route::get('/product/{slug}', [FrontendController::class, 'single_product'])->name('shop.product');
        Route::get('/checkout', [FrontendController::class, 'checkout'])->name('shop.checkout');

        Route::get('/getAttribute', [CartController::class, 'getAttribute']);
        Route::get('/getPrice', [CartController::class, 'getPrice']);

        Route::post('/cart/store', [CartController::class, 'cart_store'])->name('cart.store');
        Route::get('/cart', [CartController::class, 'cart'])->name('cart');
        Route::post('/updateCart', [CartController::class, 'updateCart'])->name('updateCart');
        Route::post('/deleteProduct', [CartController::class, 'deleteProduct'])->name('deleteProduct');
        Route::post('/setShipping', [CartController::class, 'setShipping'])->name('setShipping');


        Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
        Route::post('/order/store', [OrderController::class, 'order_store'])->name('order.store');
        Route::get('/order/store', [OrderController::class, 'order_store'])->name('order.store');


        Route::post('/success', [OrderController::class, 'success']);



    });
