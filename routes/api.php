<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Auth\AuthController;
use App\Http\Controllers\API\v1\Post\FavouriteController;

Route::prefix('v1')->group(function () {

    Route::controller(AuthController::class)->prefix('user')->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'loginOne');
    });
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::controller(PostController::class)->prefix('post')->group(function(){
            Route::post('store', 'store')->name('store');
        });

        Route::controller(FavouriteController::class)->prefix('favourite')->group(function(){
            Route::post('store' , 'store');
        });
    });
});
