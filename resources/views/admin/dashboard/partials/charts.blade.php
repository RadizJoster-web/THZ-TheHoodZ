<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card card-admin p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <span class="text-muted small fw-medium">Revenue Over Time <i class="bi bi-info-circle ms-1"></i></span>
                    <h3 class="fw-bold text-white mb-0" style="font-size: clamp(1.25rem, 3vw, 1.8rem);">Rp {{ number_format($cards['total_revenue'], 0, ',', '.') }}</h3>
                </div>
                <div class="badge bg-success-subtle text-emerald border border-success-subtle px-3 py-2 rounded-pill">
                    <i class="bi bi-graph-up-arrow me-1"></i> +7.5% vs bulan lalu
                </div>
            </div>
            <div style="height: 250px;">
                <canvas id="revenueChartCanvas"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-admin p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted small fw-medium">Distribusi Stok per Kategori</span>
                <span class="badge bg-secondary rounded-pill">{{ count($stockChart['labels']) }} Kategori</span>
            </div>
            <div style="height: 220px;" class="d-flex align-items-center justify-content-center">
                <canvas id="stockChartCanvas"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card card-admin p-4 mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h6 class="fw-semibold text-white m-0">Ringkasan Status Pesanan Pelanggan</h6>
        <span class="text-muted small font-monospace">THZ ORDER PIPELINE</span>
    </div>

    <div class="progress mb-3 rounded-pill" style="height: 8px; background-color: #1F1F24;">
        @php
            $tot = max(1, array_sum($statusCounts));
            $pctPending = ($statusCounts['pending'] / $tot) * 100;
            $pctPaid = ($statusCounts['paid'] / $tot) * 100;
            $pctShipped = ($statusCounts['shipped'] / $tot) * 100;
            $pctCompleted = ($statusCounts['completed'] / $tot) * 100;
        @endphp
        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $pctPending }}%" title="Pending"></div>
        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $pctPaid }}%" title="Paid"></div>
        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $pctShipped }}%" title="Shipped"></div>
        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pctCompleted }}%" title="Completed"></div>
    </div>

    <div class="row g-2">
        <div class="col-sm-6 col-md-3">
            <div class="p-3 rounded-2" style="background-color: var(--admin-bg-subtle); border: 1px solid var(--admin-border);">
                <div class="text-warning small mb-1"><i class="bi bi-clock-history me-1"></i> Pending</div>
                <div class="fs-5 fw-bold text-white">{{ $statusCounts['pending'] }} Pesanan</div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="p-3 rounded-2" style="background-color: var(--admin-bg-subtle); border: 1px solid var(--admin-border);">
                <div class="text-info small mb-1"><i class="bi bi-credit-card me-1"></i> Paid</div>
                <div class="fs-5 fw-bold text-white">{{ $statusCounts['paid'] }} Pesanan</div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="p-3 rounded-2" style="background-color: var(--admin-bg-subtle); border: 1px solid var(--admin-border);">
                <div class="text-primary small mb-1"><i class="bi bi-truck me-1"></i> Shipped</div>
                <div class="fs-5 fw-bold text-white">{{ $statusCounts['shipped'] }} Pesanan</div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="p-3 rounded-2" style="background-color: var(--admin-bg-subtle); border: 1px solid var(--admin-border);">
                <div class="text-success small mb-1"><i class="bi bi-check2-circle me-1"></i> Completed</div>
                <div class="fs-5 fw-bold text-white">{{ $statusCounts['completed'] }} Pesanan</div>
            </div>
        </div>
    </div>
</div>
