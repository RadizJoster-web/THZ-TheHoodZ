<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CheckoutOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\FileUploadService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

/**
 * Mengelola proses checkout pembelian langsung oleh pelanggan TheHoodZ.
 */
class CheckoutController extends Controller
{
    protected FileUploadService $fileService;

    public function __construct(FileUploadService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Memproses pesanan baru pelanggan dan mengurangi stok produk secara aman.
     */
    public function checkout(CheckoutOrderRequest $request, Product $product): RedirectResponse
    {
        if ($product->stock < $request->input('quantity')) {
            return back()->with('error', 'Maaf, stok produk tidak mencukupi untuk jumlah pembelian ini.');
        }

        $proofPath = $request->hasFile('payment_proof')
            ? $this->fileService->upload($request->file('payment_proof'), 'payments')
            : null;

        $orderCode = 'THZ-' . Carbon::now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        DB::transaction(function () use ($request, $product, $proofPath, $orderCode) {
            Order::create([
                'order_code' => $orderCode,
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->input('quantity'),
                'total_price' => $product->price * $request->input('quantity'),
                'shipping_address' => $request->input('shipping_address'),
                'payment_proof' => $proofPath,
                'status' => 'pending',
            ]);

            $product->decrement('stock', $request->input('quantity'));
        });

        return redirect()->route('my-orders.index')->with(
            'success',
            "Pesanan {$orderCode} berhasil dibuat! Silakan unggah bukti transfer jika belum diunggah."
        );
    }
}
