<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Auth\AuthController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\BasicController;
use App\Http\Controllers\API\v1\Order\CcAvenueOrderController;
use App\Http\Controllers\API\v1\Post\FavouriteController;
use App\Http\Controllers\API\v1\ProductPageController;

Route::prefix('v1')->group(function () {


    Route::controller(AuthController::class)->prefix('user')->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'loginOne');
        Route::post('login-sms', 'loginOneSms');
        Route::post('login-email', 'loginEmail');
        Route::post('logout', 'logout')->middleware(['auth:sanctum']);
    });
    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::get('user-detail', [UserController::class, 'detail']);

        Route::controller(FavouriteController::class)->prefix('favourite')->group(function () {
            Route::post('store', 'store');
        });

        Route::get('get-order', [BasicController::class, 'getOrderById']);
    });
    Route::prefix('order')->controller(CcAvenueOrderController::class)->group(function () {
        Route::get('store', 'store');
    });

    Route::get('slider', [BasicController::class, 'getSlider']);
    Route::post('promo-code', [BasicController::class, 'verifyPromoCode']);
    Route::post('send-mail', [BasicController::class, 'sendOtpInMail']);
    Route::post('verify-and-change-password', [BasicController::class, 'verifyOtpAndChangePassword']);
    Route::get('reviews', [BasicController::class, 'getAllReviews']);
    Route::post('sms', [BasicController::class, 'sms']);
    Route::post('verify-sms-otp', [BasicController::class, 'verifySmsOtp']);
    Route::post('store-review', [BasicController::class, 'storeReview'])->middleware(['auth:sanctum']);
    Route::post('store-analytics', [BasicController::class, 'storeAnalytics'])->middleware(['auth:sanctum']);
    Route::post('store-anonymous-review', [BasicController::class, 'storeAnanomyousReview']);
    Route::get('get-heading', [BasicController::class, 'getHeading']);
    Route::post('store-email', [BasicController::class, 'storeEmail']);
    Route::get('product-image', [BasicController::class, 'productImage']);
    Route::get('all-blogs', [BasicController::class, 'allBlogs']);
    Route::get('blog-details', [BasicController::class, 'blogDetails']);

    Route::prefix('product')->controller(ProductPageController::class)->group(function () {
        Route::get('text-get', 'getText');
    });

    Route::get('example', function () {
        return "raiyan";
    });
});
