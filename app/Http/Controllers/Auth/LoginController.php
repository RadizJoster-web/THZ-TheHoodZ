<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Mengelola proses autentikasi login pengguna (Admin & Customer).
 */
class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Memvalidasi kredensial login dan mengarahkan pengguna sesuai role.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, Admin!')
                : redirect()->intended(route('home'))->with('success', 'Berhasil login ke TheHoodZ.');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }
}
