@extends('layouts.pengurus')

@section('title', 'Laporan Minyak Jelantah - Berkah Sari')
@section('page-title', 'Laporan Minyak Jelantah')

@push('styles')
<style>
    :root { --radius-lg: 10px; --radius-xl: 14px; }

    .filter-card {
        background: #fff;
        border-radius: var(--radius-xl);
        border: 1px solid rgba(15,66,41,.06);
        box-shadow: 0 2px 8px rgba(15,66,41,.03);
        padding: 20px 24px;
        margin-bottom: 20px;
    }
    .filter-card-title {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        font-size: .9rem;
        color: var(--dark);
        margin: 0 0 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .filter-card-title i { color: var(--primary); }

    .form-label-custom { display: inline-block; font-size: .82rem; font-weight: 700; color: var(--dark); margin-bottom: .45rem; }
    .form-control-custom {
        display: block; width: 100%; padding: .55rem 1rem;
        font-size: .875rem; font-weight: 500; line-height: 1.5;
        color: var(--dark); background: #fff;
        border: 1px solid rgba(15,66,41,.12); border-radius: var(--radius-lg);
        transition: border-color .2s, box-shadow .2s; font-family: 'Open Sans', sans-serif;
    }
    .form-control-custom:focus { border-color: var(--primary); outline: 0; box-shadow: 0 0 0 3px rgba(52,142,56,.09); }
    .form-select-custom {
        display: block; width: 100%; padding: .55rem 2.25rem .55rem 1rem;
        font-size: .875rem; font-weight: 500; line-height: 1.5;
        color: var(--dark); background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%230F4229' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") no-repeat right 1rem center / 12px 10px;
        border: 1px solid rgba(15,66,41,.12); border-radius: var(--radius-lg);
        transition: border-color .2s, box-shadow .2s; appearance: none; font-family: 'Open Sans', sans-serif;
    }
    .form-select-custom:focus { border-color: var(--primary); outline: 0; box-shadow: 0 0 0 3px rgba(52,142,56,.09); }
    .btn-filter-custom {
        background: var(--primary); color: #fff; border: none; border-radius: var(--radius-lg);
        padding: .55rem 1.25rem; font-weight: 700; font-size: .875rem; font-family: 'Jost', sans-serif;
        cursor: pointer; display: inline-flex; align-items: center; gap: .4rem; transition: all .2s;
    }
    .btn-filter-custom:hover { background: var(--dark); }
    .btn-reset-custom {
        background: #fff; color: var(--dark); border: 1px solid rgba(15,66,41,.15);
        border-radius: var(--radius-lg); padding: .55rem 1rem; font-weight: 600;
        font-size: .875rem; font-family: 'Open Sans', sans-serif; cursor: pointer; transition: all .2s;
    }
    .btn-reset-custom:hover { background: #f5f8f5; }
    
    .summary-label { font-size: .72rem; color: #6C7E75; font-weight: 600; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 6px; }
    .summary-value { font-family: 'Jost', sans-serif; font-weight: 800; font-size: 1.6rem; color: var(--dark); line-height: 1; }
    .summary-unit { font-size: .85rem; font-weight: 500; color: #6C7E75; }

    .table-card-custom {
        background: #fff; border-radius: var(--radius-xl);
        border: 1px solid rgba(15,66,41,.06); box-shadow: 0 2px 8px rgba(15,66,41,.03); overflow: hidden;
    }
    .table-header-control {
        background: #fff; padding: 1.25rem; border-bottom: 1px solid rgba(15,66,41,.06);
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
    }
    .tbl-title { font-family: 'Jost', sans-serif; font-weight: 700; font-size: .95rem; color: var(--dark); margin: 0; display: flex; align-items: center; gap: 8px; }
    .tbl-title i { color: #3B82F6; }
    .table-search-box { position: relative; max-width: 280px; flex-grow: 1; }
    .table-search-input {
        width: 100%; padding: .48rem 1rem .48rem 2.25rem; font-size: .85rem;
        border-radius: var(--radius-lg); border: 1px solid rgba(15,66,41,.1);
        background: #FDFDFD; transition: all .2s; font-family: 'Open Sans', sans-serif;
    }
    .table-search-input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(52,142,56,.08); }
    .table-search-icon { position: absolute; left: .75rem; top: 50%; transform: translateY(-50%); color: #6C7E75; font-size: .85rem; }
    .btn-table-action {
        background: #fff; border: 1px solid rgba(15,66,41,.1); color: var(--dark);
        font-size: .85rem; font-weight: 600; padding: .48rem 1rem; border-radius: var(--radius-lg);
        display: inline-flex; align-items: center; gap: .35rem; transition: all .2s; cursor: pointer;
    }
    .btn-table-action:hover { background: #F8FAF9; border-color: var(--primary); }
    .table-custom { width: 100%; border-collapse: collapse; vertical-align: middle; }
    .table-custom th, .table-custom td { padding: .9rem 1.25rem; border-bottom: 1px solid rgba(15,66,41,.05); }
    .table-custom th {
        background: #F8FAF9; color: #6C7E75; font-size: .72rem;
        text-transform: uppercase; font-weight: 700; letter-spacing: .05em;
        border-bottom: 1px solid rgba(15,66,41,.08); white-space: nowrap;
    }
    .table-custom tbody tr { transition: background .2s; }
    .table-custom tbody tr:hover { background: rgba(52,142,56,.025); }
    .table-custom tbody tr:last-child td { border-bottom: none; }
    .badge-table {
        display: inline-flex; align-items: center; gap: .35rem;
        padding: .25rem .65rem; font-size: .72rem; font-weight: 700; border-radius: 50rem;
    }
    .badge-table::before { content: ''; display: inline-block; width: 6px; height: 6px; border-radius: 50rem; }
    .badge-table.success { background: rgba(34,197,94,.1); color: #22C55E; }
    .badge-table.success::before { background: #22C55E; }
    .badge-table.info { background: rgba(59,130,246,.1); color: #3B82F6; }
    .badge-table.info::before { background: #3B82F6; }
    .table-amount { font-weight: 700; color: var(--dark); font-family: 'Jost', sans-serif; }
    .table-footer-control {
        background: #fff; padding: 1rem 1.25rem; border-top: 1px solid rgba(15,66,41,.06);
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
    }
    .table-pagination-info { font-size: .83rem; color: #6C7E75; }
    .empty-ph { padding: 48px; text-align: center; color: #9CA3AF; font-size: .85rem; }
    @media (max-width: 640px) { .summary-row { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')

<div style="margin-bottom: 20px;">
    <h4 style="font-family:'Jost',sans-serif; font-weight:700; color:var(--dark); margin:0 0 4px; font-size:1.2rem;">
        Laporan Minyak Jelantah
    </h4>
    <p style="color:#6C7E75; font-size:.85rem; margin:0;">
        Data rekap setoran minyak jelantah dari seluruh donatur.
    </p>
</div>

<div class="filter-card">
    <p class="filter-card-title"><i class="fas fa-filter"></i> Filter Laporan</p>
    <form method="GET" action="{{ route('pengurus.laporan-minyak-jelantah') }}">
        <div class="row g-3 align-items-end">
            <div class="col-sm-4 col-md-3">
                <label class="form-label-custom" for="filter-bulan">Bulan</label>
                <select class="form-select-custom" name="bulan" id="filter-bulan">
                    <option value="">Semua Bulan</option>
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 col-md-3">
                <label class="form-label-custom" for="filter-tahun">Tahun</label>
                <select class="form-select-custom" name="tahun" id="filter-tahun">
                    @foreach(range(now()->year, now()->year - 3) as $y)
                        <option value="{{ $y }}" {{ request('tahun', now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 col-md-3">
                <label class="form-label-custom" for="filter-lingkungan">Lingkungan</label>
                <input type="text" class="form-control-custom" name="lingkungan" id="filter-lingkungan"
                    placeholder="Nama lingkungan..." value="{{ request('lingkungan') }}">
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-filter-custom flex-grow-1">
                        <i class="fas fa-search"></i> Tampilkan
                    </button>
                    <a href="{{ route('pengurus.laporan-minyak-jelantah') }}" class="btn-reset-custom">Reset</a>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="table-card-custom">
    <div class="table-header-control">
        <h6 class="tbl-title"><i class="fas fa-tint"></i> Data Setoran Minyak Jelantah</h6>
        <div class="d-flex gap-2 flex-wrap">
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" class="table-search-input" placeholder="Cari data..." id="searchTbl">
            </div>
            <button class="btn-table-action" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak
            </button>
            <button class="btn-table-action">
                <i class="fas fa-file-excel"></i> Export
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-custom" id="tblLaporan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Donatur</th>
                    <th>Lingkungan</th>
                    <th>Volume (L)</th>
                    <th>Harga/Liter</th>
                    <th>Total Nilai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="8" class="empty-ph">
                        <i class="fas fa-inbox d-block mb-2" style="font-size:1.8rem;opacity:.2;color:#3B82F6"></i>
                        Belum ada data untuk filter yang dipilih.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-footer-control">
        <span class="table-pagination-info">Menampilkan 0 data</span>
        <div></div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('searchTbl').addEventListener('keyup', function() {
        var val = this.value.toLowerCase();
        document.querySelectorAll('#tblLaporan tbody tr').forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endpush
