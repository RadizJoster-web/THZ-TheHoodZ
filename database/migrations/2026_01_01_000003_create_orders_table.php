<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk tabel transaksi pesanan pelanggan.
 */
return new class extends Migration
{
    /**
     * Menjalankan migrasi tabel orders.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 50)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('total_price');
            $table->text('shipping_address');
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi tabel orders.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
