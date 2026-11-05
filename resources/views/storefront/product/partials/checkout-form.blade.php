<div class="p-3 p-md-4 border mt-3 mt-md-4" style="background-color: var(--thz-bg-secondary); border-color: var(--thz-border-sharp) !important;">
    <h5 class="text-white text-uppercase fw-bold mb-3 border-bottom pb-2" style="border-color: #26262B !important;">
        <i class="bi bi-bag-plus text-neon me-2"></i> DIRECT CHECKOUT
    </h5>

    @auth
        @if($product->stock <= 0)
            <div class="alert alert-danger rounded-0 border-0 text-uppercase fw-bold py-3 text-center">
                <i class="bi bi-x-octagon-fill me-2"></i> STOK HABIS (SOLD OUT)
            </div>
        @else
            <form action="{{ route('checkout.store', $product->id) }}" method="POST" enctype="multipart/form-data" id="checkoutForm">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="mb-3">
                    <label for="quantity" class="form-label text-secondary small text-uppercase fw-semibold">Jumlah Pembelian (Maks: {{ $product->stock }} pcs)</label>
                    <div class="input-group">
                        <button class="btn btn-dark border-secondary text-white rounded-0" type="button" onclick="decrementQty()">-</button>
                        <input type="number" name="quantity" id="quantity" class="form-control bg-dark border-secondary text-white text-center rounded-0 @error('quantity') is-invalid @enderror" value="1" min="1" max="{{ $product->stock }}" required onchange="updateTotal()">
                        <button class="btn btn-dark border-secondary text-white rounded-0" type="button" onclick="incrementQty()">+</button>
                    </div>
                    @error('quantity')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="shipping_address" class="form-label text-secondary small text-uppercase fw-semibold">Alamat Lengkap Pengiriman</label>
                    <textarea name="shipping_address" id="shipping_address" rows="3" class="form-control rounded-0 bg-dark border-secondary text-white @error('shipping_address') is-invalid @enderror" placeholder="Nama Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos" required>{{ old('shipping_address') }}</textarea>
                    @error('shipping_address')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="payment_proof" class="form-label text-secondary small text-uppercase fw-semibold">
                        Bukti Transfer Pembayaran <span class="text-secondary">(Opsional saat checkout)</span>
                    </label>
                    <input type="file" name="payment_proof" id="payment_proof" class="form-control rounded-0 bg-dark border-secondary text-white @error('payment_proof') is-invalid @enderror" accept="image/*">
                    <div class="form-text text-secondary" style="font-size: 0.72rem;">Format: JPG, PNG, WEBP (Maks 2MB). Dapat diunggah ulang di menu Pesanan Saya.</div>
                    @error('payment_proof')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="p-3 mb-3 bg-dark border border-secondary d-flex justify-content-between align-items-center">
                    <span class="text-secondary text-uppercase small">Total Pembayaran:</span>
                    <span class="fs-4 fw-black text-neon" id="displayTotalPrice">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>

                <button type="submit" class="btn btn-neon w-100 py-3 text-uppercase fw-black" style="letter-spacing: 0.08em;">
                    BELI SEKARANG <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </form>
        @endif
    @else
        <div class="text-center py-4">
            <p class="text-secondary mb-3">Silakan login terlebih dahulu untuk melakukan pemesanan langsung produk ini.</p>
            <a href="{{ route('login') }}" class="btn btn-neon px-4 py-2 text-uppercase fw-bold me-2">
                LOGIN KE AKUN
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-light rounded-0 px-4 py-2 text-uppercase">
                DAFTAR BARU
            </a>
        </div>
    @endauth
</div>
