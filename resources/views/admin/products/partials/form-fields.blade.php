<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="category_id" class="form-label text-muted small fw-semibold">Kategori Pakaian</label>
        <select name="category_id" id="category_id" class="form-select rounded-2 @error('category_id') is-invalid @enderror" required>
            <option value="">Pilih Kategori...</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="size" class="form-label text-muted small fw-semibold">Ukuran Pakaian</label>
        <select name="size" id="size" class="form-select rounded-2 @error('size') is-invalid @enderror" required>
            @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $sz)
                <option value="{{ $sz }}" {{ old('size', $product->size ?? 'L') == $sz ? 'selected' : '' }}>Ukuran {{ $sz }}</option>
            @endforeach
        </select>
        @error('size') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <label for="name" class="form-label text-muted small fw-semibold">Nama Produk</label>
    <input type="text" name="name" id="name" class="form-control rounded-2 @error('name') is-invalid @enderror" value="{{ old('name', $product->name ?? '') }}" placeholder="Contoh: THZ Heavy Graphic Tee" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="price" class="form-label text-muted small fw-semibold">Harga Satuan (Rp)</label>
        <input type="number" name="price" id="price" class="form-control rounded-2 @error('price') is-invalid @enderror" value="{{ old('price', $product->price ?? '') }}" min="1000" placeholder="185000" required>
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="stock" class="form-label text-muted small fw-semibold">Jumlah Stok</label>
        <input type="number" name="stock" id="stock" class="form-control rounded-2 @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock ?? 10) }}" min="0" placeholder="25" required>
        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<!-- Upload Foto Produk (Multiple & Live Preview) -->
<div class="mb-3">
    <label class="form-label text-muted small fw-semibold d-flex justify-content-between">
        <span>Foto Produk (Bisa pilih beberapa gambar sekaligus)</span>
        <span class="text-secondary" style="font-size: 0.72rem;">*Foto urutan ke-1 otomatis jadi Cover Katalog</span>
    </label>

    <div class="p-3 border rounded-2 text-center" style="background-color: var(--admin-bg-subtle); border: 2px dashed var(--admin-border) !important; cursor: pointer;" onclick="document.getElementById('productImagesInput').click()">
        <i class="bi bi-cloud-arrow-up fs-2 text-emerald d-block mb-1"></i>
        <span class="text-white small fw-semibold d-block">Klik untuk memilih foto produk</span>
        <span class="text-muted" style="font-size: 0.72rem;">Format: JPG, PNG, WEBP (Bisa tahan Ctrl/Shift untuk pilih banyak)</span>
        <input type="file" name="images[]" id="productImagesInput" class="d-none" accept="image/*" multiple {{ isset($product) ? '' : 'required' }} onchange="previewSelectedImages(this)">
    </div>
    @error('images') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

    <!-- Live Preview Container -->
    <div id="imagePreviewContainer" class="d-flex flex-wrap gap-2 mt-2"></div>

    @if(isset($product) && !empty($product->images))
        <div class="mt-2" id="existingImagesBox">
            <span class="text-muted small d-block mb-1">Foto saat ini di server:</span>
            <div class="d-flex flex-wrap gap-2">
                @foreach($product->images as $idx => $img)
                    <div class="position-relative border rounded-2 overflow-hidden bg-black" style="width: 75px; height: 95px; border-color: #333 !important;">
                        <img src="{{ asset('storage/' . $img) }}" alt="Existing" class="w-100 h-100 object-fit-cover">
                        <span class="position-absolute bottom-0 start-0 end-0 text-center py-1 text-black fw-bold" style="background: {{ $idx === 0 ? '#D4FF00' : '#A1A1AA' }}; font-size: 0.55rem;">
                            {{ $idx === 0 ? 'COVER' : 'DETAIL' }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<div class="mb-4">
    <label for="description" class="form-label text-muted small fw-semibold">Deskripsi & Spesifikasi Produk</label>
    <textarea name="description" id="description" rows="4" class="form-control rounded-2 @error('description') is-invalid @enderror" placeholder="Bahan katun combed 20s, kerah tebal, sablon discharge..." required>{{ old('description', $product->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
