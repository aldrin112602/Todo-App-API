<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskAPIController;
use Illuminate\Support\Facades\Cookie;

Route::get('/api/getCsrftoken', function() {
    return response()->json([
        'csrf_token' => csrf_token(),
    ]);
});

// get all task
Route::get('/api/tasks', [TaskAPIController::class, 'index']);

// make new task
Route::post('/api/tasks', [TaskAPIController::class, 'store']);

// get task
Route::get('/api/tasks/{id}', [TaskAPIController::class, 'show']);

// update task
Route::put('/api/tasks/{id}', [TaskAPIController::class, 'update']);

// remove task by id
Route::delete('/api/tasks/{id}', [TaskAPIController::class, 'destroy']);