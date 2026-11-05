<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model entitas pengguna (Admin dan Customer) TheHoodZ.
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Konversi tipe data atribut.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke seluruh pesanan yang dibuat oleh pengguna.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Relasi many-to-many konseptual ke produk yang dipesan melalui tabel orders.
     */
    public function orderedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders')
            ->withPivot('quantity', 'total_price', 'status')
            ->withTimestamps();
    }

    /**
     * Memeriksa apakah pengguna memiliki role admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
