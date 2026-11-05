<div class="row g-3">
    <div class="col-lg-7">
        <div class="card card-admin p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-semibold text-white m-0">5 Pesanan Terbaru</h6>
                <a href="{{ route('admin.orders.index') }}" class="text-decoration-none small text-emerald">Lihat Semua →</a>
            </div>
            <div class="table-responsive">
                <table class="table table-admin align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Pembeli</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td class="font-monospace text-white fw-medium">{{ $order->order_code }}</td>
                                <td>{{ $order->user->name ?? $order->user->username }}</td>
                                <td class="fw-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge rounded-pill {{ $order->status === 'paid' || $order->status === 'completed' ? 'bg-success-subtle text-emerald' : ($order->status === 'pending' ? 'bg-warning-subtle text-amber' : 'bg-secondary') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada data transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card card-admin p-4 h-100">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-semibold text-white m-0">Peringatan Stok Menipis (&le; 5 pcs)</h6>
                <span class="badge bg-danger-subtle text-rose rounded-pill">{{ $lowStockProducts->count() }} Item</span>
            </div>
            <div class="table-responsive">
                <table class="table table-admin align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Sisa Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockProducts as $prod)
                            <tr>
                                <td class="text-white fw-medium text-truncate" style="max-width: 140px;">{{ $prod->name }}</td>
                                <td>{{ $prod->category->name }}</td>
                                <td>
                                    <span class="badge bg-danger text-white rounded-pill">{{ $prod->stock }} pcs</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Semua stok produk dalam batas aman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
