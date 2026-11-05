<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Official Store') | TheHoodZ (THZ)</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&family=Oswald:wght@500;700&family=Permanent+Marker&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 & Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --thz-bg-primary: #0A0A0A;
            --thz-bg-secondary: #121212;
            --thz-bg-paper: #EDEDED;
            --thz-accent-neon: #D4FF00;
            --thz-accent-neon-hover: #B8E600;
            --thz-text-primary: #FFFFFF;
            --thz-text-muted: #9CA3AF;
            --thz-border-sharp: #262626;
        }

        body {
            background-color: var(--thz-bg-primary);
            color: var(--thz-text-primary);
            font-family: 'Inter', -apple-system, sans-serif;
            overflow-x: hidden;
        }

        .text-neon { color: var(--thz-accent-neon) !important; }
        .bg-neon { background-color: var(--thz-accent-neon) !important; color: #000 !important; }
        .btn-neon {
            background-color: var(--thz-accent-neon);
            color: #000;
            font-weight: 700;
            border-radius: 0;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-neon:hover {
            background-color: var(--thz-accent-neon-hover);
            color: #000;
        }

        .thz-nav-link:hover { color: var(--thz-accent-neon) !important; }

        .product-card {
            background-color: var(--thz-bg-secondary);
            border: 1px solid var(--thz-border-sharp);
            border-radius: 0;
            transition: transform 0.2s ease, border-color 0.2s ease;
        }
        .product-card:hover {
            transform: translateY(-3px);
            border-color: #444;
        }

        .img-zoom-container {
            overflow: hidden;
            background: #141416;
            aspect-ratio: 4/5;
        }
        .img-zoom-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.35s ease;
        }
        .product-card:hover .img-zoom-container img { transform: scale(1.04); }

        /* Custom TheHoodZ Dark Pagination */
        .pagination { margin: 0; gap: 4px; }
        .pagination .page-item .page-link {
            background-color: #121215;
            border: 1px solid #27272A;
            color: #E4E4E7;
            border-radius: 0 !important;
            padding: 8px 14px;
            font-size: 0.85rem;
            box-shadow: none !important;
        }
        .pagination .page-item .page-link:hover {
            background-color: #1E1E24;
            color: #D4FF00;
            border-color: #52525B;
        }
        .pagination .page-item.active .page-link {
            background-color: #D4FF00 !important;
            border-color: #D4FF00 !important;
            color: #000000 !important;
            font-weight: 700;
        }
        .pagination .page-item.disabled .page-link {
            background-color: #0C0C0E;
            border-color: #1F1F23;
            color: #52525B;
        }

        @media (min-width: 992px) {
            .row-cols-lg-5 > * { flex: 0 0 auto; width: 20%; }
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('layouts.partials.navbar')

    <main>
        <div class="container-fluid px-3 px-md-4 px-lg-5 pt-3">
            @include('layouts.partials.alerts')
        </div>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
