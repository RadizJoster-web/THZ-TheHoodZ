<div class="modal fade" id="uploadProofModal{{ $order->id }}" tabindex="-1" aria-labelledby="uploadProofLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 border-secondary bg-dark text-white">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-uppercase fw-bold" id="uploadProofLabel{{ $order->id }}">
                    <i class="bi bi-upload text-neon me-2"></i> UNGGAH BUKTI TRANSFER
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('my-orders.upload', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p class="text-secondary small mb-3">
                        Nomor Pesanan: <strong class="text-white">{{ $order->order_code }}</strong><br>
                        Total Bayar: <strong class="text-neon">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                    </p>

                    @if($order->payment_proof)
                        <div class="mb-3 text-center">
                            <span class="d-block text-secondary small mb-1">Bukti yang saat ini diunggah:</span>
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Transfer" class="img-thumbnail bg-black border-secondary" style="max-height: 150px;">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="proofInput{{ $order->id }}" class="form-label text-secondary small text-uppercase fw-semibold">Pilih File Foto Bukti Transfer</label>
                        <input type="file" name="payment_proof" id="proofInput{{ $order->id }}" class="form-control rounded-0 bg-black border-secondary text-white" accept="image/*" required>
                        <div class="form-text text-secondary" style="font-size: 0.72rem;">Format gambar JPG, PNG, atau WEBP (maksimal 2MB).</div>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary rounded-0 text-white" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-neon rounded-0 text-uppercase fw-bold">UNGGAH BUKTI</button>
                </div>
            </form>
        </div>
    </div>
</div>
