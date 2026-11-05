<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi form pendaftaran akun customer baru TheHoodZ.
 */
class RegisterRequest extends FormRequest
{
    /**
     * Menentukan izin akses pengguna untuk request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi pendaftaran pengguna baru.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:100',
            'username' => 'required|string|alpha_dash|min:3|max:50|unique:users,username',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Pesan kesalahan validasi dalam Bahasa Indonesia.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'username.alpha_dash' => 'Username hanya boleh berupa huruf, angka, tanda strip, atau garis bawah.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.unique' => 'Username ini sudah digunakan.',
            'email.required' => 'Email aktif wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }
}
