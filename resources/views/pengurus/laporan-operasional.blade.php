@extends('layouts.pengurus')

@section('title', 'Laporan Operasional - Berkah Sari')
@section('page-title', 'Laporan Operasional')

@section('content')

<div style="margin-bottom: 20px;">
    <h4 style="font-family:'Jost',sans-serif; font-weight:700; color:var(--dark); margin:0 0 4px; font-size:1.2rem;">
        Laporan Operasional
    </h4>
    <p style="color:#6C7E75; font-size:.85rem; margin:0;">
        Data rekap biaya dan pengeluaran operasional bank sampah. Periode: <strong>{{ $labelPeriode }}</strong>
    </p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="summary-card">
            <div class="summary-label">Total Transaksi Pengeluaran</div>
            <div class="summary-value">{{ number_format($totalTransaksi, 0, ',', '.') }}</div>
            <div class="summary-unit">Transaksi</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="summary-card">
            <div class="summary-label">Total Biaya Operasional</div>
            <div class="summary-value text-danger">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</div>
            <div class="summary-unit">Rupiah</div>
        </div>
    </div>
</div>

<div class="filter-card">
    <p class="filter-card-title"><i class="fas fa-filter"></i> Filter Laporan</p>
    <form method="GET" action="{{ url()->current() }}" id="filterForm">
        <div class="row g-3 align-items-end">
            <div class="col-sm-6 col-lg-3">
                <label class="form-label-custom" for="filter-tipe">Tipe Periode</label>
                <select class="form-select-custom" name="tipe" id="filter-tipe" onchange="togglePeriodeInputs()">
                    <option value="bulan" {{ $tipe === 'bulan' ? 'selected' : '' }}>Per Bulan</option>
                    <option value="triwulan" {{ $tipe === 'triwulan' ? 'selected' : '' }}>Per 3 Bulan</option>
                </select>
            </div>

            <div class="col-sm-6 col-lg-3" id="wrapper-bulan" style="{{ $tipe === 'triwulan' ? 'display:none;' : '' }}">
                <label class="form-label-custom" for="filter-bulan">Bulan</label>
                <select class="form-select-custom" name="bulan" id="filter-bulan">
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 col-lg-3" id="wrapper-triwulan" style="{{ $tipe === 'triwulan' ? '' : 'display:none;' }}">
                <label class="form-label-custom" for="filter-triwulan">Pilihan 3 Bulan</label>
                <select class="form-select-custom" name="triwulan" id="filter-triwulan">
                    <option value="1" {{ $triwulan == 1 ? 'selected' : '' }}>Triwulan 1 (Jan-Mar)</option>
                    <option value="2" {{ $triwulan == 2 ? 'selected' : '' }}>Triwulan 2 (Apr-Jun)</option>
                    <option value="3" {{ $triwulan == 3 ? 'selected' : '' }}>Triwulan 3 (Jul-Sep)</option>
                    <option value="4" {{ $triwulan == 4 ? 'selected' : '' }}>Triwulan 4 (Okt-Des)</option>
                </select>
            </div>

            <div class="col-sm-6 col-lg-3">
                <label class="form-label-custom" for="filter-tahun">Tahun</label>
                <select class="form-select-custom" name="tahun" id="filter-tahun">
                    @foreach(range(now()->year, now()->year - 3) as $y)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 col-lg-3">
                <button type="submit" class="btn-filter-custom w-100">
                    <i class="fas fa-search"></i> Tampilkan
                </button>
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
        <h6 class="tbl-title"><i class="fas fa-cogs"></i> Rekap Biaya Operasional ({{ $labelPeriode }})</h6>
        <div class="d-flex gap-2 flex-wrap">
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" class="table-search-input" placeholder="Cari data..." id="searchTbl">
            </div>
            <button type="button" class="btn-add-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengeluaran" id="btnTambahPengeluaran">
                <i class="fas fa-plus"></i> Tambah Pengeluaran
            </button>
            <a href="{{ request()->is('ketua*') ? route('ketua.laporan-operasional.export', request()->all()) : route('pengurus.laporan-operasional.export', request()->all()) }}" class="btn-table-action" title="Unduh format Excel">
                <i class="fas fa-file-excel text-success"></i> Unduh Laporan
            </a>
            <button class="btn-table-action" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-custom" id="tblLaporan">
            <thead>
                @if($tipe === 'triwulan')
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>Keterangan Pengeluaran</th>
                        <th>{{ $namaBulan[0] }} (Rp)</th>
                        <th>{{ $namaBulan[1] }} (Rp)</th>
                        <th>{{ $namaBulan[2] }} (Rp)</th>
                        <th>Jumlah Total</th>
                    </tr>
                @else
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>Tanggal Pengeluaran</th>
                        <th>Keterangan</th>
                        <th>Biaya Keluar</th>
                    </tr>
                @endif
            </thead>
            <tbody>
                @forelse($items as $i => $row)
                    @if($tipe === 'triwulan')
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-bold">{{ $row->keterangan }}</td>
                            <td>Rp {{ number_format($row->bulan_1, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($row->bulan_2, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($row->bulan_3, 0, ',', '.') }}</td>
                            <td class="fw-bold text-danger">Rp {{ number_format($row->total_biaya, 0, ',', '.') }}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->tanggal_keluar)->format('d/m/Y') }}</td>
                            <td class="fw-bold">{{ $row->keterangan }}</td>
                            <td class="fw-bold text-danger">Rp {{ number_format($row->biaya_keluar, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="{{ $tipe === 'triwulan' ? '6' : '4' }}" class="empty-ph">
                            <i class="fas fa-inbox d-block mb-2" style="font-size:1.8rem;opacity:.2;color:var(--primary)"></i>
                            Belum ada data pengeluaran operasional untuk periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if(count($items) > 0)
            <tfoot style="background: #F8FAF9; font-weight: 700; border-top: 2px solid rgba(15,66,41,0.1);">
                @if($tipe === 'triwulan')
                    <tr>
                        <td colspan="2" class="text-center">TOTAL KESELURUHAN</td>
                        <td>Rp {{ number_format($items->sum('bulan_1'), 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($items->sum('bulan_2'), 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($items->sum('bulan_3'), 0, ',', '.') }}</td>
                        <td class="text-danger">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="3" class="text-center">TOTAL KESELURUHAN</td>
                        <td class="text-danger">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</td>
                    </tr>
                @endif
            </tfoot>
            @endif
        </table>
    </div>

    <div class="table-footer-control">
        <span class="table-pagination-info">Menampilkan {{ count($items) }} data</span>
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

            <form id="formTambahPengeluaran" method="POST" action="{{ request()->is('ketua*') ? route('ketua.laporan-operasional.store') : route('pengurus.laporan-operasional.store') }}">
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
    function togglePeriodeInputs() {
        var tipe = document.getElementById('filter-tipe').value;
        var wrapBulan = document.getElementById('wrapper-bulan');
        var wrapTriwulan = document.getElementById('wrapper-triwulan');

        if (tipe === 'triwulan') {
            wrapBulan.style.display = 'none';
            wrapTriwulan.style.display = 'block';
        } else {
            wrapBulan.style.display = 'block';
            wrapTriwulan.style.display = 'none';
        }
    }

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
