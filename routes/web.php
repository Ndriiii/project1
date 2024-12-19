<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Configuration\Middleware as ConfigurationMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Middleware\Middleware;
use Monolog\Handler\RotatingFileHandler;

Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('admin/admin', [ProductController::class, 'display'])->name('admin.dashboard');
    Route::post('add-product', [ProductController::class, 'store'])->name('admin.add-product');
    Route::put('admin/admin/edit/{id}', [ProductController::class, 'update'])->name('admin.update-product');
    Route::delete('admin/admin/delete/{id}', [ProductController::class, 'destroy'])->name('admin.delete-product');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::put('/profile', [AuthManager::class, 'updateProfile'])->name('profile.update');

Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/', [HomeController::class, 'main'])->name('main');
Route::get('/offers', [HomeController::class, 'offers'])->name('offers');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/clothing', [HomeController::class, 'clothing'])->name('clothing');
Route::get('/gaming', [HomeController::class, 'gaming'])->name('gaming');
Route::get('/other', [HomeController::class, 'other'])->name('other');

Route::post('/login', [AuthManager::class, 'loginPost'])->name('login');
Route::post('/register', [AuthManager::class, 'registerPost'])->name('register');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');