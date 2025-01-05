<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\WishlistController;

// Index View
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/search', [FrontendController::class, 'searchAll'])->name('searchAll');
Route::get('/track', [FrontendController::class, 'order_track'])->name('order.track');


// Shop View
// Route::get('/{shopName}', [FrontendController::class, 'shop'])->name('shop');

Route::prefix('{shopUrl}')
    ->middleware('ValidateShop') // Validate the shop based on shopUrl
    ->group(function () {
        Route::get('/', [FrontendController::class, 'shop'])->name('home');
        Route::get('/category/{slug}', [FrontendController::class, 'category_product'])->name('category.product');
        Route::get('/products', [FrontendController::class, 'products'])->name('shop.products');
        Route::get('/product/{slug}', [FrontendController::class, 'single_product'])->name('shop.product');

        Route::get('/getAttribute', [CartController::class, 'getAttribute']);
        Route::get('/getPrice', [CartController::class, 'getPrice']);

        Route::post('/cart/store', [CartController::class, 'cart_store'])->name('cart.store');
        Route::get('/cart', [CartController::class, 'cart'])->name('cart');
        Route::post('/updateCart', [CartController::class, 'updateCart'])->name('updateCart');
        Route::post('/deleteProduct', [CartController::class, 'deleteProduct'])->name('deleteProduct');
        Route::post('/setShipping', [CartController::class, 'setShipping'])->name('setShipping');


        Route::get('/checkout/{coupon_code?}', [CheckoutController::class, 'checkout'])->name('checkout');
        Route::post('/order/store', [OrderController::class, 'order_store'])->name('order.store');
        Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('sslpay');
        Route::get('/order/placed', [OrderController::class, 'order_placed'])->name('order.placed');


        Route::get('/wishlist', [CustomerController::class, 'wishlist'])->name('wishlist');
        Route::get('/wishlist/store/{product_id}', [CustomerController::class, 'wishlist_store'])->name('wishlist.store');
        Route::get('/wishlist/remove/{product_id}', [CustomerController::class, 'wishlist_remove'])->name('wishlist.remove');

        Route::get('/customer/auth', [CustomerAuthController::class, 'customer_auth'])->name('customer.auth');
        Route::post('/customer/register', [CustomerAuthController::class, 'customer_register'])->name('customer.register');
        Route::get('/customer/verify/{phone}', [CustomerAuthController::class, 'customer_verify'])->name('customer.verify');
        Route::post('/customer/verified/{phone}', [CustomerAuthController::class, 'customer_verified'])->name('customer.verified');
        Route::get('/customer/resend_otp/{phone}', [CustomerAuthController::class, 'resend_otp'])->name('resend.otp');
        Route::post('/customer/logedin', [CustomerAuthController::class, 'customer_logedin'])->name('customer.logedin');
        Route::get('/customer/logout', [CustomerAuthController::class, 'customer_logout'])->name('customer.logout');
        Route::get('/forgot/password', [CustomerAuthController::class, 'forgot_password'])->name('forgot.password');
        Route::post('/forgot/otp', [CustomerAuthController::class, 'forgot_otp'])->name('forgot.otp');
        Route::get('/otp/verify/{phone}', [CustomerAuthController::class, 'forgot_otp_verify'])->name('forgot.otp.verify');
        Route::post('/forget/new/password/{phone}', [CustomerAuthController::class, 'forget_new_password'])->name('forget.new.password');
        Route::post('/forget/password/update/{phone}', [CustomerAuthController::class, 'forget_password_update'])->name('forget.password.update');


        Route::middleware('customer')->group(function () {
            Route::controller(CustomerController::class)->group(function () {
                Route::get('/account', 'account')->name('account');
                Route::get('/account/setting', 'account_setting')->name('account.setting');
                Route::post('/account/update', 'account_update')->name('account.update');
                Route::get('/ordered/list', 'ordered_list')->name('ordered.list');
                Route::post('/order/cancel/{id}', 'order_cancel')->name('order.cancel');
                Route::post('/cart/coupon', 'cart_coupon')->name('cart.coupon');
                Route::post('/coupon/remove', 'coupon_remove')->name('coupon.remove');
            });
        });

        Route::get('/invoice/{order_id}', [InvoiceController::class, 'invoice'])->name('invoice');
        Route::post('/customer/review', [ReviewController::class, 'customer_review'])->name('customer.review');
        Route::get('/track', [FrontendController::class, 'track'])->name('track');
        Route::get('/search', [FrontendController::class, 'search'])->name('search');

    });

    //SSLCOMMERZ START
    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    //SSLCOMMERZ END

