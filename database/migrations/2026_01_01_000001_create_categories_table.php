<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel master kategori produk pakaian.
 */
return new class extends Migration
{
    /**
     * Menjalankan migrasi tabel categories.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 120)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi tabel categories.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
