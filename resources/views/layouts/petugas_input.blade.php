<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Panel Petugas - Berkah Sari')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="@yield('description', 'Panel Petugas Input Berkah Sari')" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">

    <!-- Icon Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap + Template Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary: #348E38;
            --secondary: #525368;
            --light: #E8F5E9;
            --dark: #0F4229;
            --sidebar-width: 270px;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f5f8f5;
        }

        /* TOPBAR */
        .petugas-topbar {
            background: #ffffff;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1050;
            box-shadow: 0 0 15px rgba(0,0,0,.08);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            height: 100%;
            gap: 0;
        }

        .topbar-brand {
            display: flex;
            align-items: center;
            padding: 0 30px;
            text-decoration: none;
            height: 100%;
        }

        .topbar-brand h1 {
            color: var(--dark);
            margin: 0;
            font-family: 'Jost', sans-serif;
            font-weight: 700;
            font-size: 2.2rem;
        }

        /* Sidebar toggle button */
        .topbar-toggle {
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 16px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--dark);
            transition: .3s;
        }
        .topbar-toggle:hover { color: var(--primary); }

        /* Search bar */
        .topbar-search {
            display: flex;
            align-items: center;
            background: var(--light);
            border-radius: 50px;
            padding: 6px 16px;
            gap: 8px;
            min-width: 260px;
            margin: 0 10px;
        }
        .topbar-search input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 0.875rem;
            color: var(--dark);
            width: 100%;
            font-family: 'Open Sans', sans-serif;
        }
        .topbar-search input::placeholder { color: #a8c4aa; }
        .topbar-search i { color: var(--primary); font-size: 0.9rem; }

        .topbar-right {
            display: flex;
            align-items: center;
            height: 100%;
        }

        /* Icon action buttons (fullscreen, notif) */
        .topbar-icon-btn {
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 14px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--dark);
            font-size: 1.1rem;
            position: relative;
            transition: .3s;
            text-decoration: none;
        }
        .topbar-icon-btn:hover { color: var(--primary); }

        /* Notification badge */
        .notif-badge {
            position: absolute;
            top: 18px;
            right: 10px;
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            border: 2px solid #fff;
        }

        /* Notification dropdown */
        .notif-dropdown {
            width: 320px;
            padding: 0;
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .notif-header {
            background: var(--light);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #d4e9d5;
        }
        .notif-header span {
            font-family: 'Jost', sans-serif;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }
        .notif-header a {
            font-size: 0.75rem;
            color: var(--primary);
            text-decoration: none;
        }
        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 16px;
            border-bottom: 1px solid #f0f5f0;
            transition: .2s;
        }
        .notif-item:hover { background: var(--light); }
        .notif-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
            font-size: 0.85rem;
        }
        .notif-text p { margin: 0; font-size: 0.8rem; color: var(--dark); }
        .notif-text small { font-size: 0.72rem; color: var(--secondary); }
        .notif-footer {
            text-align: center;
            padding: 10px;
            background: #fafff9;
        }
        .notif-footer a {
            font-size: 0.8rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        .notif-footer a:hover { color: var(--dark); }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 16px;
            cursor: pointer;
            height: 100%;
        }

        .topbar-avatar {
            width: 40px;
            height: 40px;
            background: var(--light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .topbar-btn {
            background: var(--primary);
            color: var(--light);
            height: 100%;
            display: flex;
            align-items: center;
            padding: 0 30px;
            text-decoration: none;
            font-weight: 500;
            transition: .5s;
        }

        .topbar-btn:hover {
            background: var(--dark);
            color: var(--light);
        }

        /* SIDEBAR */
        .petugas-sidebar {
            position: fixed;
            top: 80px;
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - 80px);
            background: #ffffff;
            border-right: 1px solid #d4e9d5;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: .5s;
            overflow-y: auto;
            padding-top: 20px;
        }

        .nav-section-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #a8c4aa;
            padding: 16px 24px 4px;
            font-family: 'Open Sans', sans-serif;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 24px;
            color: var(--dark);
            font-size: 0.875rem;
            font-weight: 500;
            font-family: 'Open Sans', sans-serif;
            transition: .5s;
            text-decoration: none;
        }

        .sidebar-nav .nav-link i {
            width: 16px;
            text-align: center;
            color: #a8c4aa;
            transition: .5s;
        }

        .sidebar-nav .nav-link:hover, .sidebar-nav .nav-link.active {
            color: var(--primary);
            background: var(--light);
        }

        .sidebar-nav .nav-link:hover i, .sidebar-nav .nav-link.active i {
            color: var(--primary);
        }

        .sidebar-nav .nav-link.active {
            font-weight: 600;
            border-right: 3px solid var(--primary);
        }

        /* MAIN CONTENT */
        .petugas-main {
            margin-left: var(--sidebar-width);
            min-height: calc(100vh - 80px);
            display: flex;
            flex-direction: column;
        }

        .petugas-subnav {
            background: #ffffff;
            border-bottom: 1px solid #d4e9d5;
            padding: 0 30px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .subnav-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: var(--secondary);
        }

        .subnav-breadcrumb a { color: var(--secondary); text-decoration: none; }
        .subnav-breadcrumb .bc-sep { color: #c0d4c1; }
        .subnav-breadcrumb .bc-current {
            color: var(--primary);
            font-weight: 600;
        }

        .petugas-content {
            flex: 1;
            padding: 28px 30px;
        }

        @media (max-width: 991.98px) {
            .petugas-sidebar { transform: translateX(-100%); }
            .petugas-sidebar.show { transform: translateX(0); }
            .petugas-main { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- ==================== STRIP HIJAU TUA ==================== -->
    <div style="background-color: var(--dark); height: 35px; width: 100%;"></div>

    <!-- TOPBAR -->
    <header class="petugas-topbar">
        <div class="topbar-left">
            <button class="topbar-toggle" id="petugasSidebarToggle"
                onclick="document.getElementById('petugasSidebar').classList.toggle('show')">
                <i class="fas fa-bars fs-5"></i>
            </button>
            <a href="{{ route('petugas.dashboard') }}" class="topbar-brand">
                <h1>Berkah Sari</h1>
            </a>
            <!-- Search Bar -->
            <div class="topbar-search d-none d-md-flex">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari sesuatu..." id="petugasSearchInput">
            </div>
        </div>

        <div class="topbar-right">

            <button class="topbar-icon-btn d-none d-lg-flex" id="btnFullscreenPetugas" title="Layar Penuh"
                onclick="toggleFullscreenPetugas()">
                <i class="fas fa-expand" id="fullscreenIconPetugas"></i>
            </button>

            <!-- Notifikasi -->
            <div class="dropdown">
                <button class="topbar-icon-btn" id="btnNotifPetugas" data-bs-toggle="dropdown" title="Notifikasi">
                    <i class="fas fa-bell"></i>
                    <span class="notif-badge"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-end notif-dropdown" aria-labelledby="btnNotifPetugas">
                    <div class="notif-header">
                        <span>Notifikasi</span>
                        <a href="#">Tandai semua dibaca</a>
                    </div>
                    <div class="notif-item">
                        <div class="notif-icon"><i class="fas fa-clipboard-check"></i></div>
                        <div class="notif-text">
                            <p>Data berhasil disimpan</p>
                            <small>5 menit yang lalu</small>
                        </div>
                    </div>
                    <div class="notif-item">
                        <div class="notif-icon"><i class="fas fa-info-circle"></i></div>
                        <div class="notif-text">
                            <p>Pengingat input data harian</p>
                            <small>1 jam yang lalu</small>
                        </div>
                    </div>
                    <div class="notif-footer">
                        <a href="#">Lihat Semua Notifikasi</a>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="dropdown h-100">
                <div class="topbar-user h-100" data-bs-toggle="dropdown" id="petugasProfileDropdown">
                    <div class="text-end d-none d-md-block">
                        <div style="font-family:'Jost',sans-serif;font-weight:600;color:var(--dark);line-height:1.2;">Petugas</div>
                        <div style="font-size:0.75rem;color:var(--secondary);">Panel Input Data</div>
                    </div>
                    <div class="topbar-avatar">P</div>
                    <i class="fas fa-chevron-down text-muted" style="font-size:0.7rem;"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end mt-0" style="border:none;box-shadow:0 0 15px rgba(0,0,0,.08);">
                    <li><div class="px-4 py-2" style="font-size:0.7rem;font-weight:600;color:#a8c4aa;letter-spacing:1px;">SELAMAT DATANG!</div></li>
                    <li><a class="dropdown-item py-2" href="#"><i class="fas fa-user me-2 text-primary"></i>Profil Saya</a></li>
                    <li><a class="dropdown-item py-2" href="#"><i class="fas fa-lock me-2 text-primary"></i>Kunci Layar</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item py-2 text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a></li>
                </ul>
            </div>

            <a href="{{ route('home') }}" class="topbar-btn d-none d-lg-flex" target="_blank">
                Lihat Website <i class="fas fa-arrow-right ms-3"></i>
            </a>
        </div>
    </header>

    <!-- SIDEBAR -->
    <aside class="petugas-sidebar" id="petugasSidebar">
        <nav class="sidebar-nav">
            <div class="nav-section-label">Utama</div>
            <a href="{{ route('petugas.dashboard') }}" class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>

            <div class="nav-section-label">Input Data</div>
            <a href="#" class="nav-link {{ request()->routeIs('petugas.pesanan*') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i> Input Pesanan
            </a>
            <a href="#" class="nav-link {{ request()->routeIs('petugas.proyek*') ? 'active' : '' }}">
                <i class="fas fa-hard-hat"></i> Input Proyek
            </a>
            <a href="#" class="nav-link {{ request()->routeIs('petugas.klien*') ? 'active' : '' }}">
                <i class="fas fa-user-plus"></i> Input Klien
            </a>

            <div class="nav-section-label">Riwayat</div>
            <a href="#" class="nav-link {{ request()->routeIs('petugas.riwayat*') ? 'active' : '' }}">
                <i class="fas fa-history"></i> Riwayat Input
            </a>
            <a href="#" class="nav-link {{ request()->routeIs('petugas.laporan*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Laporan Saya
            </a>
        </nav>
    </aside>

    <!-- MAIN -->
    <div class="petugas-main">
        <div class="petugas-subnav">
            <nav class="subnav-breadcrumb">
                <a href="{{ route('petugas.dashboard') }}">Petugas</a>
                <span class="bc-sep">/</span>
                <span class="bc-current">@yield('page-title', 'Dashboard')</span>
            </nav>
            <div>
                @yield('subnav-actions')
            </div>
        </div>

        <main class="petugas-content">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fullscreen toggle
        function toggleFullscreenPetugas() {
            const icon = document.getElementById('fullscreenIconPetugas');
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
                icon.classList.replace('fa-expand', 'fa-compress');
            } else {
                document.exitFullscreen();
                icon.classList.replace('fa-compress', 'fa-expand');
            }
        }
    </script>

    @stack('scripts')
</body>

</html>
