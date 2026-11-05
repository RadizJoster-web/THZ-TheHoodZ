@extends('layouts.app')

@section('title', 'Riwayat Pesanan Saya')

@section('content')
<div class="container py-3 py-md-4">
    <div class="d-flex align-items-center justify-content-between mb-3 mb-md-4 pb-2 border-bottom" style="border-color: var(--thz-border-sharp) !important;">
        <div>
            <span class="badge rounded-0 bg-neon fw-bold mb-1">TRANSACTION LOG</span>
            <h2 class="text-uppercase fw-black text-white m-0" style="font-family: 'Anton', 'Oswald', sans-serif; font-size: clamp(1.4rem, 3.5vw, 2.2rem);">
                PESANAN SAYA
            </h2>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-light rounded-0 btn-sm text-uppercase">
            <i class="bi bi-arrow-left me-1"></i> BELANJA LAGI
        </a>
    </div>

    @if($orders->isEmpty())
        <div class="p-4 p-md-5 text-center border" style="background-color: var(--thz-bg-secondary); border-color: var(--thz-border-sharp) !important;">
            <i class="bi bi-bag-x text-secondary display-4 d-block mb-3"></i>
            <h5 class="text-white text-uppercase fw-bold">BELUM ADA PESANAN</h5>
            <p class="text-secondary small mb-3">Anda belum melakukan transaksi pembelian apapun di TheHoodZ.</p>
            <a href="{{ route('home') }}" class="btn btn-neon px-4 py-2 text-uppercase fw-bold">
                JELAJAHI KATALOG <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    @else
        <div class="row g-3">
            @foreach($orders as $order)
                <div class="col-12">
                    <div class="p-3 p-md-4 border position-relative" style="background-color: var(--thz-bg-secondary); border-color: var(--thz-border-sharp) !important;">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 border-bottom pb-2 pb-md-3 mb-3" style="border-color: #222 !important;">
                            <div>
                                <span class="text-white font-monospace fw-bold fs-6">{{ $order->order_code }}</span>
                                <span class="text-secondary small ms-1 ms-md-2 d-block d-sm-inline">&bull; {{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                            <div>
                                @if($order->status === 'pending')
                                    <span class="badge rounded-0 bg-warning text-black px-2 py-1 fw-bold" style="font-size: 0.7rem;">PENDING</span>
                                @elseif($order->status === 'paid')
                                    <span class="badge rounded-0 bg-info text-black px-2 py-1 fw-bold" style="font-size: 0.7rem;">PAID</span>
                                @elseif($order->status === 'shipped')
                                    <span class="badge rounded-0 bg-primary text-white px-2 py-1 fw-bold" style="font-size: 0.7rem;">SHIPPED</span>
                                @elseif($order->status === 'completed')
                                    <span class="badge rounded-0 bg-success text-white px-2 py-1 fw-bold" style="font-size: 0.7rem;">COMPLETED</span>
                                @else
                                    <span class="badge rounded-0 bg-danger text-white px-2 py-1 fw-bold" style="font-size: 0.7rem;">CANCELLED</span>
                                @endif
                            </div>
                        </div>

                        <div class="row align-items-center g-3">
                            <div class="col-auto">
                                <img src="{{ $order->product->image ? asset('storage/' . $order->product->image) : asset('storage/products/hoodie-boxy-black.svg') }}" alt="{{ $order->product->name }}" class="border border-secondary" style="width: 65px; height: 80px; object-fit: cover;">
                            </div>
                            <div class="col">
                                <h6 class="text-white text-uppercase fw-bold mb-1" style="font-size: 0.9rem;">{{ $order->product->name }}</h6>
                                <div class="text-secondary small">Ukuran: <strong class="text-white">{{ $order->product->size }}</strong> | Qty: <strong class="text-white">{{ $order->quantity }} pcs</strong></div>
                                <div class="text-secondary small text-truncate mt-1" style="max-width: 400px; font-size: 0.75rem;"><i class="bi bi-geo-alt me-1"></i> {{ $order->shipping_address }}</div>
                            </div>
                            <div class="col-12 col-md-auto text-md-end border-top border-md-0 pt-2 pt-md-0 border-dark">
                                <div class="text-secondary small text-uppercase" style="font-size: 0.7rem;">Total Transaksi</div>
                                <div class="fs-5 fw-black text-neon">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>

                                <div class="mt-2">
                                    @if($order->status === 'pending')
                                        <button class="btn btn-sm btn-neon px-3 py-1 text-uppercase fw-bold" style="font-size: 0.75rem;" data-bs-toggle="modal" data-bs-target="#uploadProofModal{{ $order->id }}">
                                            <i class="bi bi-upload me-1"></i> {{ $order->payment_proof ? 'Ganti Bukti Bayar' : 'Upload Bukti Bayar' }}
                                        </button>
                                    @elseif($order->payment_proof)
                                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="btn btn-sm btn-outline-secondary text-white py-1" style="font-size: 0.75rem;">
                                            <i class="bi bi-eye me-1"></i> Lihat Bukti
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('storefront.orders.partials.upload-proof-modal', ['order' => $order])
            @endforeach
        </div>
    @endif
</div>
@endsection
