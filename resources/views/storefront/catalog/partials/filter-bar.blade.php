<div class="row g-3 align-items-center mb-4 pb-3 border-bottom" style="border-color: var(--thz-border-sharp) !important;">
    <div class="col-lg-6">
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('home') }}" class="btn btn-sm rounded-0 text-uppercase fw-semibold {{ !request('category') ? 'btn-neon' : 'btn-dark border-secondary text-secondary' }}">
                ALL DROPS ({{ \App\Models\Product::count() }})
            </a>
            @foreach($categories as $category)
                <a href="{{ route('home', array_merge(request()->except('category', 'page'), ['category' => $category->slug])) }}" class="btn btn-sm rounded-0 text-uppercase fw-semibold {{ request('category') === $category->slug ? 'btn-neon' : 'btn-dark border-secondary text-secondary' }}">
                    {{ $category->name }} ({{ $category->products_count }})
                </a>
            @endforeach
        </div>
    </div>

    <div class="col-lg-6">
        <form method="GET" action="{{ route('home') }}" class="row g-2 justify-content-lg-end">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            <div class="col-7 col-sm-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text rounded-0 border-secondary bg-dark text-secondary"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control rounded-0 border-secondary bg-dark text-white" placeholder="Cari nama produk..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-5 col-sm-4">
                <select name="sort" class="form-select form-select-sm rounded-0 border-secondary bg-dark text-white" onchange="this.form.submit()">
                    <option value="">Terbaru</option>
                    <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                    <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Nama (A-Z)</option>
                </select>
            </div>
        </form>
    </div>
</div>
