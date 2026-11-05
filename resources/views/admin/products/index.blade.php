@extends('layouts.admin')

@section('title', 'Manajemen Produk Pakaian')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold text-white mb-1">Inventaris Produk Pakaian</h4>
        <span class="text-muted small">Kelola katalog produk, penetapan harga, stok, dan galeri foto TheHoodZ.</span>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-sm text-black fw-bold px-3 py-2" style="background-color: #D4FF00; border-radius: 8px;">
        <i class="bi bi-plus-lg me-1"></i> Tambah Produk Baru
    </a>
</div>

<div class="card card-admin p-4">
    <div class="table-responsive">
        <table class="table table-admin align-middle mb-0" id="productsTable">
            <thead>
                <tr>
                    <th style="width: 70px;">Foto</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Ukuran</th>
                    <th>Harga Satuan</th>
                    <th>Stok</th>
                    <th class="text-end" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $prod)
                    <tr>
                        <td>
                            <img src="{{ $prod->image ? asset('storage/' . $prod->image) : asset('storage/products/hoodie-boxy-black.svg') }}" alt="{{ $prod->name }}" class="rounded-2 border border-secondary" style="width: 48px; height: 56px; object-fit: cover;">
                        </td>
                        <td>
                            <span class="text-white fw-semibold d-block">{{ $prod->name }}</span>
                            <span class="text-muted small font-monospace">{{ $prod->slug }}</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary rounded-pill">{{ $prod->category->name }}</span>
                        </td>
                        <td>
                            <span class="badge bg-dark border border-secondary text-white">{{ $prod->size }}</span>
                        </td>
                        <td class="fw-bold text-white">
                            Rp {{ number_format($prod->price, 0, ',', '.') }}
                        </td>
                        <td>
                            <span class="badge rounded-pill {{ $prod->stock <= 5 ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' }}">
                                {{ $prod->stock }} pcs
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('product.show', $prod->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary text-white py-1 px-2 rounded-2" title="Lihat di Toko">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-sm btn-outline-secondary text-white py-1 px-2 rounded-2" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2 rounded-2" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#productsTable').DataTable({
            language: { search: "Cari Produk:", lengthMenu: "Tampil _MENU_ data" }
        });
    });
</script>
@endpush
