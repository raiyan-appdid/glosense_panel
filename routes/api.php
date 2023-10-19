<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Auth\AuthController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\BasicController;
use App\Http\Controllers\API\v1\Order\CcAvenueOrderController;
use App\Http\Controllers\API\v1\Post\FavouriteController;

Route::prefix('v1')->group(function () {


    Route::controller(AuthController::class)->prefix('user')->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'loginOne');
        Route::post('logout', 'logout')->middleware(['auth:sanctum']);
    });
    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::get('user-detail', [UserController::class, 'detail']);

        Route::controller(PostController::class)->prefix('post')->group(function () {
            Route::post('store', 'store')->name('store');
        });

        Route::controller(FavouriteController::class)->prefix('favourite')->group(function () {
            Route::post('store', 'store');
        });
    });




    Route::prefix('order')->controller(CcAvenueOrderController::class)->group(function () {
        Route::get('store', 'store');
    });

    Route::get('slider', [BasicController::class, 'getSlider']);
    Route::post('promo-code', [BasicController::class, 'verifyPromoCode']);


    Route::get('example', function () {
        return "raiyan";
    });
});
