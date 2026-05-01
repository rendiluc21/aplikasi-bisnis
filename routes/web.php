<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('items', ItemController::class);

Route::get('/stock-ins', [StockInController::class, 'index'])->name('stock-ins.index');
Route::get('/stock-ins/create', [StockInController::class, 'create'])->name('stock-ins.create');
Route::post('/stock-ins', [StockInController::class, 'store'])->name('stock-ins.store');

Route::get('/stock-outs', [StockOutController::class, 'index'])->name('stock-outs.index');
Route::get('/stock-outs/create', [StockOutController::class, 'create'])->name('stock-outs.create');
Route::post('/stock-outs', [StockOutController::class, 'store'])->name('stock-outs.store');
