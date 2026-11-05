@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold text-white mb-1">Pesanan & Verifikasi Bukti Bayar</h4>
        <span class="text-muted small">Kelola seluruh transaksi pembelian dan update status pengiriman pesanan.</span>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.orders.create') }}" class="btn btn-sm text-black fw-bold px-3 py-2" style="background-color: #D4FF00; border-radius: 8px;">
            <i class="bi bi-plus-lg me-1"></i> Input Pesanan Manual
        </a>
    </div>
</div>

<div class="card card-admin p-4">
    <div class="d-flex flex-wrap gap-2 mb-4 pb-3 border-bottom" style="border-color: var(--admin-border) !important;">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm rounded-pill px-3 {{ !request('status') ? 'btn-light text-black fw-bold' : 'btn-dark text-muted' }}">Semua ({{ \App\Models\Order::count() }})</a>
        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="btn btn-sm rounded-pill px-3 {{ request('status') === 'pending' ? 'btn-warning text-black fw-bold' : 'btn-dark text-muted' }}">Pending</a>
        <a href="{{ route('admin.orders.index', ['status' => 'paid']) }}" class="btn btn-sm rounded-pill px-3 {{ request('status') === 'paid' ? 'btn-info text-black fw-bold' : 'btn-dark text-muted' }}">Paid</a>
        <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="btn btn-sm rounded-pill px-3 {{ request('status') === 'shipped' ? 'btn-primary text-white fw-bold' : 'btn-dark text-muted' }}">Shipped</a>
        <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="btn btn-sm rounded-pill px-3 {{ request('status') === 'completed' ? 'btn-success text-white fw-bold' : 'btn-dark text-muted' }}">Completed</a>
        <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="btn btn-sm rounded-pill px-3 {{ request('status') === 'cancelled' ? 'btn-danger text-white fw-bold' : 'btn-dark text-muted' }}">Cancelled</a>
    </div>

    <div class="table-responsive">
        <table class="table table-admin align-middle mb-0" id="ordersTable">
            <thead>
                <tr>
                    <th>Invoice / Kode</th>
                    <th>Pelanggan</th>
                    <th>Item Produk</th>
                    <th>Total Bayar</th>
                    <th>Bukti Bayar</th>
                    <th>Status</th>
                    <th class="text-end" style="width: 110px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="font-monospace text-white fw-semibold">{{ $order->order_code }}</td>
                        <td>
                            <span class="text-white d-block fw-medium">{{ $order->user->name ?? $order->user->username }}</span>
                            <span class="text-muted small">{{ $order->user->email }}</span>
                        </td>
                        <td>
                            <span class="text-white small d-block">{{ $order->product->name }}</span>
                            <span class="text-muted small">Qty: {{ $order->quantity }} | Size {{ $order->product->size }}</span>
                        </td>
                        <td class="fw-bold text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            @if($order->payment_proof)
                                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="badge bg-dark border border-secondary text-info text-decoration-none">
                                    <i class="bi bi-image me-1"></i> Lihat Foto
                                </a>
                            @else
                                <span class="badge bg-secondary-subtle text-muted">Belum Ada</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge rounded-pill {{ $order->status === 'paid' || $order->status === 'completed' ? 'bg-success-subtle text-emerald' : ($order->status === 'pending' ? 'bg-warning-subtle text-amber' : ($order->status === 'shipped' ? 'bg-primary-subtle text-primary' : 'bg-danger-subtle text-rose')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-secondary text-white py-1 px-2 rounded-2" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-outline-secondary text-white py-1 px-2 rounded-2" title="Edit Status">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus riwayat pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2 rounded-2" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            order: [[0, 'desc']],
            language: { search: "Cari Pesanan:", lengthMenu: "Tampil _MENU_ data" }
        });
    });
</script>
@endpush
