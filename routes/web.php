<?php

use App\Http\Controllers\CategoryMenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuKateringController;
use App\Http\Controllers\MerchantProfileController;
use App\Http\Controllers\OrderController;
use App\Models\MenuKatering;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::prefix('merchant')->group(function () {
       Route::get('/detail', [MerchantProfileController::class, 'edit'])->name('merchant.edit');
       Route::patch('/detail', [MerchantProfileController::class, 'update'])->name('merchant.update');
    });
    
    Route::prefix('menu-makanan')->group( function () { 
        Route::get('/list', [MenuKateringController::class, 'index'])->name('menu.list');
        Route::get('/form/{id}', [MenuKateringController::class, 'form'])->name('menu.form');
        Route::post('/form', [MenuKateringController::class, 'store'])->name('menu.store');
        Route::post('/form/{id}', [MenuKateringController::class, 'update'])->name('menu.update');
        Route::delete('/delete/{id}', [MenuKateringController::class, 'delete'])->name('menu.delete');
    });

    Route::prefix('menu-category')->group(function () {
       Route::get('/option', [CategoryMenuController::class, 'optionData'])->name('category.json'); 
    });

    Route::prefix('order')->group(function () {
        Route::get('/detail/{id}', [OrderController::class, 'details'])->name('menu.detail');
        Route::get('/list', [OrderController::class, 'index'])->name('order.list');
    });
});


require __DIR__.'/auth.php';
