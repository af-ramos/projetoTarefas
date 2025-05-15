<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    // Route::post('login', [AuthController::class, 'login']);

    // Route::middleware('auth:api')->group(function () {
    //     Route::post('logout', [AuthController::class, 'logout']);
    //     Route::get('me', [AuthController::class, 'me']);
    // });
});