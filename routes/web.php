<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController; // <-- [BARU] Panggil DriverController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk halaman utama (Dashboard)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


// === RUTE UNTUK FITUR ASET (CRUD) ===
Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
Route::get('/assets/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit');
Route::patch('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update');
Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy');


// === [BARU] RUTE UNTUK FITUR DRIVER (CRUD) ===
Route::get('/drivers', [DriverController::class, 'index'])->name('drivers.index');
Route::get('/drivers/create', [DriverController::class, 'create'])->name('drivers.create');
Route::post('/drivers', [DriverController::class, 'store'])->name('drivers.store');
Route::get('/drivers/{driver}', [DriverController::class, 'show'])->name('drivers.show');
Route::get('/drivers/{driver}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
Route::patch('/drivers/{driver}', [DriverController::class, 'update'])->name('drivers.update');
Route::delete('/drivers/{driver}', [DriverController::class, 'destroy'])->name('drivers.destroy');
