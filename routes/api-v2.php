<?php

use App\Http\Controllers\API\v2\Order\CcAvenueOrderController;

Route::prefix('v2')->group(function () {
    Route::prefix('order')->controller(CcAvenueOrderController::class)->middleware(['auth:sanctum'])->group(function () {
        Route::get('store', 'store');
    });
});
