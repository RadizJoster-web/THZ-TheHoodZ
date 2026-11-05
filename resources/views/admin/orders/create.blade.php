@extends('layouts.admin')

@section('title', 'Input Pesanan Manual')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold text-white mb-1">Input Pesanan Manual</h4>
                <span class="text-muted small">Tambahkan transaksi pesanan langsung dari dashboard Admin.</span>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm text-white rounded-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card card-admin p-4">
            <form action="{{ route('admin.orders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="user_id" class="form-label text-muted small fw-semibold">Pilih Pengguna / Pembeli</label>
                    <select name="user_id" id="user_id" class="form-select rounded-2 @error('user_id') is-invalid @enderror" required>
                        <option value="">Pilih Akun...</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                {{ $u->name ?? $u->username }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <label for="product_id" class="form-label text-muted small fw-semibold">Produk Pakaian</label>
                        <select name="product_id" id="product_id" class="form-select rounded-2 @error('product_id') is-invalid @enderror" required>
                            <option value="">Pilih Produk...</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}" {{ old('product_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }} (Size {{ $p->size }} - Stok: {{ $p->stock }} - Rp {{ number_format($p->price, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="quantity" class="form-label text-muted small fw-semibold">Jumlah Beli</label>
                        <input type="number" name="quantity" id="quantity" class="form-control rounded-2 @error('quantity') is-invalid @enderror" value="{{ old('quantity', 1) }}" min="1" required>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="shipping_address" class="form-label text-muted small fw-semibold">Alamat Lengkap Pengiriman</label>
                    <textarea name="shipping_address" id="shipping_address" rows="3" class="form-control rounded-2 @error('shipping_address') is-invalid @enderror" placeholder="Alamat jalan, kota, nomor rumah..." required>{{ old('shipping_address') }}</textarea>
                    @error('shipping_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="status" class="form-label text-muted small fw-semibold">Status Awal Pesanan</label>
                        <select name="status" id="status" class="form-select rounded-2" required>
                            <option value="pending">Pending (Menunggu)</option>
                            <option value="paid" selected>Paid (Lunas)</option>
                            <option value="shipped">Shipped (Dikirim)</option>
                            <option value="completed">Completed (Selesai)</option>
                            <option value="cancelled">Cancelled (Dibatalkan)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="payment_proof" class="form-label text-muted small fw-semibold">Bukti Pembayaran (Opsional)</label>
                        <input type="file" name="payment_proof" id="payment_proof" class="form-control rounded-2" accept="image/*">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3" style="border-color: var(--admin-border) !important;">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary rounded-2 px-3">Batal</a>
                    <button type="submit" class="btn text-black fw-bold px-4 rounded-2" style="background-color: #D4FF00;">Simpan Pesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
