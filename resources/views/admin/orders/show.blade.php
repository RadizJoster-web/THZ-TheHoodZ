@extends('layouts.admin')

@section('title', 'Detail Pesanan: ' . $order->order_code)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold text-white mb-1">Invoice: {{ $order->order_code }}</h4>
                <span class="text-muted small">Waktu transaksi: {{ $order->created_at->format('d M Y, H:i') }} WIB</span>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn text-black fw-bold btn-sm px-3 rounded-2" style="background-color: #D4FF00;">
                    <i class="bi bi-pencil-square me-1"></i> Edit Status
                </a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm text-white rounded-2">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card card-admin p-4 mb-4">
            <h6 class="fw-semibold text-white mb-3 border-bottom pb-2" style="border-color: var(--admin-border) !important;">Informasi Pembeli & Pengiriman</h6>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <span class="text-muted small d-block">Nama Lengkap</span>
                    <strong class="text-white">{{ $order->user->name ?? $order->user->username }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="text-muted small d-block">Email Pembeli</span>
                    <strong class="text-white">{{ $order->user->email }}</strong>
                </div>
                <div class="col-12">
                    <span class="text-muted small d-block">Alamat Pengiriman Lengkap</span>
                    <div class="p-3 rounded-2 text-white mt-1" style="background-color: var(--admin-bg-subtle); border: 1px solid var(--admin-border);">
                        {{ $order->shipping_address }}
                    </div>
                </div>
            </div>

            <h6 class="fw-semibold text-white mb-3 mt-4 border-bottom pb-2" style="border-color: var(--admin-border) !important;">Item yang Dipesan</h6>
            <div class="d-flex align-items-center p-3 rounded-2" style="background-color: var(--admin-bg-subtle); border: 1px solid var(--admin-border);">
                <img src="{{ $order->product->image ? asset('storage/' . $order->product->image) : asset('storage/products/hoodie-boxy-black.svg') }}" alt="{{ $order->product->name }}" class="rounded-2 me-3 border border-secondary" style="width: 60px; height: 75px; object-fit: cover;">
                <div class="flex-grow-1">
                    <h6 class="text-white mb-1">{{ $order->product->name }}</h6>
                    <span class="badge bg-dark border border-secondary text-white me-2">Ukuran: {{ $order->product->size }}</span>
                    <span class="text-muted small">Harga Satuan: Rp {{ number_format($order->product->price, 0, ',', '.') }} &times; {{ $order->quantity }} pcs</span>
                </div>
                <div class="text-end">
                    <span class="text-muted small d-block">Total Bayar:</span>
                    <h5 class="fw-bold text-white mb-0">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h5>
                </div>
            </div>

            <h6 class="fw-semibold text-white mb-3 mt-4 border-bottom pb-2" style="border-color: var(--admin-border) !important;">Foto Bukti Pembayaran</h6>
            @if($order->payment_proof)
                <div class="p-3 text-center rounded-2" style="background-color: var(--admin-bg-subtle); border: 1px solid var(--admin-border);">
                    <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Payment Proof" class="img-fluid rounded-2 mb-2" style="max-height: 380px;">
                    <div>
                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-2 mt-2">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Ukuran Penuh
                        </a>
                    </div>
                </div>
            @else
                <div class="alert alert-warning border-0 rounded-2 py-3">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Pelanggan belum mengunggah foto bukti pembayaran.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
