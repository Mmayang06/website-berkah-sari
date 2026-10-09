@extends('layouts.pengurus')

@section('title', 'Dashboard Pengurus - Berkah Sari')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .stat-card {
        background: #fff;
        border-radius: 4px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 18px;
        box-shadow: 0 0 45px rgba(0,0,0,.08);
        transition: .5s;
        border-bottom: 3px solid var(--primary);
    }

    .stat-card:hover {
        box-shadow: 0 0 45px rgba(15,66,41,.15);
        transform: translateY(-4px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: var(--light);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--primary);
        flex-shrink: 0;
        transition: .5s;
    }

    .stat-card:hover .stat-icon {
        background: var(--primary);
        color: var(--light);
    }

    .stat-number {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        font-size: 1.75rem;
        color: var(--dark);
        line-height: 1;
    }

    .stat-label {
        color: var(--secondary);
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 5px;
    }

    .stat-change {
        font-size: 0.75rem;
        margin-top: 4px;
        color: #6c757d;
    }

    .stat-change .up   { color: var(--primary); font-weight: 600; }
    .stat-change .down { color: #dc3545; font-weight: 600; }

    .section-card {
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 0 45px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .section-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid var(--light);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
    }

    .section-card-title {
        font-family: 'Jost', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-card-title i {
        color: var(--primary);
    }

    .section-card-body {
        padding: 20px 24px;
    }

    .quick-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 22px 16px;
        background: var(--light);
        border-radius: 4px;
        text-decoration: none;
        color: var(--dark);
        font-size: 0.8rem;
        font-weight: 600;
        font-family: 'Jost', sans-serif;
        transition: .5s;
        text-align: center;
        box-shadow: 0 0 45px rgba(0,0,0,.08);
    }

    .quick-btn:hover {
        background: var(--primary);
        color: var(--light);
        transform: translateY(-3px);
    }

    .quick-btn i {
        font-size: 1.6rem;
        transition: .5s;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table thead th {
        background: var(--light);
        color: var(--dark);
        font-family: 'Jost', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 12px 16px;
        border: none;
    }

    .admin-table tbody td {
        padding: 13px 16px;
        border-bottom: 1px solid var(--light);
        color: var(--secondary);
        font-size: 0.875rem;
        vertical-align: middle;
    }

    .admin-table tbody tr:last-child td {
        border-bottom: none;
    }

    .admin-table tbody tr:hover td {
        background: #fafff8;
        color: var(--dark);
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 0.72rem;
        font-weight: 600;
        font-family: 'Jost', sans-serif;
        display: inline-block;
    }

    .badge-selesai  { background: var(--light); color: var(--dark); }
    .badge-berjalan { background: #cce5ff; color: #004085; }
    .badge-pending  { background: #fff3cd; color: #856404; }
    .badge-batal    { background: #f8d7da; color: #721c24; }

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 13px 0;
        border-bottom: 1px solid var(--light);
    }

    .activity-item:last-child { border-bottom: none; }

    .activity-dot {
        width: 38px;
        height: 38px;
        border-radius: 4px;
        background: var(--light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .activity-text {
        flex: 1;
        font-size: 0.83rem;
        color: var(--secondary);
        line-height: 1.5;
    }

    .activity-text strong { color: var(--dark); }

    .activity-time {
        font-size: 0.72rem;
        color: #aab4ab;
        white-space: nowrap;
    }

    .chart-ph {
        background: var(--light);
        border-radius: 4px;
        height: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--primary);
    }

    .chart-ph i {
        font-size: 2.5rem;
        margin-bottom: 10px;
        opacity: 0.5;
    }

    .chart-ph p {
        margin: 0;
        font-size: 0.83rem;
        color: var(--secondary);
    }

    .dash-page-header {
        background: var(--dark);
        border-radius: 4px;
        padding: 24px 28px;
        margin-bottom: 28px;
        box-shadow: 0 0 45px rgba(0,0,0,.08);
    }

    .dash-page-header h5 {
        color: var(--light);
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        margin: 0 0 4px;
    }

    .dash-page-header p {
        color: rgba(232,245,233,0.65);
        font-size: 0.875rem;
        margin: 0;
    }
</style>
@endpush

@section('subnav-actions')
    <div class="d-flex gap-2">
        <a href="#" class="btn btn-sm btn-primary py-1 px-3" style="font-family:'Jost',sans-serif;font-weight:600;font-size:0.8rem;">
            <i class="fas fa-plus me-1"></i> Tambah Data
        </a>
        <a href="#" class="btn btn-sm btn-outline-secondary py-1 px-3" style="font-size:0.8rem;">
            <i class="fas fa-download me-1"></i> Ekspor
        </a>
    </div>
@endsection

@section('content')

<div class="mb-4">
    <h5 style="font-family:'Jost',sans-serif;font-weight:700;color:var(--dark);margin:0 0 4px;">Selamat Datang, Admin! 👋</h5>
    <p style="color:var(--secondary);font-size:0.875rem;margin:0;">Ringkasan data Berkah Sari — {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
</div>
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-clipboard-list"></i></div>
            <div>
                <div class="stat-number">128</div>
                <div class="stat-label">Total Pesanan</div>
                <div class="stat-change"><span class="up">▲ 12%</span> dari bulan lalu</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-project-diagram"></i></div>
            <div>
                <div class="stat-number">45</div>
                <div class="stat-label">Proyek Aktif</div>
                <div class="stat-change"><span class="up">▲ 5%</span> dari bulan lalu</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div>
                <div class="stat-number">1.2K</div>
                <div class="stat-label">Total Klien</div>
                <div class="stat-change"><span class="up">▲ 8%</span> dari bulan lalu</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
            <div>
                <div class="stat-number">85Jt</div>
                <div class="stat-label">Pendapatan Bulan Ini</div>
                <div class="stat-change"><span class="down">▼ 3%</span> dari bulan lalu</div>
            </div>
        </div>
    </div>
</div>


<div class="row g-3 mb-4">
    <div class="col-12">
        <p class="text-uppercase fw-bold mb-2" style="font-size:0.72rem;letter-spacing:1px;color:var(--secondary);">Aksi Cepat</p>
    </div>
    <div class="col-6 col-md-3">
        <a href="#" class="quick-btn">
            <i class="fas fa-clipboard-list"></i> Tambah Pesanan
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="#" class="quick-btn">
            <i class="fas fa-hard-hat"></i> Buat Proyek
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="#" class="quick-btn">
            <i class="fas fa-user-plus"></i> Tambah Klien
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="#" class="quick-btn">
            <i class="fas fa-chart-bar"></i> Lihat Laporan
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="section-card">
            <div class="section-card-header">
                <h6 class="section-card-title">
                    <i class="fas fa-clipboard-list"></i> Pesanan Terbaru
                </h6>
                <a href="#" class="btn btn-sm btn-primary py-1 px-3" style="font-size:0.78rem;">Lihat Semua</a>
            </div>
            <div class="p-0">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No. Pesanan</th>
                            <th>Klien</th>
                            <th>Layanan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong style="color:var(--dark);">#PS-001</strong></td>
                            <td>Budi Santoso</td>
                            <td>Landscaping</td>
                            <td>29 Sep 2026</td>
                            <td><span class="status-badge badge-berjalan">Berjalan</span></td>
                        </tr>
                        <tr>
                            <td><strong style="color:var(--dark);">#PS-002</strong></td>
                            <td>Siti Rahayu</td>
                            <td>Pemangkasan</td>
                            <td>28 Sep 2026</td>
                            <td><span class="status-badge badge-selesai">Selesai</span></td>
                        </tr>
                        <tr>
                            <td><strong style="color:var(--dark);">#PS-003</strong></td>
                            <td>Ahmad Fauzi</td>
                            <td>Irigasi & Drainase</td>
                            <td>27 Sep 2026</td>
                            <td><span class="status-badge badge-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td><strong style="color:var(--dark);">#PS-004</strong></td>
                            <td>Dewi Lestari</td>
                            <td>Landscaping</td>
                            <td>26 Sep 2026</td>
                            <td><span class="status-badge badge-selesai">Selesai</span></td>
                        </tr>
                        <tr>
                            <td><strong style="color:var(--dark);">#PS-005</strong></td>
                            <td>Rudi Hartono</td>
                            <td>Garden Maintenance</td>
                            <td>25 Sep 2026</td>
                            <td><span class="status-badge badge-batal">Dibatalkan</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="section-card mb-4">
            <div class="section-card-header">
                <h6 class="section-card-title">
                    <i class="fas fa-chart-line"></i> Pendapatan Bulanan
                </h6>
            </div>
            <div class="section-card-body">
                <div class="chart-ph">
                    <i class="fas fa-chart-area"></i>
                    <p>Grafik akan tampil di sini</p>
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-card-header">
                <h6 class="section-card-title">
                    <i class="fas fa-history"></i> Aktivitas Terbaru
                </h6>
            </div>
            <div class="section-card-body p-3">
                <div class="activity-item">
                    <div class="activity-dot"><i class="fas fa-check"></i></div>
                    <div class="activity-text">
                        <strong>Proyek Landscaping</strong> Budi Santoso selesai.
                    </div>
                    <div class="activity-time">2j lalu</div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot"><i class="fas fa-user-plus"></i></div>
                    <div class="activity-text">
                        Klien baru <strong>Ahmad Fauzi</strong> mendaftar.
                    </div>
                    <div class="activity-time">4j lalu</div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot"><i class="fas fa-times"></i></div>
                    <div class="activity-text">
                        Pesanan <strong>#PS-005</strong> dibatalkan.
                    </div>
                    <div class="activity-time">1h lalu</div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot"><i class="fas fa-leaf"></i></div>
                    <div class="activity-text">
                        Layanan <strong>Urban Garden</strong> ditambahkan.
                    </div>
                    <div class="activity-time">2h lalu</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
