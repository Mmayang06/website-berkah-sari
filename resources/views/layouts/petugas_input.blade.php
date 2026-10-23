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
            font-size: 1.5rem;
            white-space: nowrap;
        }

        /* Switch module button */
        .btn-switch-module {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: var(--light);
            color: var(--dark);
            border: 1.5px solid #c8e6c9;
            border-radius: 50px;
            padding: 7px 18px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 0 10px;
        }
        .btn-switch-module i.icon-module {
            color: var(--primary);
            font-size: 1rem;
        }
        .btn-switch-module:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 4px 14px rgba(52, 142, 56, 0.25);
            transform: translateY(-1px);
        }
        .btn-switch-module:hover i {
            color: #ffffff !important;
        }

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
            background: var(--primary);
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
            margin-left: 0;
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
            <a href="{{ route('petugas.pilih') }}" class="topbar-brand" title="Pilih Menu Input">
                <h1>@yield('brand_title', 'Berkah Sari')</h1>
            </a>
            @yield('topbar_action')
        </div>

        <div class="topbar-right">



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

            <!-- Akun (kotak hijau) — profil dipindahkan ke dalam -->
            <div class="dropdown h-100">
                <div class="topbar-btn d-none d-lg-flex h-100" data-bs-toggle="dropdown" id="petugasProfileDropdown"
                    style="gap:12px;cursor:pointer;">
                    <div class="text-end">
                        <div style="font-family:'Jost',sans-serif;font-weight:700;font-size:0.95rem;line-height:1.2;color:#fff;">Petugas</div>
                        <div style="font-size:0.72rem;color:rgba(255,255,255,0.8);">Petugas Input</div>
                    </div>
                    <div class="topbar-avatar" style="background:#fff;color:var(--primary);font-weight:700;">P</div>
                    <i class="fas fa-chevron-down" style="font-size:0.7rem;color:rgba(255,255,255,0.8);"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end mt-0" style="border:none;box-shadow:0 0 15px rgba(0,0,0,.08);">
                    <li><div class="px-4 py-2" style="font-size:0.7rem;font-weight:600;color:#a8c4aa;letter-spacing:1px;">SELAMAT DATANG!</div></li>
                    <li><a class="dropdown-item py-2" href="{{ route('petugas.pilih') }}"><i class="fas fa-th-large me-2 text-primary"></i>Pilih Menu Input</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('portal.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger"><i class="fas fa-sign-out-alt me-2"></i>Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- MAIN -->
    <div class="petugas-main">


        <main class="petugas-content">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>



    @stack('scripts')
</body>

</html>
