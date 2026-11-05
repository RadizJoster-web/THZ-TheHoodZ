<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Service penyedia data statistik dan ringkasan metrik Dashboard Admin.
 */
class DashboardStatsService
{
    /**
     * Mengambil ringkasan KPI utama untuk summary cards dashboard.
     *
     * @return array<string, mixed>
     */
    public function getSummaryCards(): array
    {
        return [
            'total_revenue' => (int) Order::whereIn('status', ['paid', 'shipped', 'completed'])->sum('total_price'),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_products' => Product::count(),
            'total_stock' => (int) Product::sum('stock'),
            'total_customers' => User::where('role', 'customer')->count(),
        ];
    }

    /**
     * Menghitung pendapatan bulanan selama 6 bulan terakhir untuk grafik Chart.js.
     *
     * @return array<string, mixed>
     */
    public function getMonthlyRevenueChart(): array
    {
        $labels = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->translatedFormat('M Y');
            $revenue = Order::whereIn('status', ['paid', 'shipped', 'completed'])
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total_price');
            $data[] = (int) $revenue;
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /**
     * Menghitung persebaran stok pakaian berdasarkan kategori untuk grafik Chart.js.
     *
     * @return array<string, mixed>
     */
    public function getCategoryStockDistribution(): array
    {
        $categories = Category::withSum('products', 'stock')->get();

        return [
            'labels' => $categories->pluck('name')->toArray(),
            'data' => $categories->map(fn($cat) => (int) ($cat->products_sum_stock ?? 0))->toArray(),
        ];
    }

    /**
     * Menghitung total pesanan per status untuk widget progress.
     *
     * @return array<string, int>
     */
    public function getOrderStatusCounts(): array
    {
        return [
            'pending' => Order::where('status', 'pending')->count(),
            'paid' => Order::where('status', 'paid')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
    }

    /**
     * Mengambil 5 pesanan terbaru beserta relasinya.
     */
    public function getRecentOrders(): Collection
    {
        return Order::with(['user', 'product'])->latest()->take(5)->get();
    }

    /**
     * Mengambil daftar produk dengan stok kritis (kurang dari atau sama dengan 5).
     */
    public function getLowStockProducts(): Collection
    {
        return Product::with('category')->where('stock', '<=', 5)->get();
    }
}
