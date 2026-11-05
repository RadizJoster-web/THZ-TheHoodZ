<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validasi pengubahan status dan bukti pembayaran pesanan oleh Admin.
 */
class UpdateOrderRequest extends FormRequest
{
    /**
     * Menentukan otorisasi admin.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Aturan validasi status dan detail pesanan.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,paid,shipped,completed,cancelled',
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
            'status.required' => 'Status pesanan wajib ditentukan.',
            'status.in' => 'Status yang dipilih tidak valid.',
            'shipping_address.required' => 'Alamat pengiriman wajib diisi.',
            'payment_proof.image' => 'File bukti transfer harus berupa gambar.',
        ];
    }
}
