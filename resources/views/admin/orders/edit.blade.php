@extends('layouts.admin')

@section('title', 'Ubah Status Pesanan: ' . $order->order_code)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold text-white mb-1">Update Status: {{ $order->order_code }}</h4>
                <span class="text-muted small">Ubah status verifikasi pembayaran atau proses logistik pesanan.</span>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm text-white rounded-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card card-admin p-4">
            <div class="p-3 mb-4 rounded-2" style="background-color: var(--admin-bg-subtle); border: 1px solid var(--admin-border);">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="text-muted small d-block">Produk:</span>
                        <strong class="text-white">{{ $order->product->name }}</strong> (Size {{ $order->product->size }}) &times; {{ $order->quantity }} pcs
                    </div>
                    <div class="text-end">
                        <span class="text-muted small d-block">Total Tagihan:</span>
                        <strong class="text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="status" class="form-label text-muted small fw-semibold">Status Transaksi</label>
                    <select name="status" id="status" class="form-select rounded-2 @error('status') is-invalid @enderror" required>
                        <option value="pending" {{ old('status', $order->status) === 'pending' ? 'selected' : '' }}>Pending (Menunggu Verifikasi Bukti)</option>
                        <option value="paid" {{ old('status', $order->status) === 'paid' ? 'selected' : '' }}>Paid (Pembayaran Terverifikasi)</option>
                        <option value="shipped" {{ old('status', $order->status) === 'shipped' ? 'selected' : '' }}>Shipped (Barang Sedang Dikirim)</option>
                        <option value="completed" {{ old('status', $order->status) === 'completed' ? 'selected' : '' }}>Completed (Pesanan Selesai)</option>
                        <option value="cancelled" {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan - Stok Dikembalikan)</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="shipping_address" class="form-label text-muted small fw-semibold">Alamat Pengiriman</label>
                    <textarea name="shipping_address" id="shipping_address" rows="3" class="form-control rounded-2 @error('shipping_address') is-invalid @enderror" required>{{ old('shipping_address', $order->shipping_address) }}</textarea>
                    @error('shipping_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="payment_proof" class="form-label text-muted small fw-semibold">Ganti Bukti Transfer Pembayaran</label>
                    <input type="file" name="payment_proof" id="payment_proof" class="form-control rounded-2 @error('payment_proof') is-invalid @enderror" accept="image/*">
                    @if($order->payment_proof)
                        <div class="mt-2 text-muted small">
                            Saat ini: <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="text-emerald">Lihat Foto yang Ada</a>
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3" style="border-color: var(--admin-border) !important;">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary rounded-2 px-3">Batal</a>
                    <button type="submit" class="btn text-black fw-bold px-4 rounded-2" style="background-color: #D4FF00;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
