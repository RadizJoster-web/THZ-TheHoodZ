<div class="col">
    <div class="product-card h-100 d-flex flex-column position-relative">
        <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none d-block">
            <div class="img-zoom-container position-relative" style="aspect-ratio: 4/5;">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/products/hoodie-boxy-black.svg') }}" alt="{{ $product->name }}" loading="lazy">
                
                <span class="position-absolute top-0 start-0 m-1 m-md-2 badge rounded-0 bg-dark text-white border border-secondary" style="font-size: 0.6rem;">
                    {{ $product->size }}
                </span>

                @if($product->stock <= 0)
                    <div class="position-absolute top-50 start-50 translate-middle badge rounded-0 bg-danger text-uppercase px-2 py-1 fw-bold text-nowrap" style="letter-spacing: 0.05em; font-size: 0.65rem;">
                        SOLD OUT
                    </div>
                @elseif($product->stock <= 5)
                    <span class="position-absolute bottom-0 start-0 m-1 m-md-2 badge rounded-0 bg-warning text-black fw-bold" style="font-size: 0.55rem;">
                        SISA {{ $product->stock }}
                    </span>
                @endif
            </div>
        </a>

        <div class="p-2 p-md-3 mt-auto d-flex align-items-center justify-content-between border-top" style="border-color: var(--thz-border-sharp) !important;">
            <div class="overflow-hidden pe-1 pe-md-2">
                <span class="text-secondary d-block text-uppercase" style="font-size: 0.58rem; letter-spacing: 0.05em;">
                    {{ $product->category->name }}
                </span>
                <a href="{{ route('product.show', $product->slug) }}" class="text-white text-decoration-none fw-bold text-uppercase d-block text-truncate" style="font-size: 0.78rem;" title="{{ $product->name }}">
                    {{ $product->name }}
                </a>
                <span class="text-neon fw-bold d-block mt-1" style="font-size: 0.85rem;">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>

            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-neon rounded-0 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 30px; height: 30px;" title="Lihat & Beli">
                <i class="bi bi-plus-lg fs-6"></i>
            </a>
        </div>
    </div>
</div>
