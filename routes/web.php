<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController; // <-- Pastikan ini ada

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah kita mendaftarkan semua rute untuk aplikasi web kita.
|
*/

// Rute untuk halaman utama (Dashboard)
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Rute untuk halaman Manajemen Aset
Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');

// Route untuk menampilkan form tambah aset baru
Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');

// Route untuk menyimpan data baru dari form
Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');

// Route untuk menghapus sebuah aset
Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy');