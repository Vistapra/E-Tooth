<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use Chatify\Http\Controllers\Api\MessagesController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');
Route::get('/details/{product:slug}', [FrontController::class, 'details'])->name('front.product.details');
Route::get('/category/{category}', [FrontController::class, 'category'])->name('front.product.category');

// Consultation Routes
Route::get('/konsultasi', [FrontController::class, 'konsultasi'])->name('front.konsultasi');

// History Routes
Route::get('/riwayat', [FrontController::class, 'riwayat'])->name('front.riwayat');

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class)->middleware('role:owner');
        Route::resource('categories', CategoryController::class)->middleware('role:owner');
        Route::resource('doctor', DoctorController::class)->middleware('role:owner');
    });
});

// Load Auth Routes
require __DIR__ . '/auth.php';