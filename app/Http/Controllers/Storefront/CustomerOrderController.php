<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Mengelola riwayat pesanan pelanggan dan pengunggahan bukti transfer pembayaran.
 */
class CustomerOrderController extends Controller
{
    protected FileUploadService $fileService;

    public function __construct(FileUploadService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Menampilkan daftar seluruh pesanan yang pernah dilakukan oleh pelanggan yang login.
     */
    public function index(): View
    {
        $orders = Order::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('storefront.orders.index', compact('orders'));
    }

    /**
     * Mengunggah atau memperbarui foto bukti transfer untuk pesanan berstatus pending.
     */
    public function uploadProof(Request $request, Order $order): RedirectResponse
    {
        if ($order->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki hak untuk memperbarui pesanan ini.');
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Bukti bayar hanya dapat diperbarui ketika status pesanan masih Menunggu Verifikasi (Pending).');
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'payment_proof.required' => 'File bukti transfer pembayaran wajib dipilih.',
            'payment_proof.image' => 'File yang diunggah harus berupa gambar.',
            'payment_proof.mimes' => 'Format file gambar harus jpeg, png, jpg, atau webp.',
            'payment_proof.max' => 'Ukuran file gambar maksimal 2MB.',
        ]);

        $this->fileService->delete($order->payment_proof);
        $order->payment_proof = $this->fileService->upload($request->file('payment_proof'), 'payments');
        $order->save();

        return back()->with('success', 'Bukti transfer pembayaran berhasil diunggah. Tim Admin akan segera memverifikasinya.');
    }
}
