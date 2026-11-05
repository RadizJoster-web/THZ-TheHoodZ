<?php

namespace App\Http\Requests\Order;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi form checkout pembelian langsung oleh pelanggan TheHoodZ.
 */
class CheckoutOrderRequest extends FormRequest
{
    /**
     * Menentukan izin akses request (wajib login).
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Aturan validasi pembelian langsung.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = Product::find($this->input('product_id'));
        $maxStock = $product ? max(1, $product->stock) : 1;

        return [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:' . $maxStock,
            'shipping_address' => 'required|string|min:15|max:500',
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
            'product_id.required' => 'Produk wajib dipilih.',
            'product_id.exists' => 'Produk tidak ditemukan.',
            'quantity.required' => 'Jumlah pembelian wajib diisi.',
            'quantity.min' => 'Jumlah pembelian minimal 1 item.',
            'quantity.max' => 'Jumlah pembelian melebihi stok yang tersedia.',
            'shipping_address.required' => 'Alamat pengiriman lengkap wajib diisi.',
            'shipping_address.min' => 'Alamat pengiriman terlalu singkat (minimal 15 karakter).',
            'shipping_address.max' => 'Alamat pengiriman maksimal 500 karakter.',
            'payment_proof.image' => 'Bukti pembayaran harus berupa file gambar.',
            'payment_proof.mimes' => 'Format file bukti bayar harus jpeg, png, jpg, atau webp.',
            'payment_proof.max' => 'Ukuran file bukti pembayaran maksimal 2MB.',
        ];
    }
}
