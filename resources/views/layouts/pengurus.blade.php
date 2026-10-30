<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin Panel - Berkah Sari')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="@yield('description', 'Panel Admin Berkah Sari')" name="description">

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
        .admin-topbar {
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
            background: var(--primary);
            color: var(--light);
        }

        /* SIDEBAR */
        .admin-sidebar {
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
        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: calc(100vh - 80px);
            display: flex;
            flex-direction: column;
        }

        .admin-subnav {
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

        .subnav-breadcrumb .bc-sep { color: #c0d4c1; }
        .subnav-breadcrumb .bc-current {
            color: var(--primary);
            font-weight: 600;
        }

        .admin-content {
            flex: 1;
            padding: 28px 30px;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.show { transform: translateX(0); }
            .admin-main { margin-left: 0; }
        }

        /* ─── SHARED UI COMPONENTS ─── */
        :root {
            --radius-sm: 8px;
            --radius-md: 10px;
            --radius-lg: 12px;
            --radius-xl: 14px;
        }

        /* Modal */
        .modal { z-index: 1060 !important; }
        .modal-backdrop { z-index: 1055 !important; }
        .modal-card-custom {
            background: #ffffff;
            border: 1px solid rgba(15, 66, 41, 0.1);
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.18);
            padding: 1.75rem;
        }
        .modal-header-custom {
            background: #FFFFFF;
            border-bottom: 1px solid rgba(15, 66, 41, 0.08);
            padding: 1.25rem 1.5rem;
        }
        .modal-title-custom {
            font-family: 'Jost', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .modal-body-custom {
            padding: 1.5rem;
            background: #F8FAF9;
        }
        .modal-footer-custom {
            background: #FFFFFF;
            border-top: 1px solid rgba(15, 66, 41, 0.08);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* Form Controls */
        .form-label-custom {
            display: inline-block;
            font-size: .85rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: .45rem;
            font-family: 'Open Sans', sans-serif;
        }
        .form-control-custom {
            display: block;
            width: 100%;
            padding: .55rem 1rem;
            font-size: .875rem;
            font-weight: 500;
            line-height: 1.5;
            color: var(--dark);
            background-color: #fff;
            border: 1px solid rgba(15, 66, 41, 0.12);
            border-radius: 8px;
            transition: border-color .2s, box-shadow .2s;
            font-family: 'Open Sans', sans-serif;
        }
        .form-control-custom:focus {
            border-color: var(--primary);
            outline: 0;
            box-shadow: 0 0 0 3px rgba(52, 142, 56, 0.09);
        }
        .form-control-custom::placeholder {
            color: #8c9b93;
            opacity: 0.8;
        }
        .form-control-custom[readonly], .form-control-custom:disabled {
            background-color: #f8faf9;
            border-color: rgba(15, 66, 41, 0.06);
            color: #6C7E75;
            cursor: not-allowed;
        }
        .form-select-custom {
            display: block;
            width: 100%;
            padding: .55rem 2.25rem .55rem 1rem;
            font-size: .875rem;
            font-weight: 500;
            line-height: 1.5;
            color: var(--dark);
            background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%230F4229' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") no-repeat right 1rem center / 12px 10px;
            border: 1px solid rgba(15, 66, 41, 0.12);
            border-radius: 8px;
            transition: border-color .2s, box-shadow .2s;
            appearance: none;
            font-family: 'Open Sans', sans-serif;
        }
        .form-select-custom:focus {
            border-color: var(--primary);
            outline: 0;
            box-shadow: 0 0 0 3px rgba(52, 142, 56, 0.09);
        }

        /* Buttons */
        .btn-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.55rem 1.25rem;
            border-radius: 8px;
            border: 1px solid transparent;
            transition: all 0.2s;
            cursor: pointer;
            text-decoration: none;
            line-height: 1.5;
            font-family: 'Jost', sans-serif;
        }
        .btn-custom:active { transform: scale(0.98); }
        .btn-custom-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #fff !important;
        }
        .btn-custom-primary:hover {
            background-color: var(--dark) !important;
            border-color: var(--dark) !important;
            color: #fff !important;
        }
        .btn-custom-light {
            background-color: #fff;
            border: 1px solid rgba(15, 66, 41, 0.15);
            color: #6C7E75;
        }
        .btn-custom-light:hover {
            background-color: #F8FAF9;
            color: var(--dark);
            border-color: rgba(15, 66, 41, 0.25);
        }
        .btn-add-primary, .btn-action-custom {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: .48rem 1rem;
            font-weight: 700;
            font-size: .85rem;
            font-family: 'Jost', sans-serif;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            transition: all .2s;
            text-decoration: none;
        }
        .btn-add-primary:hover, .btn-action-custom:hover {
            background: var(--dark);
            color: #fff;
        }

        /* Page Headers & Katalog */
        .katalog-header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        .katalog-title {
            font-family: 'Jost', sans-serif;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
            font-size: 1.25rem;
        }
        .katalog-sub {
            color: #6C7E75;
            font-size: .85rem;
            margin: 2px 0 0;
        }

        /* Filter Card */
        .filter-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid rgba(15, 66, 41, .06);
            box-shadow: 0 2px 8px rgba(15, 66, 41, .03);
            padding: 20px 24px;
            margin-bottom: 20px;
        }
        .filter-card-title {
            font-family: 'Jost', sans-serif;
            font-weight: 700;
            font-size: .92rem;
            color: var(--dark);
            margin: 0 0 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .filter-card-title i { color: var(--primary); }
        .btn-filter-custom {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: .55rem 1.25rem;
            font-weight: 700;
            font-size: .875rem;
            font-family: 'Jost', sans-serif;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .4rem;
            transition: all .2s;
            white-space: nowrap;
        }
        .btn-filter-custom:hover {
            background: var(--dark);
            color: #fff;
        }
        .btn-reset-custom {
            background: #fff;
            color: var(--dark);
            border: 1px solid rgba(15, 66, 41, .15);
            border-radius: 8px;
            padding: .55rem 1rem;
            font-weight: 600;
            font-size: .875rem;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Open Sans', sans-serif;
            white-space: nowrap;
        }
        .btn-reset-custom:hover {
            background: #f5f8f5;
            color: var(--dark);
        }

        /* Summary Cards */
        .summary-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid rgba(15, 66, 41, .06);
            box-shadow: 0 2px 8px rgba(15, 66, 41, .03);
            padding: 18px 20px;
        }
        .summary-label {
            font-size: .72rem;
            color: #6C7E75;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 6px;
        }
        .summary-value {
            font-family: 'Jost', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--dark);
            line-height: 1;
        }
        .summary-unit {
            font-size: .85rem;
            font-weight: 500;
            color: #6C7E75;
        }

        /* Tables */
        .table-card-custom {
            background: #fff;
            border-radius: 14px;
            border: 1px solid rgba(15, 66, 41, .06);
            box-shadow: 0 2px 8px rgba(15, 66, 41, .03);
            overflow: hidden;
        }
        .table-header-control {
            background: #fff;
            padding: 1.25rem;
            border-bottom: 1px solid rgba(15, 66, 41, .06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .tbl-title {
            font-family: 'Jost', sans-serif;
            font-weight: 700;
            font-size: .95rem;
            color: var(--dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .tbl-title i { color: var(--primary); }
        .table-search-box {
            position: relative;
            max-width: 280px;
            flex-grow: 1;
        }
        .table-search-input {
            width: 100%;
            padding: .48rem 1rem .48rem 2.25rem;
            font-size: .85rem;
            border-radius: 8px;
            border: 1px solid rgba(15, 66, 41, .1);
            background: #FDFDFD;
            transition: all .2s;
            font-family: 'Open Sans', sans-serif;
        }
        .table-search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 142, 56, .08);
        }
        .table-search-icon {
            position: absolute;
            left: .75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6C7E75;
            font-size: .85rem;
        }
        .btn-table-action {
            background: #fff;
            border: 1px solid rgba(15, 66, 41, .1);
            color: var(--dark);
            font-size: .85rem;
            font-weight: 600;
            padding: .48rem 1rem;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            transition: all .2s;
            cursor: pointer;
            text-decoration: none;
        }
        
        .table-amount {
            font-weight: 700;
            color: var(--dark);
            font-family: 'Jost', sans-serif;
        }
        .table-btn-action {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid rgba(15, 66, 41, 0.12);
            background-color: #fff;
            color: var(--dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all .2s;
            cursor: pointer;
        }
        .table-btn-action:hover {
            background-color: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .btn-table-action:hover {
            background: #F8FAF9;
            border-color: var(--primary);
        }
        .table-custom {
            width: 100%;
            border-collapse: collapse;
            vertical-align: middle;
        }
        .table-custom th, .table-custom td {
            padding: .9rem 1.25rem;
            border-bottom: 1px solid rgba(15, 66, 41, .05);
        }
        .table-custom th {
            background: #F8FAF9;
            color: #6C7E75;
            font-size: .72rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: .05em;
            border-bottom: 1px solid rgba(15, 66, 41, .08);
            white-space: nowrap;
        }
        .table-custom tbody tr { transition: background .2s; }
        .table-custom tbody tr:hover { background: rgba(52, 142, 56, .025); }
        .table-custom tbody tr:last-child td { border-bottom: none; }
        .table-footer-control {
            background: #fff;
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(15, 66, 41, .06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .table-pagination-info {
            font-size: .83rem;
            color: #6C7E75;
            font-family: 'Open Sans', sans-serif;
        }
        .empty-ph {
            padding: 48px;
            text-align: center;
            color: #6C7E75;
            font-size: .875rem;
            font-family: 'Open Sans', sans-serif;
        }

        /* Badges */
        .badge-table {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .25rem .65rem;
            font-size: .72rem;
            font-weight: 700;
            border-radius: 50rem;
        }
        .badge-table::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }
        .badge-table.success { background: rgba(34, 197, 94, .1); color: #22C55E; }
        .badge-table.success::before { background: #22C55E; }
        .badge-table.pending { background: rgba(249, 115, 22, .1); color: #F97316; }
        .badge-table.pending::before { background: #F97316; }
        .badge-table.purple { background: rgba(139, 92, 246, .1); color: #8B5CF6; }
        .badge-table.purple::before { background: #8B5CF6; }

    </style>

    @stack('styles')
</head>

<body>

    <div style="background-color: var(--dark); height: 35px; width: 100%;"></div>

    <header class="admin-topbar">
        <div class="topbar-left">
            <button class="topbar-toggle" id="adminSidebarToggle"
                onclick="document.getElementById('adminSidebar').classList.toggle('show')">
                <i class="fas fa-bars fs-5"></i>
            </button>
            <a href="{{ route('pengurus.dashboard') }}" class="topbar-brand">
                <h1>Berkah Sari</h1>
            </a>
        </div>

        <div class="topbar-right">
            <div class="dropdown">
                <button class="topbar-icon-btn" id="btnNotifications" data-bs-toggle="dropdown" title="Notifikasi">
                    <i class="fas fa-bell"></i>
                    <span class="notif-badge"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-end notif-dropdown" aria-labelledby="btnNotifications">
                    <div class="notif-header">
                        <span>Notifikasi</span>
                        <a href="#">Tandai semua dibaca</a>
                    </div>
                    <div class="notif-item">
                        <div class="notif-icon"><i class="fas fa-file-invoice"></i></div>
                        <div class="notif-text">
                            <p>Pesanan baru masuk</p>
                            <small>2 menit yang lalu</small>
                        </div>
                    </div>
                    <div class="notif-item">
                        <div class="notif-icon"><i class="fas fa-user-plus"></i></div>
                        <div class="notif-text">
                            <p>Pengguna baru terdaftar</p>
                            <small>1 jam yang lalu</small>
                        </div>
                    </div>
                    <div class="notif-item">
                        <div class="notif-icon"><i class="fas fa-exclamation-circle"></i></div>
                        <div class="notif-text">
                            <p>Laporan mingguan tersedia</p>
                            <small>3 jam yang lalu</small>
                        </div>
                    </div>
                    <div class="notif-footer">
                        <a href="#">Lihat Semua Notifikasi</a>
                    </div>
                </div>
            </div>

            <div class="dropdown h-100">
                <div class="topbar-btn d-none d-lg-flex h-100" data-bs-toggle="dropdown" id="profileDropdown"
                    style="gap:12px;cursor:pointer;">
                    <div class="text-end">
                        <div style="font-family:'Jost',sans-serif;font-weight:700;font-size:0.95rem;line-height:1.2;color:#fff;">Pengurus</div>
                        <div style="font-size:0.72rem;color:rgba(255,255,255,0.8);">Pengurus</div>
                    </div>
                    <div class="topbar-avatar" style="background:#fff;color:var(--primary);font-weight:700;">P</div>
                    <i class="fas fa-chevron-down" style="font-size:0.7rem;color:rgba(255,255,255,0.8);"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end mt-0" style="border:none;box-shadow:0 0 15px rgba(0,0,0,.08);">
                    <li><div class="px-4 py-2" style="font-size:0.7rem;font-weight:600;color:#a8c4aa;letter-spacing:1px;">SELAMAT DATANG!</div></li>
                    <li><a class="dropdown-item py-2" href="{{ route('pengurus.akun-saya') }}"><i class="fas fa-user me-2 text-primary"></i>Akun Saya</a></li>
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

    <aside class="admin-sidebar" id="adminSidebar">
        <nav class="sidebar-nav">
            <div class="nav-section-label">Utama</div>
            <a href="{{ route('pengurus.dashboard') }}" class="nav-link {{ request()->routeIs('pengurus.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <div class="nav-section-label">Manajemen</div>
            <a href="{{ route('pengurus.pengepul') }}" class="nav-link {{ request()->routeIs('pengurus.pengepul*', 'pengurus.katalog*') ? 'active' : '' }}">
                <i class="fas fa-truck"></i>Bank Sampah Induk
            </a>
            <a href="{{ route('pengurus.kategori-sampah') }}" class="nav-link {{ request()->routeIs('pengurus.kategori-sampah*', 'pengurus.daftar-kategori*') ? 'active' : '' }}">
                <i class="fas fa-recycle"></i> Kategori Sampah
            </a>

            <div class="nav-section-label">Laporan</div>
            <a href="{{ route('pengurus.laporan-bank-sampah') }}" class="nav-link {{ request()->routeIs('pengurus.laporan-bank-sampah') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i> Laporan Bank Sampah
            </a>
            <a href="{{ route('pengurus.laporan-minyak-jelantah') }}" class="nav-link {{ request()->routeIs('pengurus.laporan-minyak-jelantah') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i> Laporan Minyak Jelantah
            </a>
            <a href="{{ route('pengurus.laporan-operasional') }}" class="nav-link {{ request()->routeIs('pengurus.laporan-operasional') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i> Laporan Operasional
            </a>
        </nav>
    </aside>

    <div class="admin-main">


        <main class="admin-content">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>



    @stack('scripts')
</body>

</html>
