<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskAPIController;


Route::prefix('api')->group(function () {
    // get all task
    Route::get('/tasks', [TaskAPIController::class, 'index']);

    // make new task
    Route::post('/tasks', [TaskAPIController::class, 'store']);

    // get task
    Route::get('/tasks/{id}', [TaskAPIController::class, 'show']);

    // update task
    Route::put('/tasks/{id}', [TaskAPIController::class, 'update']);

    // remove task by id
    Route::delete('/tasks/{id}', [TaskAPIController::class, 'destroy']);
});
