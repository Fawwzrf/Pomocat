<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController; // <-- Tambahkan ini

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Grup untuk semua rute yang memerlukan otentikasi
Route::middleware('auth:sanctum')->group(function () {
    // Ini akan secara otomatis membuat semua endpoint CRUD untuk TaskController
    Route::apiResource('tasks', TaskController::class);

    // Route spesifik untuk update sessions_completed
    Route::put('/tasks/{task}/complete-session', [TaskController::class, 'completeSession']);
});
