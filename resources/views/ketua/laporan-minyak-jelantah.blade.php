@extends('layouts.ketua')

@section('title', 'Laporan Minyak Jelantah - Berkah Sari')
@section('page-title', 'Laporan Minyak Jelantah')


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
