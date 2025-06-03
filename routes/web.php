<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RankingController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/ranking', [RankingController::class, 'index'])->name('admin.ranking');
    Route::get('/admin/ranking/create', [RankingController::class, 'create'])->name('admin.ranking.create');
    Route::post('/admin/ranking/store', [RankingController::class, 'store'])->name('admin.ranking.store');
});
