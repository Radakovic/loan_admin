<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::patch('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/export', [ProductController::class, 'exportCsv'])->name('products.export');
    Route::put('/products/cash_loan/{product?}', [ProductController::class, 'upsertCashLoan'])->name('products.updateCashLoan');
    Route::put('/products/home_loan/{product?}', [ProductController::class, 'upsertHomeLoan'])->name('products.updateHomeLoan');
});

require __DIR__.'/auth.php';
