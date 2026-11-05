@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold text-white mb-1">Tambah Produk Baru</h4>
                <span class="text-muted small">Input item pakaian baru lengkap dengan foto dan spesifikasi.</span>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm text-white rounded-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card card-admin p-4">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.products.partials.form-fields')

                <div class="d-flex justify-content-end gap-2 border-top pt-3" style="border-color: var(--admin-border) !important;">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary rounded-2 px-3">Batal</a>
                    <button type="submit" class="btn text-black fw-bold px-4 rounded-2" style="background-color: #D4FF00;">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewSelectedImages(input) {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const card = document.createElement('div');
                    card.className = 'position-relative border rounded-2 overflow-hidden bg-black';
                    card.style.cssText = 'width: 75px; height: 95px; border-color: #333 !important;';
                    card.innerHTML = `
                        <img src="${e.target.result}" class="w-100 h-100 object-fit-cover">
                        <span class="position-absolute bottom-0 start-0 end-0 text-center py-1 text-black fw-bold" style="background: ${index === 0 ? '#D4FF00' : '#38BDF8'}; font-size: 0.55rem;">
                            ${index === 0 ? 'COVER' : 'DETAIL'}
                        </span>
                    `;
                    container.appendChild(card);
                };
                reader.readAsDataURL(file);
            });
        }
    }
</script>
@endpush
