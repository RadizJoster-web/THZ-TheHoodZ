<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Seeder untuk 5 data transaksi pesanan awal TheHoodZ.
 */
class OrderSeeder extends Seeder
{
    /**
     * Menjalankan seeding pesanan awal.
     */
    public function run(): void
    {
        $customer = User::where('role', 'customer')->first();
        $products = Product::all();

        if (!$customer || $products->isEmpty()) {
            return;
        }

        $samples = [
            [
                'order_code' => 'THZ-20260115-0001',
                'product' => $products[0],
                'quantity' => 1,
                'status' => 'completed',
                'created_at' => Carbon::now()->subMonths(3)->setDay(15),
            ],
            [
                'order_code' => 'THZ-20260210-0002',
                'product' => $products[2],
                'quantity' => 2,
                'status' => 'shipped',
                'created_at' => Carbon::now()->subMonths(2)->setDay(10),
            ],
            [
                'order_code' => 'THZ-20260305-0003',
                'product' => $products[4],
                'quantity' => 1,
                'status' => 'paid',
                'created_at' => Carbon::now()->subMonths(1)->setDay(5),
            ],
            [
                'order_code' => 'THZ-20260401-0004',
                'product' => $products[6],
                'quantity' => 2,
                'status' => 'paid',
                'created_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'order_code' => 'THZ-20260420-0005',
                'product' => $products[1],
                'quantity' => 1,
                'status' => 'pending',
                'created_at' => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($samples as $item) {
            $totalPrice = $item['product']->price * $item['quantity'];
            Order::updateOrCreate(
                ['order_code' => $item['order_code']],
                [
                    'user_id' => $customer->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'total_price' => $totalPrice,
                    'shipping_address' => 'Jl. Boulevard Raya Blok A4 No. 12, Kelapa Gading, Jakarta Utara',
                    'payment_proof' => null,
                    'status' => $item['status'],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['created_at'],
                ]
            );
        }
    }
}
