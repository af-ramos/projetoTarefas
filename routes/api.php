<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

// USER ROUTES

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
});

// PROJECT ROUTES

Route::middleware('auth:api')->group(function () {
    Route::get('projects', [ProjectController::class, 'list']);
    Route::post('projects', [ProjectController::class, 'create']);
});