<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model entitas pesanan/transaksi pelanggan TheHoodZ.
 */
class Order extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_code',
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'shipping_address',
        'payment_proof',
        'status',
    ];

    /**
     * Konversi tipe data atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'total_price' => 'integer',
    ];

    /**
     * Relasi ke pengguna/pelanggan yang melakukan pemesanan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke produk yang dipesan.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
