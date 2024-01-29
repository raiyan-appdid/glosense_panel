<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::controller(SiteController::class)->group(function () {
    Route::get('google/callback', 'googleCallback')->name('google.callback');
    Route::get('google/login', 'googleLogin')->name('google.login');
    Route::get('user-logout', 'logout')->name('user-logout');
    // Route::get('/', 'index')->name('/');
    Route::get('home', 'home')->name('home');
    Route::get('about', 'about')->name('about');
    Route::get('contact', 'contact')->name('contact');
    Route::post('contact-request', 'contactRequest')->name('contact-request');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('faq', 'faq')->name('faq');
    Route::get('blog', 'blog')->name('blog');
    Route::get('blog-detail', 'blogDetail')->name('blog-detail');
    Route::get('wishlist', 'wishlist')->name('wishlist');
    Route::get('product', 'product')->name('product');
    Route::get('product-detail/{slug}', 'productDetail')->name('product-detail');
    Route::get('track-order', 'trackOrder')->name('track-order');
    Route::post('add-wishlist', 'addWishlist')->name('add-wishlist');
    Route::post('remove-wishlist', 'removeWishlist')->name('remove-wishlist');
    Route::get('get-cart-data', 'getCartData')->name('get-cart-data');
    Route::get('cart', 'cart')->name('cart');
    Route::post('add-to-cart', 'addToCart')->name('add-to-cart');
    Route::post('update-cart', 'updateCard')->name('update-cart');
    Route::post('delete-cart-item', 'deleteCardItem')->name('delete-cart-item');
    Route::post('clear-cart', 'clearCart')->name('clear-cart');
    Route::post('apply-promocode', 'promocodeValidate')->name('apply-promocode');
    Route::get('search', 'search')->name('search');
});

// Route::middleware(['auth'])->group(function () {
//     Route::controller(OrderController::class)->group(function () {
//         Route::post('place-order', 'placeOrder')->name('place-order');
//         Route::get('payment-callback', "fetchPaymentDetail")->name('payment-callback');
//         Route::get('fetch-pay', "fetchPay")->name('fetch-pay');
//         Route::get('test', 'test')->name('test');
//     });
// });
