<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk halaman utama (Dashboard)
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');


// === RUTE UNTUK FITUR ASET (CRUD) ===

// Menampilkan semua aset (Read)
Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');

// Menampilkan form tambah aset (Create - Form)
Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');

// Menyimpan data aset baru (Create - Process)
Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');

// Menampilkan form edit aset (Update - Form)
Route::get('/assets/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit');

// Memproses update data aset (Update - Process) <-- INI YANG BARU DITAMBAHKAN
Route::patch('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update');

// Menghapus data aset (Delete)
Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy');