<?php

namespace App\Modules\Auth\Routes\V1;

use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Controllers\Api\V1\AuthController;

Route::prefix('v1/auth')->group(function () {

    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::post('forgot-password',[AuthController::class,'forgotPassword']);
    Route::post('reset-password',[AuthController::class,'resetPassword']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout',[AuthController::class,'logout']);
    });

});
