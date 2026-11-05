<?php

namespace App\Http\Requests\Order;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi pembuatan pesanan manual oleh Admin TheHoodZ.
 */
class StoreOrderRequest extends FormRequest
{
    /**
     * Menentukan otorisasi admin.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Aturan validasi input pesanan.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = Product::find($this->input('product_id'));
        $maxStock = $product ? max(1, $product->stock) : 1;

        return [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:' . $maxStock,
            'shipping_address' => 'required|string|min:15|max:500',
            'status' => 'required|in:pending,paid,shipped,completed,cancelled',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
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
            'user_id.required' => 'Pengguna/Pembeli wajib dipilih.',
            'product_id.required' => 'Produk wajib dipilih.',
            'quantity.required' => 'Jumlah pembelian wajib diisi.',
            'quantity.max' => 'Jumlah pembelian melebihi stok yang tersedia.',
            'shipping_address.required' => 'Alamat pengiriman wajib diisi (minimal 15 karakter).',
            'status.required' => 'Status pesanan wajib ditentukan.',
            'payment_proof.image' => 'File bukti bayar harus berupa gambar.',
        ];
    }
}
