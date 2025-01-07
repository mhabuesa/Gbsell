<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(function () {
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/dashboard', 'dashboard')->name('dashboard');
    });

    // Admin Profile route inside a prefixed group
    Route::name('admin.')->prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function(){
            Route::get('/profile', 'profile')->name('profile');
            Route::post('/profile/update', 'profile_update')->name('profile.update');
            Route::post('/profile/password', 'profile_password')->name('profile.password');
            Route::get('/shop', 'shop')->name('shop');
            Route::get('/shop/delete/{id}', 'shop_delete')->name('shop.delete');
            Route::get('/shop/details/{id}', 'shop_details')->name('shop.details');
            Route::post('/shop/status/update/{id}', 'status_update')->name('shop.status.update');
            Route::post('/subscription.update/{id}', 'subscription_update')->name('subscription.update');

            // Home Page Customize
            Route::get('/favicon', 'favicon')->name('home.favicon');
            Route::post('/favicon/update', 'favicon_update')->name('favicon.update');
            Route::get('/logo', 'logo')->name('home.logo');
            Route::post('/logo/update', 'logo_update')->name('logo.update');
            Route::get('/info', 'info')->name('home.info');
            Route::post('/info/update', 'info_update')->name('info.update');
            Route::get('/social', 'social')->name('home.social');
            Route::post('/social/update', 'social_update')->name('social.update');
            Route::get('/subcription', 'subcription')->name('subcription');
        });
    });

    // User Profile route
    Route::controller(UserController::class)->name('users.')->prefix('users')->group(function () {
        Route::post('/update-status/{user}', 'updateStatus')->name('status.update');
    });
    Route::resource('/users', UserController::class);
});



require __DIR__.'/auth.php';
require __DIR__.'/merchant.php';
require __DIR__.'/frontend.php';
