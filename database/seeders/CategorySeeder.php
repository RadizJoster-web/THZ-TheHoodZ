<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Seeder untuk 4 kategori utama produk TheHoodZ.
 */
class CategorySeeder extends Seeder
{
    /**
     * Menjalankan seeding kategori pakaian.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Baju',
                'slug' => 'baju',
                'description' => 'Koleksi T-Shirt boxy & oversized cotton combed 24s/20s',
            ],
            [
                'name' => 'Jacket',
                'slug' => 'jacket',
                'description' => 'Koleksi Coach Jacket, Varsity, dan Work Jacket THZ',
            ],
            [
                'name' => 'Sweater',
                'slug' => 'sweater',
                'description' => 'Koleksi Crewneck Sweater fleece tebal premium',
            ],
            [
                'name' => 'Hoodie',
                'slug' => 'hoodie',
                'description' => 'Koleksi Signature Heavyweight Hoodie TheHoodZ',
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
