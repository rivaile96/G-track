<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            // Hapus kolom 'assigned_to' yang lama (berisi teks), jika masih ada.
            if (Schema::hasColumn('assets', 'assigned_to')) {
                $table->dropColumn('assigned_to');
            }
            
            // Tambahkan kolom baru 'driver_id' yang terhubung ke tabel 'drivers'
            // onDelete('set null') artinya jika driver dihapus, kolom ini akan jadi kosong (null)
            $table->foreignId('driver_id')->nullable()->after('status')->constrained('drivers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign(['driver_id']);
            $table->dropColumn('driver_id');
            $table->string('assigned_to')->nullable(); // Kembalikan kolom lama jika di-rollback
        });
    }
};
