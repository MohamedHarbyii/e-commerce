<?php

use App\Http\Controllers\Payments\PaymentController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pay', [PaymentController::class, 'store']);
});
