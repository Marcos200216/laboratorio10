<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTaskController;

Route::get('/tasks', [ApiTaskController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/tasks', [ApiTaskController::class, 'getUserTasks']);
    Route::put('/tasks/{task}', [ApiTaskController::class, 'update']);
    Route::delete('/tasks/{task}', [ApiTaskController::class, 'destroy']);
});
