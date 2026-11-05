<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Mengelola verifikasi pesanan, status transaksi, dan bukti bayar pelanggan.
 */
class OrderController extends Controller
{
    protected FileUploadService $fileService;

    public function __construct(FileUploadService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Menampilkan daftar pesanan dengan filter status dan relasi.
     */
    public function index(): View
    {
        $status = request('status');
        $query = Order::with(['user', 'product'])->latest();

        if ($status && in_array($status, ['pending', 'paid', 'shipped', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }

        $orders = $query->get();
        return view('admin.orders.index', compact('orders', 'status'));
    }

    /**
     * Menampilkan form pembuatan pesanan manual.
     */
    public function create(): View
    {
        $users = User::all();
        $products = Product::where('stock', '>', 0)->get();
        return view('admin.orders.create', compact('users', 'products'));
    }

    /**
     * Menyimpan pesanan manual baru dan memotong stok barang.
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $product = Product::findOrFail($request->input('product_id'));
        $proofPath = $request->hasFile('payment_proof')
            ? $this->fileService->upload($request->file('payment_proof'), 'payments')
            : null;

        $orderCode = 'THZ-' . Carbon::now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        Order::create([
            'order_code' => $orderCode,
            'user_id' => $request->input('user_id'),
            'product_id' => $product->id,
            'quantity' => $request->input('quantity'),
            'total_price' => $product->price * $request->input('quantity'),
            'shipping_address' => $request->input('shipping_address'),
            'payment_proof' => $proofPath,
            'status' => $request->input('status'),
        ]);

        $product->decrement('stock', $request->input('quantity'));

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan manual berhasil dibuat.');
    }

    /**
     * Menampilkan halaman detail pesanan dan bukti bayar.
     */
    public function show(Order $order): View
    {
        $order->load(['user', 'product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Menampilkan form edit status pesanan.
     */
    public function edit(Order $order): View
    {
        $order->load(['user', 'product']);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Memperbarui status pesanan dan memulihkan stok jika dibatalkan.
     */
    public function update(UpdateOrderRequest $request, Order $order): RedirectResponse
    {
        $oldStatus = $order->status;
        $newStatus = $request->input('status');

        if ($request->hasFile('payment_proof')) {
            $this->fileService->delete($order->payment_proof);
            $order->payment_proof = $this->fileService->upload($request->file('payment_proof'), 'payments');
        }

        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            $order->product->increment('stock', $order->quantity);
        } elseif ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {
            $order->product->decrement('stock', $order->quantity);
        }

        $order->status = $newStatus;
        $order->shipping_address = $request->input('shipping_address');
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Menghapus pesanan dan berkas bukti bayar terkait.
     */
    public function destroy(Order $order): RedirectResponse
    {
        $this->fileService->delete($order->payment_proof);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
