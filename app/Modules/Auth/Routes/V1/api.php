<?php

namespace App\Modules\Auth\Routes\V1;

use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Controllers\Api\V1\AuthController;

Route::prefix('v1/auth')->group(function () {
    Route::post('login',[AuthController::class,'login']);
});