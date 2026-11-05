@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold text-white mb-1">Kategori Pakaian</h4>
        <span class="text-muted small">Kelola master kategori produk streetwear TheHoodZ.</span>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm text-black fw-bold px-3 py-2" style="background-color: #D4FF00; border-radius: 8px;">
        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
    </a>
</div>

<div class="card card-admin p-4">
    <div class="table-responsive">
        <table class="table table-admin align-middle mb-0" id="categoriesTable">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Kategori</th>
                    <th>Slug URL</th>
                    <th>Jumlah Produk</th>
                    <th>Deskripsi</th>
                    <th class="text-end" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $index => $cat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="text-white fw-semibold">{{ $cat->name }}</td>
                        <td class="font-monospace text-muted small">{{ $cat->slug }}</td>
                        <td>
                            <span class="badge bg-secondary rounded-pill px-2 py-1">{{ $cat->products_count }} Produk</span>
                        </td>
                        <td class="text-muted small text-truncate" style="max-width: 280px;">{{ $cat->description ?: '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-outline-secondary text-white py-1 px-2 rounded-2" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Seluruh produk di dalamnya juga akan terhapus.');">
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
        $('#categoriesTable').DataTable({
            language: { search: "Cari Kategori:", lengthMenu: "Tampil _MENU_ data" }
        });
    });
</script>
@endpush
