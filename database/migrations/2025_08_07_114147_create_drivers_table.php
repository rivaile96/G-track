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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->unique();
            $table->string('ktp_number')->unique();
            $table->string('sim_type');
            $table->string('sim_number')->unique();
            $table->date('sim_expiry_date');
            $table->string('photo_path')->nullable();
            $table->text('address')->nullable();
            $table->enum('status', ['available', 'on_duty'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
