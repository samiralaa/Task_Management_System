<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Task\TaskController;


Route::post('/login', [AuthController::class, 'login']);
Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('auth.login');
});


Route::middleware('auth:api')->prefix('tasks')->controller(TaskController::class)->group(function () {
    Route::get('/', 'index'); // List tasks with filters
    Route::post('/', 'store')->middleware('role:manager'); // Create task
    Route::get('/{id}', 'show'); // Get task details
    Route::delete('/{id}', 'destroy')->middleware('role:manager'); // Delete task
    Route::put('/{id}', 'update')->middleware('role:manager'); // Update task
    Route::patch('/{id}/status', 'updateStatus')->middleware('role:user'); // Update status
    Route::post('/{id}/dependencies', 'addDependency')->middleware('role:manager'); // Add dependencies
});
