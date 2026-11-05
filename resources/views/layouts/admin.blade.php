<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | TheHoodZ Backoffice</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --admin-bg-canvas: #09090B;
            --admin-bg-card: #121215;
            --admin-bg-subtle: #18181C;
            --admin-border: #222226;
            --admin-text-main: #F4F4F5;
            --admin-text-muted: #71717A;
            --admin-emerald: #10B981;
            --admin-rose: #F43F5E;
            --admin-amber: #F59E0B;
        }

        body {
            background-color: var(--admin-bg-canvas);
            color: var(--admin-text-main);
            font-family: 'Inter', -apple-system, sans-serif;
            overflow-x: hidden;
        }

        .text-emerald { color: var(--admin-emerald) !important; }
        .text-rose { color: var(--admin-rose) !important; }
        .text-amber { color: var(--admin-amber) !important; }
        .card-admin { background-color: var(--admin-bg-card); border: 1px solid var(--admin-border); border-radius: 10px; }

        .active-admin-pill { background-color: #1C1C21 !important; color: #FFFFFF !important; font-weight: 600; }
        .text-muted-admin { color: var(--admin-text-muted) !important; border-radius: 6px; transition: all 0.2s; }
        .text-muted-admin:hover { background-color: var(--admin-bg-subtle); color: var(--admin-text-main) !important; }

        /* Fixed Sidebar Architecture */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 240px;
            z-index: 1040;
            background-color: var(--admin-bg-canvas);
            border-right: 1px solid var(--admin-border);
            overflow-y: auto;
            transition: transform 0.25s ease;
        }
        .admin-main-wrapper {
            margin-left: 240px;
            min-height: 100vh;
            padding: 1.5rem 2rem;
            transition: margin-left 0.25s ease;
        }
        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            z-index: 1030;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.show { transform: translateX(0); }
            .admin-main-wrapper { margin-left: 0; padding: 1rem; }
            .sidebar-backdrop.show { display: block; }
        }

        .table-admin { --bs-table-bg: transparent; --bs-table-hover-bg: #18181C; --bs-table-color: var(--admin-text-main); --bs-table-border-color: var(--admin-border); }
        .table-admin thead th { color: var(--admin-text-muted); font-size: 0.72rem; text-transform: uppercase; border-bottom: 1px solid var(--admin-border); }
        .form-control, .form-select { background-color: #141417; border-color: #27272A; color: var(--admin-text-main); font-size: 0.85rem; }
        .form-control:focus, .form-select:focus { background-color: #18181C; border-color: #52525B; color: #FFF; box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.08); }
    </style>
    @stack('styles')
</head>
<body>
    @include('layouts.partials.sidebar')
    <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()"></div>

    <div class="admin-main-wrapper">
        <!-- Mobile Header Bar -->
        <div class="d-lg-none d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom" style="border-color: var(--admin-border) !important;">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-dark me-2 border-secondary" type="button" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <span class="fw-bold fs-6">THEHOODZ ADMIN</span>
            </div>
            <span class="badge bg-secondary font-monospace" style="font-size: 0.65rem;">PANEL</span>
        </div>

        @include('layouts.partials.alerts')
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('show');
            document.getElementById('sidebarBackdrop').classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>
</html>
