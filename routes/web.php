<?php

use App\Http\Controllers\CategoryMenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuKateringController;
use App\Http\Controllers\MerchantProfileController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
        Route::get('/form', [MenuKateringController::class, 'form'])->name('menu.form');
        Route::post('/form', [MenuKateringController::class, 'store'])->name('menu.store');
    });

    Route::prefix('menu-category')->group(function () {
       Route::get('/option', [CategoryMenuController::class, 'optionData'])->name('category.json'); 
    });
});


require __DIR__.'/auth.php';
