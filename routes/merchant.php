<?php

use App\Models\Merchant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MerchantAuthController;
use App\Http\Controllers\MerchantUserController;
use App\Http\Controllers\OrderDeliverController;
use App\Http\Controllers\FrontCustomizeController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SubscriptionController;

// Signin & Signup
Route::get('/signin', [MerchantAuthController::class, 'signin_view'])->name('signin.view');
Route::post('/signin', [MerchantAuthController::class, 'signin'])->name('signin');
Route::get('/signup', [MerchantAuthController::class, 'signup_view'])->name('signup.view');
Route::post('/signup', [MerchantAuthController::class, 'signup'])->name('signup');

// Signout
Route::post('/signout', [MerchantAuthController::class, 'sign_out'])->name('signout');

// Merchant Email Verification
Route::get('/merchant/verify/{email}', [MerchantAuthController::class, 'merchant_verify'])->name('merchant.verify');
Route::post('/merchant/verified/{email}', [MerchantAuthController::class, 'merchant_verified'])->name('merchant.verified');
Route::get('/change/email/{email}', [MerchantAuthController::class, 'change_email_view'])->name('change.email.view');
Route::post('/changed/email/{id}', [MerchantAuthController::class, 'changed_email'])->name('changed.email');

// Shop Create
Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
Route::post('/shop/store', [ShopController::class, 'store'])->name('shop.store');
Route::post('/check-shop-url', [ShopController::class, 'checkShopUrl'])->name('check.shop.url');




// Merchant Middleware Group
Route::middleware('merchant')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('merchant.dashboard');

    // Profile Controller
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update./{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password/{user}', [ProfileController::class, 'profile_password'])->name('profile.password');

    // Shop Controller Routes
    Route::get('/shop', [ShopController::class, 'index'])->middleware('merchant')->name('shop.index');
    Route::get('/shop/{id}/qr-code', [ShopController::class, 'getQrCode']);
    Route::post('/shop/update/{id}', [ShopController::class, 'update'])->middleware('merchant')->name('shop.update');
    Route::post('/shop/url/update/{id}', [ShopController::class, 'url_update'])->middleware('merchant')->name('shop.url.update');
    Route::get('/customer/list', [ShopController::class, 'customer_list'])->name('customer.list');

    // PaymentGateway Controller
    Route::get('/payment', [PaymentGatewayController::class, 'index'])->middleware('merchant')->name('payment.index');
    Route::post('/payment/cod/{id}', [PaymentGatewayController::class, 'payment_cod'])->name('payment.cod');
    Route::post('/payment/ssl/{id}', [PaymentGatewayController::class, 'payment_ssl'])->name('payment.ssl');
    Route::post('/payment/bkash/{id}', [PaymentGatewayController::class, 'payment_bkash'])->name('payment.bkash');

    // SMS Setup
    Route::get('/sms', [SmsController::class, 'index'])->name('sms.index');
    Route::post('/sms/update/{id}', [SmsController::class, 'sms_update'])->name('sms.update');

    //Delivery System Configure
    Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery.index');
    Route::post('/delivery/redx/{id}', [DeliveryController::class, 'delivery_redx'])->name('delivery.redx');
    Route::post('/delivery/steadfast/{id}', [DeliveryController::class, 'delivery_steadfast'])->name('delivery.steadfast');
    Route::post('/delivery/pathao/{id}', [DeliveryController::class, 'delivery_pathao'])->name('delivery.pathao');

    //Chat Support Controller
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/update/{id}', [ChatController::class, 'update'])->name('chat.update');

    // Merchant User Permission
    Route::get('/user', [MerchantUserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [MerchantUserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [MerchantUserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [MerchantUserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [MerchantUserController::class, 'update'])->name('user.update');
    Route::get('/user/delete/{id}', [MerchantUserController::class, 'delete'])->name('user.delete');
    Route::post('/user/status/update/{id}', [MerchantUserController::class, 'user_status_update'])->name('user.status.update');

    // Front Customize Controller
    Route::get('/banner/image', [FrontCustomizeController::class, 'banner_image'])->name('front.banner.image');
    Route::post('/banner/image/update', [FrontCustomizeController::class, 'banner_image_update'])->name('banner.image.update');
    Route::get('/banner/item', [FrontCustomizeController::class, 'banner_item'])->name('front.banner.item');
    Route::post('/banner/item/create', [FrontCustomizeController::class, 'banner_item_create'])->name('banner.item.create');
    Route::get('/banner/item/edit/{id}', [FrontCustomizeController::class, 'banner_item_edit'])->name('front.banner.item.edit');
    Route::post('/banner/item/update/{id}', [FrontCustomizeController::class, 'banner_item_update'])->name('banner.item.update');
    Route::post('/banner/status/update/{id}', [FrontCustomizeController::class, 'banner_status_update'])->name('banner.status.update');
    Route::delete('/banner/item/delete/{id}', [FrontCustomizeController::class, 'banner_item_delete'])->name('front.banner.item.delete');
    Route::get('/front/favicon', [FrontCustomizeController::class, 'favicon'])->name('front.favicon');
    Route::post('/favicon/update', [FrontCustomizeController::class, 'favicon_update'])->name('favicon.update');

    //Extra Route Controller
    Route::controller(CategoryController::class)->name('category.')->prefix('category')->group(function () {
        Route::post('/status/update/{id}', 'status_update')->name('status.update');
    });

    Route::controller(AttributeController::class)->name('attribute.')->prefix('attribute')->group(function () {
        Route::post('/size/store', 'size_store')->name('size.store');
        Route::get('/get-attributes/{category_id}', 'getAttributes')->name('get.attributes');
    });

    Route::controller(ProductController::class)->name('product.')->prefix('product')->group(function () {
        Route::post('/status/update/{id}', 'status_update')->name('status.update');
        Route::delete('/gallery/delete', 'deleteGallery')->name('gallery.delete');
        Route::get('/inventory/{slug}', 'inventory')->name('inventory');
        Route::post('/inventory/store/{id}', 'inventory_store')->name('inventory.store');
        Route::post('/inventory/update/{id}', 'inventory_update')->name('inventory.update');
        Route::delete('/inventory/destroy/{id}', 'inventory_destroy')->name('inventory.destroy');
    });

    Route::controller(CouponController::class)->name('coupon.')->prefix('coupon')->group(function () {
        Route::post('/status/update/{id}', 'status_update')->name('status.update');
    });

    Route::controller(ReviewController::class)->group(function () {
        Route::get('/review/list', 'review_list')->name('review.list');
        Route::delete('/review/destroy/{id}', 'review_destroy')->name('review.destroy');
        Route::post('/review/approve/{id}', 'review_approve')->name('review.approve');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/order/list', 'index')->name('order.index');
        Route::get('/order/deliver', 'deliver')->name('order.deliver');
        Route::get('/order/complate', 'complate')->name('order.complate');
        Route::get('/order/cancel', 'cancel')->name('order.cancelled');
        Route::get('/order/details/{oeder_id}', 'details')->name('order.details');
        Route::post('/order/status/update/{id}', 'order_status_update')->name('order.status.update');
    });

    Route::controller(OrderDeliverController::class)->group(function () {
        Route::post('/steadfast/delivery', 'steadfast_delivery')->name('steadfast.delivery');
        Route::post('/redx/delivery', 'redx_delivery')->name('redx.delivery');
    });

    Route::controller(SocialMediaController::class)->group(function () {
        Route::get('/socialMedia', 'index')->name('socialMedia.index');
        Route::post('/socialMedia/store', 'store')->name('socialMedia.store');
        Route::post('/socialMedia/update/{id}', 'update')->name('socialMedia.update');
        Route::get('/socialMedia/delete/{id}', 'delete')->name('socialMedia.delete');
    });

    // Permission Controller
    Route::controller(PermissionController::class)->group(function () {
        Route::get('/accessDeny', 'accessDeny')->name('accessDeny');
    });

    // Report Controller
    Route::controller(ReportController::class)->group(function () {
        Route::get('/report/order/{data?}', 'order')->name('report.order');
        Route::get('/report/product/{data?}', 'product')->name('report.product');
    });

    // Subscription Controller
    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('/subscription', 'index')->name('subscription.index');
        Route::post('/subscription/store', 'subscription')->name('subscription');
        Route::get('/subscription/pay', 'pay')->name('subscription.pay');
    });

     // Resource Controller
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/attribute', AttributeController::class);
    Route::resource('/color', ColorController::class);
    Route::resource('/coupon', CouponController::class);



});
