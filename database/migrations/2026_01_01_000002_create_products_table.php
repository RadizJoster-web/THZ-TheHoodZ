<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel master produk pakaian TheHoodZ.
 */
return new class extends Migration
{
    /**
     * Menjalankan migrasi tabel products.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('size', ['S', 'M', 'L', 'XL', 'XXL']);
            $table->unsignedInteger('price');
            $table->unsignedInteger('stock')->default(0);
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi tabel products.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
