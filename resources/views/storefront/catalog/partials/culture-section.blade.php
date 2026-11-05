<section id="culture-section" class="my-4 my-md-5 py-4 py-md-5 border-top border-bottom" style="background-color: #070708; border-color: var(--thz-border-sharp) !important;">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-4">
                <span class="text-neon fw-bold small text-uppercase font-monospace">// 01 THE ESSENTIALS</span>
                <div class="list-group list-group-flush rounded-0 mt-2 border-top border-bottom" style="border-color: #222 !important;">
                    <a href="{{ route('home', ['category' => 'baju']) }}" class="list-group-item list-group-item-action bg-transparent text-white border-0 py-2 py-md-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-neon fw-black me-2 font-monospace">01</span>
                            <span class="fw-bold text-uppercase small">BAJU / TOPS</span>
                        </div>
                        <i class="bi bi-arrow-right text-secondary"></i>
                    </a>
                    <a href="{{ route('home', ['category' => 'jacket']) }}" class="list-group-item list-group-item-action bg-transparent text-white border-0 py-2 py-md-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-neon fw-black me-2 font-monospace">02</span>
                            <span class="fw-bold text-uppercase small">JACKET / OUTERWEAR</span>
                        </div>
                        <i class="bi bi-arrow-right text-secondary"></i>
                    </a>
                    <a href="{{ route('home', ['category' => 'sweater']) }}" class="list-group-item list-group-item-action bg-transparent text-white border-0 py-2 py-md-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-neon fw-black me-2 font-monospace">03</span>
                            <span class="fw-bold text-uppercase small">SWEATER / CREWNECK</span>
                        </div>
                        <i class="bi bi-arrow-right text-secondary"></i>
                    </a>
                    <a href="{{ route('home', ['category' => 'hoodie']) }}" class="list-group-item list-group-item-action bg-transparent text-white border-0 py-2 py-md-3 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-neon fw-black me-2 font-monospace">04</span>
                            <span class="fw-bold text-uppercase small">HOODIE / HEAVYWEIGHT</span>
                        </div>
                        <i class="bi bi-arrow-right text-secondary"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 text-center px-lg-3 my-3 my-lg-0">
                <i class="bi bi-gem text-neon display-5 d-block mb-2"></i>
                <h2 class="fw-black text-white text-uppercase" style="font-family: 'Anton', 'Oswald', sans-serif; font-size: clamp(1.6rem, 3.5vw, 2.4rem);">
                    EXPLORE THE CULTURE
                </h2>
                <div class="mx-auto my-2 my-md-3" style="width: 60px; height: 3px; background-color: #D4FF00;"></div>
                <p class="text-secondary small mb-0" style="line-height: 1.6;">
                    From underground skate scenes to raw brutalist architecture, our garments reflect uncompromised authenticity and bold minimalism.
                </p>
            </div>

            <div class="col-lg-4">
                <div class="p-3 p-md-4 border position-relative" style="background-color: var(--thz-bg-secondary); border-color: var(--thz-border-sharp) !important;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge rounded-0 bg-dark text-white border border-secondary" style="font-size: 0.65rem;">DROP ARCHIVE</span>
                        <span class="text-neon fw-bold small">THZ // 2026</span>
                    </div>
                    <div class="img-zoom-container mb-2" style="aspect-ratio: 16/10;">
                        <img src="{{ asset('storage/products/sweater-vintage-grey.svg') }}" alt="Culture Preview">
                    </div>
                    <h6 class="text-white text-uppercase fw-bold mb-1">RAW EDGES & VINTAGE</h6>
                    <p class="text-secondary small mb-0" style="font-size: 0.75rem;">Setiap batch diproduksi terbatas dengan standar gramasi kain terbaik di kelasnya.</p>
                </div>
            </div>
        </div>
    </div>
</section>
