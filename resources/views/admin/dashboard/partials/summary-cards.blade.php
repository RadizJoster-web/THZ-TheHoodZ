<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-admin p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted fw-medium" style="font-size: 0.8rem;">Total Pendapatan Bersih</span>
                <span class="badge bg-success-subtle text-emerald rounded-pill px-2 py-1" style="font-size: 0.7rem;">
                    <i class="bi bi-arrow-up-short"></i> +8.0%
                </span>
            </div>
            <div class="fs-4 fw-bold text-white mb-1">
                Rp {{ number_format($cards['total_revenue'], 0, ',', '.') }}
            </div>
            <div class="text-muted" style="font-size: 0.72rem;">
                Status: Paid, Shipped, Completed
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-admin p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted fw-medium" style="font-size: 0.8rem;">Total Pesanan Masuk</span>
                <span class="badge bg-warning-subtle text-amber rounded-pill px-2 py-1" style="font-size: 0.7rem;">
                    {{ $cards['pending_orders'] }} Pending
                </span>
            </div>
            <div class="fs-4 fw-bold text-white mb-1">
                {{ $cards['total_orders'] }} <span class="fs-6 fw-normal text-muted">transaksi</span>
            </div>
            <div class="text-muted" style="font-size: 0.72rem;">
                Keseluruhan riwayat order
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-admin p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted fw-medium" style="font-size: 0.8rem;">Total Produk & Stok</span>
                <span class="badge bg-info-subtle text-info rounded-pill px-2 py-1" style="font-size: 0.7rem;">
                    {{ $cards['total_products'] }} SKU
                </span>
            </div>
            <div class="fs-4 fw-bold text-white mb-1">
                {{ $cards['total_stock'] }} <span class="fs-6 fw-normal text-muted">pcs tersedia</span>
            </div>
            <div class="text-muted" style="font-size: 0.72rem;">
                Inventaris aktif di etalase
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-admin p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted fw-medium" style="font-size: 0.8rem;">Pelanggan Terdaftar</span>
                <span class="badge bg-secondary rounded-pill px-2 py-1" style="font-size: 0.7rem;">
                    Role: Customer
                </span>
            </div>
            <div class="fs-4 fw-bold text-white mb-1">
                {{ $cards['total_customers'] }} <span class="fs-6 fw-normal text-muted">pengguna</span>
            </div>
            <div class="text-muted" style="font-size: 0.72rem;">
                Akun customer aktif
            </div>
        </div>
    </div>
</div>
