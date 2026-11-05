@extends('layouts.app')

@section('title', 'Login Pengguna')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="p-4 p-md-5 border" style="background-color: var(--thz-bg-secondary); border-color: var(--thz-border-sharp) !important;">
                <div class="text-center mb-4">
                    <span class="badge rounded-0 px-2 py-1 text-black fw-bold mb-2" style="background-color: #D4FF00; font-size: 0.7rem;">THEHOODZ ID</span>
                    <h2 class="text-uppercase fw-black text-white" style="font-family: 'Anton', 'Oswald', sans-serif; letter-spacing: 0.05em;">LOGIN KE AKUN</h2>
                    <p class="text-secondary small mb-0">Masuk untuk checkout langsung dan pantau pesanan Anda.</p>
                </div>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label text-uppercase fw-semibold text-secondary" style="font-size: 0.75rem; letter-spacing: 0.05em;">Email</label>
                        <input id="email" type="email" class="form-control rounded-0 border-secondary @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nama@email.com" style="background: #18181A; color: #FFF;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-uppercase fw-semibold text-secondary" style="font-size: 0.75rem; letter-spacing: 0.05em;">Password</label>
                        <input id="password" type="password" class="form-control rounded-0 border-secondary @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••" style="background: #18181A; color: #FFF;">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input rounded-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-secondary small" for="remember">
                                Ingat Saya
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-neon w-100 py-3 text-uppercase fw-black" style="letter-spacing: 0.08em;">
                        MASUK SEKARANG <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </form>

                <div class="mt-4 pt-4 border-top border-dark text-center">
                    <p class="text-secondary small mb-0">
                        Belum punya akun TheHoodZ?
                        <a href="{{ route('register') }}" class="text-neon text-decoration-none fw-bold ms-1">Daftar Di Sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
