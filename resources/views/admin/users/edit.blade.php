@extends('layouts.admin')

@section('title', 'Edit Pengguna: ' . ($user->username ?? $user->name))

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold text-white mb-1">Edit Pengguna: {{ $user->username }}</h4>
                <span class="text-muted small">Perbarui data profil atau atur ulang password akun ini.</span>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm text-white rounded-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card card-admin p-4">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label text-muted small fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control rounded-2 @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="username" class="form-label text-muted small fw-semibold">Username</label>
                        <input type="text" name="username" id="username" class="form-control rounded-2 @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="role" class="form-label text-muted small fw-semibold">Role Hak Akses</label>
                        <select name="role" id="role" class="form-select rounded-2 @error('role') is-invalid @enderror" required {{ auth()->id() === $user->id ? 'disabled' : '' }}>
                            <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @if(auth()->id() === $user->id)
                            <input type="hidden" name="role" value="{{ $user->role }}">
                            <div class="form-text text-muted" style="font-size: 0.72rem;">Role akun aktif tidak dapat diubah sendiri.</div>
                        @endif
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-muted small fw-semibold">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-2 @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="password" class="form-label text-muted small fw-semibold">Password Baru (Opsional)</label>
                        <input type="password" name="password" id="password" class="form-control rounded-2 @error('password') is-invalid @enderror" placeholder="Biarkan kosong jika tetap">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label text-muted small fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-2" placeholder="Ulangi password baru">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3" style="border-color: var(--admin-border) !important;">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary rounded-2 px-3">Batal</a>
                    <button type="submit" class="btn text-black fw-bold px-4 rounded-2" style="background-color: #D4FF00;">Perbarui Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
