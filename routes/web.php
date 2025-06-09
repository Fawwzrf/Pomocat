<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PomoTimeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;

// RUTE PUBLIK (Bisa diakses tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pomotime', [PomoTimeController::class, 'index'])->name('pomotime');
Route::get('/guide', [PageController::class, 'guide'])->name('guide');

Auth::routes();

// RUTE YANG MEMERLUKAN LOGIN
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');

    // Rute untuk rendering HTML & API yang butuh data user
    Route::get('/tasks/render', [TaskController::class, 'render'])->name('tasks.render');
    Route::post('/tasks/{task}/set-active', [TaskController::class, 'setActive'])->name('tasks.set-active');
    Route::apiResource('tasks', TaskController::class);
    Route::put('/tasks/{task}/complete-session', [TaskController::class, 'completeSession']);
    Route::delete('/tasks/clear/completed', [TaskController::class, 'clearCompleted'])->name('tasks.clear-completed');
    Route::delete('/tasks/clear/all', [TaskController::class, 'clearAll'])->name('tasks.clear-all');
    Route::get('/report/summary', [ReportController::class, 'summary'])->name('report.summary');
    Route::get('/report/details', [ReportController::class, 'details'])->name('report.details');
    Route::get('/report/export-csv', [ReportController::class, 'exportCsv'])->name('report.export-csv');
    Route::get('/report/ranking', [ReportController::class, 'ranking'])->name('report.ranking');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});
