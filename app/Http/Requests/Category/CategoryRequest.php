<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi penambahan dan pembaruan data kategori pakaian.
 */
class CategoryRequest extends FormRequest
{
    /**
     * Menentukan izin otorisasi request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Aturan validasi untuk kategori.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $category = $this->route('category');
        $categoryId = is_object($category) ? $category->id : $category;

        return [
            'name' => 'required|string|max:100|unique:categories,name,' . $categoryId,
            'description' => 'nullable|string|max:500',
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
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori ini sudah terdaftar.',
            'name.max' => 'Nama kategori maksimal 100 karakter.',
            'description.max' => 'Deskripsi maksimal 500 karakter.',
        ];
    }
}
