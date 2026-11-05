<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Model entitas produk pakaian TheHoodZ.
 */
class Product extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'size',
        'price',
        'stock',
        'image',
        'images',
        'description',
    ];

    /**
     * Konversi tipe data atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'images' => 'array',
        'price' => 'integer',
        'stock' => 'integer',
    ];

    /**
     * Boot model untuk otomatis membuat slug dari nama produk.
     */
    protected static function booted(): void
    {
        static::saving(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name . '-' . Str::random(5));
            }
        });
    }

    /**
     * Relasi ke kategori pemilik produk ini.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke seluruh pesanan untuk produk ini.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
