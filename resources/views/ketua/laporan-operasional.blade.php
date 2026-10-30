@extends('layouts.ketua')

@section('title', 'Laporan Operasional - Berkah Sari')
@section('page-title', 'Laporan Operasional')


@section('content')

<div style="margin-bottom: 20px;">
    <h4 style="font-family:'Jost',sans-serif; font-weight:700; color:var(--dark); margin:0 0 4px; font-size:1.2rem;">
        Laporan Operasional
    </h4>
    <p style="color:#6C7E75; font-size:.85rem; margin:0;">
        Rekap pendapatan kotor, biaya operasional, dan uang bersih yang diterima.
    </p>
</div>

<div class="filter-card">
    <p class="filter-card-title"><i class="fas fa-filter"></i> Filter Laporan</p>
    <form method="GET" action="{{ route('pengurus.laporan-operasional') }}">
        <div class="row g-3">
            <div class="col-sm-6 col-md-3">
                <label class="form-label-custom" for="filter-bulan">Bulan</label>
                <select class="form-select-custom" name="bulan" id="filter-bulan" onchange="this.form.submit()">
                    <option value="">Semua Bulan</option>
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="form-label-custom" for="filter-tahun">Tahun</label>
                <select class="form-select-custom" name="tahun" id="filter-tahun" onchange="this.form.submit()">
                    @foreach(range(now()->year, now()->year - 3) as $y)
                        <option value="{{ $y }}" {{ request('tahun', now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="table-card-custom">
    <div class="table-header-control">
        <h6 class="tbl-title"><i class="fas fa-cogs"></i> Rekap Operasional</h6>
        <div class="d-flex gap-2 flex-wrap">
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" class="table-search-input" placeholder="Cari data..." id="searchTbl">
            </div>
            <button type="button" class="btn-add-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengeluaran" id="btnTambahPengeluaran">
                <i class="fas fa-plus"></i> Tambah Pengeluaran
            </button>
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
                    <th>Periode</th>
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Pendapatan Kotor</th>
                    <th>Biaya Ops (10%)</th>
                    <th>Uang Bersih</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="8" class="empty-ph">
                        <i class="fas fa-inbox d-block mb-2" style="font-size:1.8rem;opacity:.2;color:#8B5CF6"></i>
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

<div class="modal fade" id="modalTambahPengeluaran" tabindex="-1" aria-labelledby="modalTambahPengeluaranLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 580px;">
        <div class="modal-content modal-card-custom">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h5 class="card-title mb-0 d-flex align-items-center gap-2" id="modalTambahPengeluaranLabel" style="font-family: 'Jost', sans-serif; font-size: 1.15rem; color: var(--dark); font-weight: 700;">
                    <i class="bi bi-wallet2 text-primary fs-5"></i>
                    <span>Tambah Pengeluaran</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formTambahPengeluaran" method="POST" action="{{ route('pengurus.laporan-operasional.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="tanggal_keluar" class="form-label-custom">Tanggal Pengeluaran <span class="text-danger">*</span></label>
                    <input type="date" class="form-control-custom" id="tanggal_keluar" name="tanggal_keluar" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label for="biaya_keluar" class="form-label-custom">Biaya Keluar (Rp) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius: 8px 0 0 8px; border-color: rgba(15, 66, 41, 0.15); background-color: #f8faf9; font-weight: 600; color: var(--dark);">Rp</span>
                        <input type="number" class="form-control-custom" id="biaya_keluar" name="biaya_keluar" placeholder="Contoh: 50000" min="0" step="100" required style="border-radius: 0 8px 8px 0;">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label-custom">Keterangan <span class="text-danger">*</span></label>
                    <textarea class="form-control-custom" id="keterangan" name="keterangan" rows="3" placeholder="Tuliskan keterangan pengeluaran operasional..." required></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-custom btn-custom-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
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

    document.addEventListener('DOMContentLoaded', function () {
        var btnTambah = document.getElementById('btnTambahPengeluaran');
        var modalEl = document.getElementById('modalTambahPengeluaran');
        
        if (btnTambah && modalEl) {
            btnTambah.addEventListener('click', function (e) {
                e.preventDefault();
                var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();
            });
        }
    });
</script>
@endpush
