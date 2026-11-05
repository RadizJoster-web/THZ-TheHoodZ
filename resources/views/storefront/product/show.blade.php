@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container-fluid px-3 px-md-4 px-lg-5 py-3 py-md-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb" style="font-size: 0.75rem;">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-secondary text-decoration-none">HOME</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home', ['category' => $product->category->slug]) }}" class="text-secondary text-decoration-none">{{ strtoupper($product->category->name) }}</a></li>
            <li class="breadcrumb-item active text-neon text-truncate" style="max-width: 200px;" aria-current="page">{{ strtoupper($product->name) }}</li>
        </ol>
    </nav>

    <div class="row g-4 g-lg-5">
        <div class="col-lg-5">
            <!-- Galeri Foto Produk (Tampilan Nyaman & Proporsional) -->
            <div class="border p-2 mb-2 bg-black text-center" style="border-color: var(--thz-border-sharp) !important;">
                <div class="d-flex align-items-center justify-content-center bg-black" style="max-height: 420px; height: min(50vh, 420px); overflow: hidden;">
                    <img id="mainProductImage" src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/products/hoodie-boxy-black.svg') }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 100%; width: auto; object-fit: contain;">
                </div>
            </div>

            @if(count($gallery) > 1)
                <div class="d-flex gap-2 overflow-x-auto pb-2">
                    @foreach($gallery as $img)
                        <div class="border flex-shrink-0 thumbnail-box" style="width: 55px; height: 70px; border-color: #333 !important; cursor: pointer;" onclick="document.getElementById('mainProductImage').src='{{ asset('storage/' . $img) }}'">
                            <img src="{{ asset('storage/' . $img) }}" alt="Thumbnail" class="w-100 h-100 object-fit-cover">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-lg-7">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                <span class="badge rounded-0 bg-neon fw-bold">{{ $product->category->name }}</span>
                <span class="badge rounded-0 bg-dark text-white border border-secondary">UKURAN {{ $product->size }}</span>
                <span class="badge rounded-0 {{ $product->stock > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                    {{ $product->stock > 0 ? "STOK ({$product->stock} PCS)" : 'HABIS' }}
                </span>
            </div>

            <h1 class="fw-black text-white text-uppercase mb-2" style="font-family: 'Anton', 'Oswald', sans-serif; font-size: clamp(1.6rem, 3.5vw, 2.4rem);">
                {{ $product->name }}
            </h1>

            <div class="fs-3 fw-black text-neon mb-3">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>

            <div class="text-secondary mb-3 small" style="line-height: 1.6;">
                {!! nl2br(e($product->description)) !!}
            </div>

            @include('storefront.product.partials.checkout-form')
        </div>
    </div>

    @if($relatedProducts->isNotEmpty())
        <div class="mt-5 pt-4 border-top" style="border-color: var(--thz-border-sharp) !important;">
            <h4 class="text-white text-uppercase fw-black mb-3" style="font-family: 'Anton', 'Oswald', sans-serif; font-size: 1.3rem;">
                PRODUK SERUPA // {{ strtoupper($product->category->name) }}
            </h4>
            <div class="row g-2 g-md-3 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5">
                @foreach($relatedProducts as $rel)
                    @include('storefront.catalog.partials.product-card', ['product' => $rel])
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    const unitPrice = {{ $product->price }};
    const maxStock = {{ $product->stock }};

    function incrementQty() {
        const input = document.getElementById('quantity');
        let current = parseInt(input.value) || 1;
        if (current < maxStock) { input.value = current + 1; updateTotal(); }
    }
    function decrementQty() {
        const input = document.getElementById('quantity');
        let current = parseInt(input.value) || 1;
        if (current > 1) { input.value = current - 1; updateTotal(); }
    }
    function updateTotal() {
        const input = document.getElementById('quantity');
        let qty = parseInt(input.value) || 1;
        if (qty < 1) qty = 1;
        if (qty > maxStock) qty = maxStock;
        input.value = qty;
        document.getElementById('displayTotalPrice').innerText = 'Rp ' + (unitPrice * qty).toLocaleString('id-ID');
    }
</script>
@endpush
