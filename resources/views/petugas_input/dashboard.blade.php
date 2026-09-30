@extends('layouts.petugas_input')

@section('title', 'Dashboard Petugas - Berkah Sari')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .welcome-banner {
        background: var(--dark);
        border-radius: 4px;
        padding: 26px 30px;
        margin-bottom: 28px;
        box-shadow: 0 0 45px rgba(0,0,0,.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .welcome-banner h5 {
        color: var(--light);
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        margin: 0 0 4px;
    }

    .welcome-banner p {
        color: rgba(232,245,233,0.65);
        font-size: 0.875rem;
        margin: 0;
    }

    .welcome-stats {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .welcome-stat {
        background: rgba(52,142,56,0.25);
        border-radius: 4px;
        padding: 10px 20px;
        text-align: center;
    }

    .welcome-stat .val {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: var(--primary);
        line-height: 1;
    }

    .welcome-stat .lbl {
        font-size: 0.72rem;
        color: rgba(232,245,233,0.6);
        margin-top: 3px;
    }

    .mini-stat {
        background: #fff;
        border-radius: 4px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 0 45px rgba(0,0,0,.08);
        transition: .5s;
        border-bottom: 3px solid var(--primary);
    }

    .mini-stat:hover {
        transform: translateY(-3px);
        box-shadow: 0 0 45px rgba(15,66,41,.15);
    }

    .mini-stat-icon {
        width: 52px;
        height: 52px;
        background: var(--light);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--primary);
        flex-shrink: 0;
        transition: .5s;
    }

    .mini-stat:hover .mini-stat-icon {
        background: var(--primary);
        color: var(--light);
    }

    .mini-stat-val {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--dark);
        line-height: 1;
    }

    .mini-stat-lbl {
        font-size: 0.8rem;
        color: var(--secondary);
        margin-top: 4px;
    }

    .form-card {
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 0 45px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .form-card-header {
        background: var(--dark);
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-card-header h6 {
        color: var(--light);
        font-family: 'Jost', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        margin: 0;
    }

    .form-card-header i {
        color: var(--primary);
    }

    .form-card-body {
        padding: 24px;
    }

    .form-label-sm {
        font-family: 'Jost', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 6px;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(52,142,56,0.15);
    }

    .section-card {
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 0 45px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .section-card-header {
        padding: 16px 24px;
        border-bottom: 1px solid var(--light);
        display: flex;
        align-items: center;
        justify-content: space-between;
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

    .input-table {
        width: 100%;
        border-collapse: collapse;
    }

    .input-table thead th {
        background: var(--light);
        color: var(--dark);
        font-family: 'Jost', sans-serif;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 11px 16px;
        border: none;
    }

    .input-table tbody td {
        padding: 12px 16px;
        border-bottom: 1px solid var(--light);
        color: var(--secondary);
        font-size: 0.85rem;
        vertical-align: middle;
    }

    .input-table tbody tr:last-child td { border-bottom: none; }

    .input-table tbody tr:hover td {
        background: #fafff8;
        color: var(--dark);
    }

    .status-badge {
        padding: 3px 10px;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 600;
        font-family: 'Jost', sans-serif;
        display: inline-block;
    }

    .badge-tersimpan { background: var(--light); color: var(--dark); }
    .badge-pesanan   { background: #cce5ff; color: #004085; }
    .badge-klien     { background: #fff3cd; color: #856404; }
    .badge-proyek    { background: #e2d9f3; color: #4a1f8e; }

    .action-btn {
        width: 30px;
        height: 30px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        text-decoration: none;
        transition: .5s;
        border: none;
        cursor: pointer;
    }

    .btn-edit   { background: var(--light); color: var(--primary); }
    .btn-delete { background: #f8d7da; color: #721c24; }
    .btn-edit:hover   { background: var(--primary); color: var(--light); }
    .btn-delete:hover { background: #721c24; color: #fff; }

    .target-card {
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 0 45px rgba(0,0,0,.08);
        padding: 20px 24px;
    }

    .target-title {
        font-family: 'Jost', sans-serif;
        font-weight: 600;
        color: var(--dark);
        font-size: 1rem;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .target-title i { color: var(--primary); }

    .progress {
        height: 8px;
        border-radius: 4px;
        background: var(--light);
    }

    .progress-bar {
        background: var(--primary);
        border-radius: 4px;
    }
</style>
@endpush

@section('subnav-actions')
    <a href="#" class="btn btn-sm btn-primary py-1 px-3" style="font-family:'Jost',sans-serif;font-weight:600;font-size:0.8rem;">
        <i class="fas fa-plus me-1"></i> Input Baru
    </a>
@endsection

@section('content')

<div class="welcome-banner">
    <div>
        <h5>Halo, Petugas! 👋</h5>
        <p>Semangat kerja hari ini, {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
    </div>
    <div class="welcome-stats">
        <div class="welcome-stat">
            <div class="val">12</div>
            <div class="lbl">Input Hari Ini</div>
        </div>
        <div class="welcome-stat">
            <div class="val">58</div>
            <div class="lbl">Minggu Ini</div>
        </div>
        <div class="welcome-stat">
            <div class="val">214</div>
            <div class="lbl">Bulan Ini</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-4">
        <div class="mini-stat">
            <div class="mini-stat-icon"><i class="fas fa-clipboard-check"></i></div>
            <div>
                <div class="mini-stat-val">12</div>
                <div class="mini-stat-lbl">Pesanan diinput hari ini</div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="mini-stat">
            <div class="mini-stat-icon"><i class="fas fa-hard-hat"></i></div>
            <div>
                <div class="mini-stat-val">4</div>
                <div class="mini-stat-lbl">Proyek diinput hari ini</div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="mini-stat">
            <div class="mini-stat-icon"><i class="fas fa-user-check"></i></div>
            <div>
                <div class="mini-stat-val">7</div>
                <div class="mini-stat-lbl">Klien baru diinput</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="form-card mb-4">
            <div class="form-card-header">
                <i class="fas fa-plus-circle"></i>
                <h6>Input Pesanan Baru</h6>
            </div>
            <div class="form-card-body">
                <form>
                    <div class="mb-3">
                        <div class="form-label-sm">Nama Klien</div>
                        <input type="text" class="form-control bg-light border-0" placeholder="Masukkan nama klien" id="input-nama-klien">
                    </div>
                    <div class="mb-3">
                        <div class="form-label-sm">No. HP</div>
                        <input type="text" class="form-control bg-light border-0" placeholder="08xx-xxxx-xxxx" id="input-nohp">
                    </div>
                    <div class="mb-3">
                        <div class="form-label-sm">Jenis Layanan</div>
                        <select class="form-control bg-light border-0" id="input-layanan">
                            <option value="">-- Pilih Layanan --</option>
                            <option>Landscaping</option>
                            <option>Pemangkasan Tanaman</option>
                            <option>Irigasi & Drainase</option>
                            <option>Garden Maintenance</option>
                            <option>Urban Gardening</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-label-sm">Alamat</div>
                        <textarea class="form-control bg-light border-0" rows="2" placeholder="Alamat pengerjaan" id="input-alamat"></textarea>
                    </div>
                    <div class="mb-4">
                        <div class="form-label-sm">Tanggal Pesanan</div>
                        <input type="date" class="form-control bg-light border-0" value="{{ now()->format('Y-m-d') }}" id="input-tanggal">
                    </div>
                    <button type="submit" class="btn btn-primary py-3 w-100" style="font-family:'Jost',sans-serif;font-weight:600;">
                        <i class="fas fa-save me-2"></i> Simpan Pesanan
                    </button>
                </form>
            </div>
        </div>

        <div class="target-card">
            <div class="target-title">
                <i class="fas fa-bullseye"></i> Target Bulan Ini
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-2">
                    <span style="font-size:0.83rem;color:var(--secondary);">Pesanan</span>
                    <span style="font-size:0.83rem;font-weight:600;color:var(--primary);">214 / 300</span>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width: 71%"></div>
                </div>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-2">
                    <span style="font-size:0.83rem;color:var(--secondary);">Klien Baru</span>
                    <span style="font-size:0.83rem;font-weight:600;color:var(--primary);">87 / 100</span>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width: 87%"></div>
                </div>
            </div>
            <div>
                <div class="d-flex justify-content-between mb-2">
                    <span style="font-size:0.83rem;color:var(--secondary);">Proyek Selesai</span>
                    <span style="font-size:0.83rem;font-weight:600;color:var(--primary);">32 / 50</span>
                </div>
                <div class="progress">
                    <div class="progress-bar" style="width: 64%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="section-card">
            <div class="section-card-header">
                <h6 class="section-card-title">
                    <i class="fas fa-history"></i> Riwayat Input Saya
                </h6>
                <a href="#" class="btn btn-sm btn-primary py-1 px-3" style="font-size:0.78rem;">Lihat Semua</a>
            </div>
            <div class="p-3">
                <div class="d-flex gap-2 mb-3">
                    <input type="text" class="form-control bg-light border-0" placeholder="Cari data..." style="font-size:0.83rem;" id="search-riwayat">
                    <select class="form-control bg-light border-0" style="font-size:0.83rem;width:auto;" id="filter-riwayat">
                        <option>Semua</option>
                        <option>Pesanan</option>
                        <option>Proyek</option>
                        <option>Klien</option>
                    </select>
                </div>
            </div>
            <div style="overflow-x:auto;">
                <table class="input-table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Jenis</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="white-space:nowrap;font-size:0.78rem;">29 Sep, 14:30</td>
                            <td><span class="status-badge badge-pesanan">Pesanan</span></td>
                            <td>Budi Santoso — Landscaping</td>
                            <td><span class="status-badge badge-tersimpan">Tersimpan</span></td>
                            <td>
                                <button class="action-btn btn-edit me-1"><i class="fas fa-edit"></i></button>
                                <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td style="white-space:nowrap;font-size:0.78rem;">29 Sep, 13:15</td>
                            <td><span class="status-badge badge-klien">Klien</span></td>
                            <td>Siti Rahayu — Klien Baru</td>
                            <td><span class="status-badge badge-tersimpan">Tersimpan</span></td>
                            <td>
                                <button class="action-btn btn-edit me-1"><i class="fas fa-edit"></i></button>
                                <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td style="white-space:nowrap;font-size:0.78rem;">29 Sep, 11:00</td>
                            <td><span class="status-badge badge-proyek">Proyek</span></td>
                            <td>Ahmad Fauzi — Taman Belakang</td>
                            <td><span class="status-badge badge-tersimpan">Tersimpan</span></td>
                            <td>
                                <button class="action-btn btn-edit me-1"><i class="fas fa-edit"></i></button>
                                <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td style="white-space:nowrap;font-size:0.78rem;">28 Sep, 16:45</td>
                            <td><span class="status-badge badge-pesanan">Pesanan</span></td>
                            <td>Dewi Lestari — Pemangkasan</td>
                            <td><span class="status-badge badge-tersimpan">Tersimpan</span></td>
                            <td>
                                <button class="action-btn btn-edit me-1"><i class="fas fa-edit"></i></button>
                                <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td style="white-space:nowrap;font-size:0.78rem;">28 Sep, 14:20</td>
                            <td><span class="status-badge badge-klien">Klien</span></td>
                            <td>Rudi Hartono — Klien Baru</td>
                            <td><span class="status-badge badge-tersimpan">Tersimpan</span></td>
                            <td>
                                <button class="action-btn btn-edit me-1"><i class="fas fa-edit"></i></button>
                                <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td style="white-space:nowrap;font-size:0.78rem;">28 Sep, 10:00</td>
                            <td><span class="status-badge badge-proyek">Proyek</span></td>
                            <td>Maya Putri — Taman Depan</td>
                            <td><span class="status-badge badge-tersimpan">Tersimpan</span></td>
                            <td>
                                <button class="action-btn btn-edit me-1"><i class="fas fa-edit"></i></button>
                                <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center px-4 py-3" style="border-top:1px solid var(--light);">
                <span style="font-size:0.78rem;color:var(--secondary);">Menampilkan 6 dari 214 data</span>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                        <li class="page-item active"><a class="page-link" href="#" style="background:var(--primary);border-color:var(--primary);">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">›</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection
