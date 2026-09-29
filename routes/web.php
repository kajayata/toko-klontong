<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'welcome'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [PageController::class, 'login'])->name('login');
    Route::post('/login', [PageController::class, 'doLogin'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [PageController::class, 'logout'])->name('logout');

    Route::get('/admin', [PageController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('products', ProductController::class)->only(['index', 'create', 'store', 'destroy']);
});
