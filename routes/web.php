<?php // File: routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PomoTimeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('home');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Grup untuk semua rute yang memerlukan login
Route::middleware(['auth'])->group(function () {
    Route::get('/pomotime', [PomoTimeController::class, 'index'])->name('pomotime');

    // Rute untuk server-side rendering (HTML Partials)
    Route::get('/tasks/render', [TaskController::class, 'render'])->name('tasks.render');

    // Rute untuk API (JSON Responses) - yang dipindahkan dari api.php
    Route::apiResource('tasks', TaskController::class);
    Route::put('/tasks/{task}/complete-session', [TaskController::class, 'completeSession']);
    Route::delete('/tasks/clear/completed', [TaskController::class, 'clearCompleted'])->name('tasks.clear-completed');
    Route::delete('/tasks/clear/all', [TaskController::class, 'clearAll'])->name('tasks.clear-all');
    Route::get('/report/summary', [ReportController::class, 'summary'])->name('report.summary');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/report/details', [ReportController::class, 'details'])->name('report.details');
    Route::get('/report/export-csv', [ReportController::class, 'exportCsv'])->name('report.export-csv');
    Route::get('/report/ranking', [ReportController::class, 'ranking'])->name('report.ranking');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // =======================================================
    // == RUTE BARU UNTUK PASSWORD & FOTO ==
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::get('/guide', [PageController::class, 'guide'])->name('guide');


    // =======================================================
});
