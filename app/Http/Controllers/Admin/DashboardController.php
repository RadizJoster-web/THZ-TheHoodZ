<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardStatsService;
use Illuminate\View\View;

/**
 * Mengelola tampilan halaman utama Dashboard Admin dan metrik bisnis TheHoodZ.
 */
class DashboardController extends Controller
{
    /**
     * Service pengolah data metrik dan grafik.
     */
    protected DashboardStatsService $statsService;

    /**
     * Inisialisasi controller dengan injeksi DashboardStatsService.
     */
    public function __construct(DashboardStatsService $statsService)
    {
        $this->statsService = $statsService;
    }

    /**
     * Menampilkan dashboard utama admin dengan ringkasan kartu, grafik, dan tabel.
     */
    public function index(): View
    {
        return view('admin.dashboard.index', [
            'cards' => $this->statsService->getSummaryCards(),
            'revenueChart' => $this->statsService->getMonthlyRevenueChart(),
            'stockChart' => $this->statsService->getCategoryStockDistribution(),
            'statusCounts' => $this->statsService->getOrderStatusCounts(),
            'recentOrders' => $this->statsService->getRecentOrders(),
            'lowStockProducts' => $this->statsService->getLowStockProducts(),
        ]);
    }
}
