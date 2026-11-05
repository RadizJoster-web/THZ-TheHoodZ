<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeder master untuk memanggil seluruh sub-seeder TheHoodZ.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Menjalankan seluruh proses seeding database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
