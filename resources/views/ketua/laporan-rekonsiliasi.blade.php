@extends('layouts.ketua')

@section('title', 'Laporan Arus Kas - Berkah Sari')
@section('page-title', 'Laporan Arus Kas')

@section('content')

<div style="margin-bottom: 20px;">
    <h4 style="font-family:'Jost',sans-serif; font-weight:700; color:var(--dark); margin:0 0 4px; font-size:1.2rem;">
        Laporan Arus Kas (Cash Flow)
    </h4>
    <p style="color:#6C7E75; font-size:.85rem; margin:0;">
        Pencatatan arus kas masuk, kas keluar, dan posisi saldo dana bank sampah. Periode: <strong>{{ $labelPeriode }}</strong>
    </p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="summary-card">
            <div class="summary-label">Total Saldo Kas Bank Sampah</div>
            <div class="summary-value {{ $saldoAkhir >= 0 ? 'text-primary' : 'text-danger' }}">
                Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
            </div>
            <div class="summary-unit">Dicocokkan dengan Saldo Bank</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="summary-card">
            <div class="summary-label">Hak Tabungan Lingkungan</div>
            <div class="summary-value text-success">
                Rp {{ number_format($hakTabunganLingkungan, 0, ',', '.') }}
            </div>
            <div class="summary-unit">Dana Titipan (Status Ditabung)</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="summary-card">
            <div class="summary-label">Kas Bersih Bank Sampah</div>
            <div class="summary-value" style="color: #2e7d32;">
                Rp {{ number_format($kasBersihParoki, 0, ',', '.') }}
            </div>
            <div class="summary-unit">Dana Operasional Bebas Paroki</div>
        </div>
    </div>
</div>

<div class="filter-card">
    <p class="filter-card-title"><i class="fas fa-filter"></i> Filter Periode</p>
    <form method="GET" action="{{ route('ketua.laporan-arus-kas') }}" id="filterForm">
        <div class="row g-3">
            <div class="col-sm-6">
                <label class="form-label-custom" for="bulan">Bulan</label>
                <select class="form-select-custom" name="bulan" id="bulan" onchange="this.form.submit()">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6">
                <label class="form-label-custom" for="tahun">Tahun</label>
                <select class="form-select-custom" name="tahun" id="tahun" onchange="this.form.submit()">
                    @foreach(range(now()->year, now()->year - 3) as $y)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
</div>

<div class="table-card-custom">
    <div class="table-header-control">
        <h6 class="tbl-title"><i class="fas fa-exchange-alt"></i> Rincian Arus Kas ({{ $labelPeriode }})</h6>
        <div class="d-flex gap-2 flex-wrap">
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" class="table-search-input" placeholder="Cari data..." id="searchTbl">
            </div>
            <a href="{{ route('ketua.laporan-arus-kas.export', request()->all()) }}" class="btn-table-action" title="Unduh format Excel">
                <i class="fas fa-file-excel text-success"></i> Unduh Laporan
            </a>
            <button class="btn-table-action" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-custom" id="tblRekonsiliasi">
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Tanggal</th>
                    <th>Keterangan Transaksi</th>
                    <th>Kategori</th>
                    <th style="text-align: right;">Masuk (Rp)</th>
                    <th style="text-align: right;">Keluar (Rp)</th>
                    <th style="text-align: right;">Saldo Kas (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color: #f8faf8;">
                    <td class="text-center">-</td>
                    <td>-</td>
                    <td class="fw-bold">Saldo Awal Periode (Sebelum {{ $namaBulan }} {{ $tahun }})</td>
                    <td><span class="badge bg-secondary">Saldo Awal</span></td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;" class="fw-bold">Rp {{ number_format($saldoAwal, 0, ',', '.') }}</td>
                </tr>

                @forelse($mutasi as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($row['tanggal'])->locale('id')->isoFormat('D MMM YYYY') }}</td>
                        <td>{{ $row['keterangan'] }}</td>
                        <td>
                            @if($row['kategori'] == 'Pemasukan')
                                <span class="badge bg-success">Pemasukan</span>
                            @elseif($row['kategori'] == 'Operasional')
                                <span class="badge bg-danger">Operasional</span>
                            @else
                                <span class="badge bg-warning text-dark">Transfer Lingkungan</span>
                            @endif
                        </td>
                        <td style="text-align: right;" class="{{ $row['masuk'] > 0 ? 'text-success fw-bold' : '' }}">
                            {{ $row['masuk'] > 0 ? 'Rp ' . number_format($row['masuk'], 0, ',', '.') : '-' }}
                        </td>
                        <td style="text-align: right;" class="{{ $row['keluar'] > 0 ? 'text-danger fw-bold' : '' }}">
                            {{ $row['keluar'] > 0 ? 'Rp ' . number_format($row['keluar'], 0, ',', '.') : '-' }}
                        </td>
                        <td style="text-align: right;" class="fw-bold">
                            Rp {{ number_format($row['saldo'], 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada transaksi di bulan ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr style="background-color: #e8f5e9; font-weight: bold;">
                    <td colspan="4" class="text-end">TOTAL MUTASI BULAN INI:</td>
                    <td style="text-align: right;" class="text-success">
                        Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                    </td>
                    <td style="text-align: right;" class="text-danger">
                        Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                    </td>
                    <td style="text-align: right;" class="text-primary">
                        Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="table-footer-control">
        <span class="table-pagination-info">Menampilkan {{ count($mutasi) }} transaksi mutasi</span>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('searchTbl').addEventListener('keyup', function() {
        var val = this.value.toLowerCase();
        document.querySelectorAll('#tblRekonsiliasi tbody tr').forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endpush

