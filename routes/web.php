<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'welcome'])->name('home');

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'doLogin'])->name('login.submit');

Route::get('/admin', [PageController::class, 'dashboard'])->name('admin.dashboard');

Route::resource('products', ProductController::class);