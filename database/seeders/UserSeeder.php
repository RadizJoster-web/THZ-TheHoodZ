<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder untuk data akun awal Admin dan Customer.
 */
class UserSeeder extends Seeder
{
    /**
     * Menjalankan seeding akun pengguna.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@thehoodz.com'],
            [
                'name' => 'Admin TheHoodZ',
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@thehoodz.com'],
            [
                'name' => 'Budi Streetwear',
                'username' => 'budistreet',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ]
        );
    }
}
