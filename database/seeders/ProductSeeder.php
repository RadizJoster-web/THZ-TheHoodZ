<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * Seeder untuk 8 produk awal pakaian TheHoodZ (2 produk per kategori).
 */
class ProductSeeder extends Seeder
{
    /**
     * Menjalankan seeding data produk TheHoodZ.
     */
    public function run(): void
    {
        $hoodie = Category::where('slug', 'hoodie')->first();
        $jacket = Category::where('slug', 'jacket')->first();
        $sweater = Category::where('slug', 'sweater')->first();
        $baju = Category::where('slug', 'baju')->first();

        $products = [
            [
                'category_id' => $hoodie->id,
                'name' => 'THZ Signature Boxy Heavy Hoodie Black',
                'slug' => 'thz-signature-boxy-heavy-hoodie-black',
                'size' => 'L',
                'price' => 320000,
                'stock' => 25,
                'image' => 'products/hoodie-boxy-black.svg',
                'images' => ['products/hoodie-boxy-black.svg', 'products/detail-angle-1.svg', 'products/detail-angle-2.svg'],
                'description' => 'Heavyweight cotton fleece 380 gsm. Boxy fit drop-shoulder cut dengan saku kanguru ganda dan tali serut metal aglet.',
            ],
            [
                'category_id' => $hoodie->id,
                'name' => 'THZ Acid Washed Charcoal Hoodie',
                'slug' => 'thz-acid-washed-charcoal-hoodie',
                'size' => 'XL',
                'price' => 345000,
                'stock' => 15,
                'image' => 'products/hoodie-acid-washed.svg',
                'images' => ['products/hoodie-acid-washed.svg', 'products/detail-angle-1.svg'],
                'description' => 'Treatment acid wash unik pada kain terry fleece 360 gsm. Menghasilkan gradasi warna monokrom vintage streetwear.',
            ],
            [
                'category_id' => $jacket->id,
                'name' => 'THZ Urban Tactical Coach Jacket Olive',
                'slug' => 'thz-urban-tactical-coach-jacket-olive',
                'size' => 'L',
                'price' => 350000,
                'stock' => 12,
                'image' => 'products/jacket-coach-olive.svg',
                'images' => ['products/jacket-coach-olive.svg', 'products/detail-angle-2.svg'],
                'description' => 'Bahan taslan water-repellent dengan lapisan dalam furing jaring bernapas. Dilengkapi kancing snap matte black.',
            ],
            [
                'category_id' => $jacket->id,
                'name' => 'THZ Stealth Leather-Trim Varsity Jacket',
                'slug' => 'thz-stealth-leather-trim-varsity-jacket',
                'size' => 'M',
                'price' => 450000,
                'stock' => 8,
                'image' => 'products/jacket-varsity-black.svg',
                'images' => ['products/jacket-varsity-black.svg', 'products/detail-angle-1.svg'],
                'description' => 'Kombinasi wol premium pada badan dengan lengan semi-kulit sintetis tebal. Grafis bordir chenille khas TheHoodZ.',
            ],
            [
                'category_id' => $sweater->id,
                'name' => 'THZ Vintage Wash Crewneck Heather Grey',
                'slug' => 'thz-vintage-wash-crewneck-heather-grey',
                'size' => 'XL',
                'price' => 275000,
                'stock' => 18,
                'image' => 'products/sweater-vintage-grey.svg',
                'images' => ['products/sweater-vintage-grey.svg', 'products/detail-angle-2.svg'],
                'description' => 'Crewneck sweatshirt katun fleece 330 gsm dengan rib leher tebal anti melar. Sablon high-density logo THZ.',
            ],
            [
                'category_id' => $sweater->id,
                'name' => 'THZ Oversized Desert Sand Sweater',
                'slug' => 'thz-oversized-desert-sand-sweater',
                'size' => 'L',
                'price' => 285000,
                'stock' => 20,
                'image' => 'products/sweater-oversized-sand.svg',
                'images' => ['products/sweater-oversized-sand.svg', 'products/detail-angle-1.svg'],
                'description' => 'Warna earth tone earthy sand dengan potongan ultra-relaxed. Nyaman digunakan harian maupun cuaca dingin.',
            ],
            [
                'category_id' => $baju->id,
                'name' => 'THZ Heavy Graphic Boxy Tee Raw White',
                'slug' => 'thz-heavy-graphic-boxy-tee-raw-white',
                'size' => 'M',
                'price' => 165000,
                'stock' => 40,
                'image' => 'products/baju-heavy-white.svg',
                'images' => ['products/baju-heavy-white.svg', 'products/detail-angle-1.svg'],
                'description' => 'Cotton combed 16s heavy knit 235 gsm. Kerah tebal 3cm dengan sablon discharge grafis streetwear di punggung.',
            ],
            [
                'category_id' => $baju->id,
                'name' => 'THZ Stealth Pocket Tee Pitch Black',
                'slug' => 'thz-stealth-pocket-tee-pitch-black',
                'size' => 'L',
                'price' => 155000,
                'stock' => 30,
                'image' => 'products/baju-stealth-black.svg',
                'images' => ['products/baju-stealth-black.svg', 'products/detail-angle-2.svg'],
                'description' => 'T-shirt saku dada minimalis beraksen woven patch THZ neon. Bahan katun 20s lembut dan sejuk.',
            ],
        ];

        foreach ($products as $data) {
            Product::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
