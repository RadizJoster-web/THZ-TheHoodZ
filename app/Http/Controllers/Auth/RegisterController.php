<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Mengelola pendaftaran akun baru bagi customer TheHoodZ.
 */
class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi pengguna baru.
     */
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    /**
     * Menyimpan data customer baru dan langsung mengarahkan ke halaman utama.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->input('name') ?: $request->input('username'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'customer',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Akun berhasil dibuat. Selamat datang di TheHoodZ!');
    }
}
