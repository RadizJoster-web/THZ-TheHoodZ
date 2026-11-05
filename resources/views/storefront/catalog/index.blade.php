@extends('layouts.app')

@section('title', 'Katalog Streetwear')

@section('content')
    @include('storefront.catalog.partials.hero')
    @include('storefront.catalog.partials.ticker')

    <div class="container-fluid px-3 px-md-4 px-lg-5 my-4 my-md-5" id="product-drops">
        <div class="d-flex align-items-center justify-content-between mb-3 mb-md-4">
            <div class="d-flex align-items-center">
                <h2 class="text-uppercase fw-black text-white m-0 me-2 me-md-3" style="font-family: 'Anton', 'Oswald', sans-serif; letter-spacing: 0.05em; font-size: clamp(1.4rem, 4vw, 2.2rem);">
                    NEW DROPS
                </h2>
                <span class="text-neon fs-4"><i class="bi bi-arrow-right"></i></span>
            </div>
            <span class="badge rounded-0 bg-dark text-secondary border border-secondary px-2 px-md-3 py-2 text-uppercase" style="font-size: 0.7rem;">
                {{ $products->total() }} PRODUK
            </span>
        </div>

        @include('storefront.catalog.partials.filter-bar')

        @if($products->isEmpty())
            <div class="p-5 text-center border my-4" style="background-color: var(--thz-bg-secondary); border-color: var(--thz-border-sharp) !important;">
                <i class="bi bi-search text-secondary display-4 d-block mb-3"></i>
                <h4 class="text-white text-uppercase fw-bold">PRODUK TIDAK DITEMUKAN</h4>
                <p class="text-secondary small mb-4">Tidak ada pakaian yang cocok dengan kriteria filter atau pencarian Anda saat ini.</p>
                <a href="{{ route('home') }}" class="btn btn-neon px-4 py-2 text-uppercase">
                    RESET FILTER
                </a>
            </div>
        @else
            <div class="row g-2 g-md-3 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5">
                @foreach($products as $product)
                    @include('storefront.catalog.partials.product-card', ['product' => $product])
                @endforeach
            </div>

            <div class="mt-4 mt-md-5 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    @include('storefront.catalog.partials.culture-section')
    @include('storefront.catalog.partials.limited-section')
@endsection
