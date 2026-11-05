<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Model entitas kategori produk pakaian TheHoodZ.
 */
class Category extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Boot model untuk otomatis membuat slug dari nama.
     */
    protected static function booted(): void
    {
        static::saving(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Relasi one-to-many ke produk dalam kategori ini.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
