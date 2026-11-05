@extends('layouts.app')

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="p-4 p-md-5 border" style="background-color: var(--thz-bg-secondary); border-color: var(--thz-border-sharp) !important;">
                <div class="text-center mb-4">
                    <span class="badge rounded-0 px-2 py-1 text-black fw-bold mb-2" style="background-color: #D4FF00; font-size: 0.7rem;">JOIN THE CULTURE</span>
                    <h2 class="text-uppercase fw-black text-white" style="font-family: 'Anton', 'Oswald', sans-serif; letter-spacing: 0.05em;">DAFTAR AKUN BARU</h2>
                    <p class="text-secondary small mb-0">Daftar sekarang untuk memesan drop pakaian terbaru TheHoodZ.</p>
                </div>

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label text-uppercase fw-semibold text-secondary" style="font-size: 0.75rem;">Username</label>
                            <input id="username" type="text" class="form-control rounded-0 border-secondary @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus placeholder="thz_crew" style="background: #18181A; color: #FFF;">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label text-uppercase fw-semibold text-secondary" style="font-size: 0.75rem;">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control rounded-0 border-secondary @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Budi Streetwear" style="background: #18181A; color: #FFF;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-uppercase fw-semibold text-secondary" style="font-size: 0.75rem;">Alamat Email</label>
                        <input id="email" type="email" class="form-control rounded-0 border-secondary @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="budi@example.com" style="background: #18181A; color: #FFF;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="password" class="form-label text-uppercase fw-semibold text-secondary" style="font-size: 0.75rem;">Password (Min. 8)</label>
                            <input id="password" type="password" class="form-control rounded-0 border-secondary @error('password') is-invalid @enderror" name="password" required placeholder="••••••••" style="background: #18181A; color: #FFF;">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label text-uppercase fw-semibold text-secondary" style="font-size: 0.75rem;">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password" class="form-control rounded-0 border-secondary" name="password_confirmation" required placeholder="••••••••" style="background: #18181A; color: #FFF;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-neon w-100 py-3 text-uppercase fw-black" style="letter-spacing: 0.08em;">
                        BUAT AKUN SAYA <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </form>

                <div class="mt-4 pt-4 border-top border-dark text-center">
                    <p class="text-secondary small mb-0">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="text-neon text-decoration-none fw-bold ms-1">Login Di Sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
