<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryMenuController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuKateringController;
use App\Http\Controllers\MerchantProfileController;
use App\Http\Controllers\OrderController;
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

    Route::prefix('profile')->group(function () {
        Route::get('/address', [AddressController::class, 'index'])->name('address.list');
        Route::get('/form/{id}', [AddressController::class, 'form'])->name('address.input');
        Route::Post('/form', [AddressController::class, 'store'])->name('address.store');
        Route::post('/form/{id}', [AddressController::class, 'update'])->name('address.update');
        Route::delete('/delete/{id}', [AddressController::class, 'delete'])->name('address.delete');
    });
    
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
        Route::get('/list', [OrderController::class, 'index'])->name('order.list');
        Route::get('/detail/{id}', [OrderController::class, 'details'])->name('menu.detail');
    });

    Route::prefix('myorder')->group(function () {
       Route::get('/list', [CustomerOrderController::class, 'index'])->name('customer.order');
       
       Route::prefix('cart')->group(function () {
           Route::post('/add', [CustomerOrderController::class, 'addToCart'])->name('cart.add');
           Route::get('/list', [CustomerOrderController::class, 'getCart'])->name('cart.get');
           Route::delete('/remove', [CustomerOrderController::class, 'removeFormCart'])->name('cart.remove');
           Route::post('/checkout', [CustomerOrderController::class, 'chckoutProductFromCart'])->name('cart.checkout');
       });
    });

});


require __DIR__.'/auth.php';
