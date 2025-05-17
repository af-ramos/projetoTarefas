<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

// USER ROUTES

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->middleware(['register.log']);

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware(['register.log']);
});

// PROJECT ROUTES

Route::middleware('auth:api')->group(function () {
    Route::middleware(['register.log'])->group(function () {
        Route::post('projects', [ProjectController::class, 'create']);
        Route::put('projects/{id}', [ProjectController::class, 'update']);
    });

    Route::get('projects', [ProjectController::class, 'list']);
    Route::get('projects/{id}', [ProjectController::class, 'show']);
    Route::delete('projects/{id}', [ProjectController::class, 'delete']);
});

// TASKS ROUTES

Route::middleware('auth:api')->group(function () {
    Route::middleware(['register.log', 'send.notification'])->group(function () {
        Route::post('projects/{id}/tasks', [TaskController::class, 'create']);
        Route::put('tasks/{id}', [TaskController::class, 'update']);
    });

    Route::get('projects/{id}/tasks', [TaskController::class, 'list']);
    Route::get('tasks/{id}', [TaskController::class, 'show']);
    Route::delete('tasks/{id}', [TaskController::class, 'delete']);
});