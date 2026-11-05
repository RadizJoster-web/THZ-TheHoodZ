<aside class="admin-sidebar d-flex flex-column" id="adminSidebar">
    <div class="p-3 border-bottom d-flex align-items-center justify-content-between" style="border-color: var(--admin-border) !important;">
        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-white text-decoration-none">
            <div class="p-1 px-2 rounded-2 me-2" style="background-color: #1A1A1F; border: 1px solid #2B2B33;">
                <i class="bi bi-layers-fill text-emerald" style="font-size: 0.95rem;"></i>
            </div>
            <div>
                <span class="fw-bold tracking-tight d-block" style="font-size: 0.95rem;">THEHOODZ</span>
                <span class="text-muted d-block" style="font-size: 0.62rem; letter-spacing: 0.08em;">ADMIN BACKOFFICE</span>
            </div>
        </a>
        <button class="btn btn-sm btn-dark d-lg-none border-0 text-muted" type="button" onclick="toggleSidebar()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="px-3 py-3 flex-grow-1 overflow-y-auto">
        <div class="text-uppercase fw-semibold mb-2 px-2" style="font-size: 0.65rem; color: var(--admin-text-muted); letter-spacing: 0.08em;">
            Platform
        </div>

        <ul class="nav flex-column mb-3" style="gap: 3px;">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link py-2 px-3 d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active-admin-pill' : 'text-muted-admin' }}" style="font-size: 0.8rem;">
                    <i class="bi bi-grid-1x2-fill me-2 fs-6"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link py-2 px-3 d-flex align-items-center {{ request()->routeIs('admin.categories.*') ? 'active-admin-pill' : 'text-muted-admin' }}" style="font-size: 0.8rem;">
                    <i class="bi bi-tags-fill me-2 fs-6"></i> <span>Kategori Pakaian</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link py-2 px-3 d-flex align-items-center {{ request()->routeIs('admin.products.*') ? 'active-admin-pill' : 'text-muted-admin' }}" style="font-size: 0.8rem;">
                    <i class="bi bi-box-seam-fill me-2 fs-6"></i> <span>Produk Pakaian</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link py-2 px-3 d-flex align-items-center {{ request()->routeIs('admin.orders.*') ? 'active-admin-pill' : 'text-muted-admin' }}" style="font-size: 0.8rem;">
                    <i class="bi bi-receipt-cutoff me-2 fs-6"></i> <span>Pesanan & Bukti</span>
                </a>
            </li>
        </ul>

        <div class="text-uppercase fw-semibold mb-2 px-2" style="font-size: 0.65rem; color: var(--admin-text-muted); letter-spacing: 0.08em;">
            System
        </div>

        <ul class="nav flex-column mb-4" style="gap: 3px;">
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link py-2 px-3 d-flex align-items-center {{ request()->routeIs('admin.users.*') ? 'active-admin-pill' : 'text-muted-admin' }}" style="font-size: 0.8rem;">
                    <i class="bi bi-people-fill me-2 fs-6"></i> <span>Manajemen User</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('home') }}" target="_blank" class="nav-link py-2 px-3 d-flex align-items-center text-muted-admin" style="font-size: 0.8rem;">
                    <i class="bi bi-box-arrow-up-right me-2 fs-6"></i> <span>Lihat Toko</span>
                </a>
            </li>
        </ul>

        <div class="p-3 rounded-2 mb-3" style="background-color: var(--admin-bg-subtle); border: 1px solid var(--admin-border);">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fw-semibold text-white" style="font-size: 0.72rem;">Status Toko</span>
                <span class="badge bg-success-subtle text-success" style="font-size: 0.58rem;">Online</span>
            </div>
            @php
                $pendingCount = \App\Models\Order::where('status', 'pending')->count();
                $lowStockCount = \App\Models\Product::where('stock', '<=', 5)->count();
            @endphp
            <div class="text-muted" style="font-size: 0.7rem;">
                <div><i class="bi bi-clock-history text-warning me-1"></i> {{ $pendingCount }} Pesanan Pending</div>
                <div class="mt-1"><i class="bi bi-exclamation-circle text-danger me-1"></i> {{ $lowStockCount }} Stok Menipis</div>
            </div>
        </div>
    </div>

    <div class="p-3 border-top mt-auto" style="border-color: var(--admin-border) !important;">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownAdmin" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 28px; height: 28px; font-size: 0.75rem;">
                    <i class="bi bi-person-fill"></i>
                </div>
                <span class="text-truncate" style="max-width: 140px; font-size: 0.8rem;">{{ auth()->user()->username ?? auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow rounded-2 border" style="border-color: var(--admin-border); background-color: var(--admin-bg-card); font-size: 0.8rem;">
                <li><a class="dropdown-item" href="{{ route('home') }}"><i class="bi bi-shop me-2"></i> Halaman Publik</a></li>
                <li><hr class="dropdown-divider" style="border-color: var(--admin-border);"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-power me-2"></i> Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>
