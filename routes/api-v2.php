<?php

use App\Http\Controllers\API\v2\Order\CcAvenueOrderController;
use App\Http\Controllers\API\v3\Order\CcAvenueOrderController as OrderCcAvenueOrderController;

Route::prefix('v2')->group(function () {
    Route::prefix('order')->controller(CcAvenueOrderController::class)->group(function () {
        Route::get('store', 'store');
    });
});
Route::prefix('v3')->group(function () {
    Route::prefix('order')->controller(OrderCcAvenueOrderController::class)->group(function () {
        Route::get('store', 'store');
    });
});
