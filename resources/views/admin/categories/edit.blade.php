@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold text-white mb-1">Edit Kategori: {{ $category->name }}</h4>
                <span class="text-muted small">Perbarui data nama dan deskripsi kategori pakaian.</span>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm text-white rounded-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card card-admin p-4">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label text-muted small fw-semibold">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control rounded-2 @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label text-muted small fw-semibold">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="form-control rounded-2 @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary rounded-2 px-3">Batal</a>
                    <button type="submit" class="btn text-black fw-bold px-4 rounded-2" style="background-color: #D4FF00;">Perbarui Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
