<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskAPIController;

Route::prefix('api')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('api')->middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

Route::prefix('api')->middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskAPIController::class, 'index']);
    Route::post('/tasks', [TaskAPIController::class, 'store']);
    Route::get('/tasks/{id}', [TaskAPIController::class, 'show']);
    Route::put('/tasks/{id}', [TaskAPIController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskAPIController::class, 'destroy']);
});
