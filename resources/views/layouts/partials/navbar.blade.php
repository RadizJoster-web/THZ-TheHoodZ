<nav class="navbar navbar-expand-lg sticky-top border-bottom" style="background-color: #0A0A0A; border-color: #1F1F1F !important;">
    <div class="container-fluid px-3 px-md-4 px-lg-5">
        <a class="navbar-brand d-flex align-items-center text-white text-decoration-none" href="{{ route('home') }}">
            <span class="fw-black tracking-wider" style="font-family: 'Anton', 'Oswald', sans-serif; letter-spacing: 0.08em; font-size: clamp(1.2rem, 3vw, 1.6rem);">THEHOODZ</span>
            <span class="badge ms-2 px-2 py-1 text-black fw-bold rounded-0" style="background-color: #D4FF00; font-size: 0.6rem; letter-spacing: 0.08em;">THZ</span>
        </a>

        <div class="d-flex align-items-center gap-2 d-lg-none">
            @auth
                <a href="{{ route('my-orders.index') }}" class="btn btn-outline-secondary text-white border-0 position-relative p-2" title="Pesanan Saya">
                    <i class="bi bi-bag-check fs-5"></i>
                    @php $userOrderCount = \App\Models\Order::where('user_id', auth()->id())->where('status', 'pending')->count(); @endphp
                    @if($userOrderCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-black fw-bold" style="background-color: #D4FF00; font-size: 0.6rem;">{{ $userOrderCount }}</span>
                    @endif
                </a>
            @endauth
            <button class="navbar-toggler border-0 text-white p-1" type="button" data-bs-toggle="collapse" data-bs-target="#thzNavbar" aria-controls="thzNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2 text-white"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse mt-2 mt-lg-0" id="thzNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.1em; font-weight: 600;">
                <li class="nav-item"><a class="nav-link px-2 px-lg-3 text-secondary thz-nav-link" href="{{ route('home') }}">SHOP ALL</a></li>
                <li class="nav-item"><a class="nav-link px-2 px-lg-3 text-secondary thz-nav-link" href="{{ route('home', ['category' => 'hoodie']) }}">HOODIE</a></li>
                <li class="nav-item"><a class="nav-link px-2 px-lg-3 text-secondary thz-nav-link" href="{{ route('home', ['category' => 'jacket']) }}">JACKET</a></li>
                <li class="nav-item"><a class="nav-link px-2 px-lg-3 text-secondary thz-nav-link" href="{{ route('home', ['category' => 'sweater']) }}">SWEATER</a></li>
                <li class="nav-item"><a class="nav-link px-2 px-lg-3 text-secondary thz-nav-link" href="{{ route('home', ['category' => 'baju']) }}">BAJU</a></li>
            </ul>

            <div class="d-flex flex-wrap align-items-center gap-2 pt-2 pt-lg-0 border-top border-lg-0 border-dark">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm text-black fw-bold rounded-0 px-3 py-2" style="background-color: #D4FF00; font-size: 0.75rem;">
                            <i class="bi bi-speedometer2 me-1"></i> ADMIN DASHBOARD
                        </a>
                    @endif

                    <a href="{{ route('my-orders.index') }}" class="btn btn-outline-secondary text-white border-0 position-relative p-2 d-none d-lg-inline-block" title="Pesanan Saya">
                        <i class="bi bi-bag-check fs-5"></i>
                        @if($userOrderCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-black fw-bold" style="background-color: #D4FF00; font-size: 0.65rem;">{{ $userOrderCount }}</span>
                        @endif
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle rounded-0 border-0 text-white btn-sm py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #161618;">
                            <i class="bi bi-person-circle me-1 text-neon"></i> {{ auth()->user()->username ?? auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end rounded-0 border-secondary bg-dark" style="font-size: 0.8rem;">
                            <li><a class="dropdown-item text-white py-2" href="{{ route('my-orders.index') }}"><i class="bi bi-receipt me-2"></i> Riwayat Pesanan</a></li>
                            @if(auth()->user()->role === 'admin')
                                <li><a class="dropdown-item text-white py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-shield-lock me-2"></i> Panel Admin</a></li>
                            @endif
                            <li><hr class="dropdown-divider border-secondary"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger py-2"><i class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light rounded-0 px-3 py-2 text-uppercase fw-semibold" style="font-size: 0.75rem;">LOGIN</a>
                    <a href="{{ route('register') }}" class="btn text-black fw-bold rounded-0 px-3 py-2 text-uppercase" style="background-color: #D4FF00; font-size: 0.75rem;">REGISTER</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
