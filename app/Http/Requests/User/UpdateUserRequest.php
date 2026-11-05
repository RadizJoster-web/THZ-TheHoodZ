<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi pengubahan profil dan hak akses pengguna oleh Admin.
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Menentukan otorisasi admin.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Aturan validasi pengubahan data pengguna.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');
        $userId = is_object($user) ? $user->id : $user;

        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|alpha_dash|max:50|unique:users,username,' . $userId,
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'role' => 'required|in:admin,customer',
            'password' => 'nullable|string|min:8|confirmed',
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
            'name.required' => 'Nama pengguna wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan oleh akun lain.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar pada akun lain.',
            'role.required' => 'Role pengguna wajib dipilih.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ];
    }
}
