<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Perintah ini akan dieksekusi saat kita menjalankan `php artisan migrate`
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis (angka 1, 2, 3, ...)
            
            $table->string('name'); // Nama aset, misal: "Avanza B 1234 ABC"
            $table->string('unique_id')->unique(); // ID unik dari tracker/device, misal: "CAR-001"
            $table->enum('type', ['mobil', 'device']); // Jenis aset, hanya bisa diisi 'mobil' atau 'device'
            $table->enum('status', ['aktif', 'standby', 'maintenance'])->default('standby'); // Status aset, defaultnya 'standby'
            $table->string('assigned_to')->nullable(); // Siapa yang sedang pakai, boleh kosong
            
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     *
     * Perintah ini akan dieksekusi saat kita menjalankan `php artisan migrate:rollback`
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};