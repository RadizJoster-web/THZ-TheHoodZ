<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi penambahan produk baru pakaian TheHoodZ.
 */
class StoreProductRequest extends FormRequest
{
    /**
     * Menentukan izin otorisasi request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Aturan validasi penyimpanan produk baru.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'size' => 'required|in:S,M,L,XL,XXL',
            'price' => 'required|integer|min:1000',
            'stock' => 'required|integer|min:0',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'required|string|min:10',
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
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'name.required' => 'Nama produk wajib diisi.',
            'size.required' => 'Ukuran produk wajib dipilih.',
            'size.in' => 'Ukuran harus salah satu dari: S, M, L, XL, atau XXL.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.min' => 'Harga produk minimal Rp 1.000.',
            'stock.required' => 'Jumlah stok wajib diisi.',
            'stock.min' => 'Stok produk tidak boleh bernilai negatif.',
            'images.required' => 'Minimal 1 foto produk wajib diunggah.',
            'images.min' => 'Minimal 1 foto produk wajib diunggah.',
            'images.*.image' => 'Setiap berkas yang diunggah harus berupa gambar.',
            'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'images.*.max' => 'Ukuran setiap gambar maksimal 2MB.',
            'description.required' => 'Deskripsi produk wajib diisi (minimal 10 karakter).',
            'description.min' => 'Deskripsi produk minimal 10 karakter.',
        ];
    }
}
