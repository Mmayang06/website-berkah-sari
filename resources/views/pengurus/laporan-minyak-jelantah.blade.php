@extends('layouts.pengurus')

@section('title', 'Laporan Minyak Jelantah - Berkah Sari')
@section('page-title', 'Laporan Minyak Jelantah')

@section('content')

<div style="margin-bottom: 20px;">
    <h4 style="font-family:'Jost',sans-serif; font-weight:700; color:var(--dark); margin:0 0 4px; font-size:1.2rem;">
        Laporan Minyak Jelantah
    </h4>
    <p style="color:#6C7E75; font-size:.85rem; margin:0;">
        Data rekap setoran minyak jelantah dari seluruh donatur. Periode: <strong>{{ $labelPeriode }}</strong>
    </p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="summary-card">
            <div class="summary-label">Total Volume</div>
            <div class="summary-value">{{ number_format($totalBerat, 2, ',', '.') }}</div>
            <div class="summary-unit">Liter (L)</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="summary-card">
            <div class="summary-label">Total Nilai Rupiah</div>
            <div class="summary-value">Rp {{ number_format($totalNilai, 0, ',', '.') }}</div>
            <div class="summary-unit">Rupiah</div>
        </div>
    </div>
</div>

<div class="filter-card">
    <p class="filter-card-title"><i class="fas fa-filter"></i> Filter Laporan</p>
    <form method="GET" action="{{ url()->current() }}" id="filterForm">
        <div class="row g-3 align-items-end">
            <div class="col-sm-6 col-lg-2">
                <label class="form-label-custom" for="filter-tipe">Tipe Periode</label>
                <select class="form-select-custom" name="tipe" id="filter-tipe" onchange="togglePeriodeInputs()">
                    <option value="bulan" {{ $tipe === 'bulan' ? 'selected' : '' }}>Per Bulan</option>
                    <option value="triwulan" {{ $tipe === 'triwulan' ? 'selected' : '' }}>Per 3 Bulan</option>
                </select>
            </div>

            <div class="col-sm-6 col-lg-2" id="wrapper-bulan" style="{{ $tipe === 'triwulan' ? 'display:none;' : '' }}">
                <label class="form-label-custom" for="filter-bulan">Bulan</label>
                <select class="form-select-custom" name="bulan" id="filter-bulan">
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 col-lg-2" id="wrapper-triwulan" style="{{ $tipe === 'triwulan' ? '' : 'display:none;' }}">
                <label class="form-label-custom" for="filter-triwulan">Pilihan 3 Bulan</label>
                <select class="form-select-custom" name="triwulan" id="filter-triwulan">
                    <option value="1" {{ $triwulan == 1 ? 'selected' : '' }}>Triwulan 1 (Jan-Mar)</option>
                    <option value="2" {{ $triwulan == 2 ? 'selected' : '' }}>Triwulan 2 (Apr-Jun)</option>
                    <option value="3" {{ $triwulan == 3 ? 'selected' : '' }}>Triwulan 3 (Jul-Sep)</option>
                    <option value="4" {{ $triwulan == 4 ? 'selected' : '' }}>Triwulan 4 (Okt-Des)</option>
                </select>
            </div>

            <div class="col-sm-6 col-lg-2">
                <label class="form-label-custom" for="filter-tahun">Tahun</label>
                <select class="form-select-custom" name="tahun" id="filter-tahun">
                    @foreach(range(now()->year, now()->year - 3) as $y)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 col-lg-4">
                <label class="form-label-custom" for="filter-lingkungan">Lingkungan</label>
                <select class="form-select-custom" name="lingkungan" id="filter-lingkungan">
                    <option value="">Semua Lingkungan</option>
                    @foreach($daftarLingkungan as $lingk)
                        <option value="{{ $lingk }}" {{ ($lingkungan ?? '') === $lingk ? 'selected' : '' }}>
                            {{ $lingk }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 col-lg-2">
                <button type="submit" class="btn-filter-custom w-100">
                    <i class="fas fa-search"></i> Tampilkan
                </button>
            </div>
        </div>
    </form>
</div>

<div class="table-card-custom">
    <div class="table-header-control">
        <h6 class="tbl-title"><i class="fas fa-tint"></i> Rekap Data Minyak Jelantah ({{ $labelPeriode }})</h6>
        <div class="d-flex gap-2 flex-wrap">
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" class="table-search-input" placeholder="Cari data..." id="searchTbl">
            </div>
            <a href="{{ request()->is('ketua*') ? route('ketua.laporan-minyak-jelantah.export', request()->all()) : route('pengurus.laporan-minyak-jelantah.export', request()->all()) }}" class="btn-table-action" title="Unduh format Excel">
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
                        <th>Nama Donatur</th>
                        <th>Lingkungan</th>
                        <th>{{ $namaBulan[0] }} (Rp)</th>
                        <th>{{ $namaBulan[1] }} (Rp)</th>
                        <th>{{ $namaBulan[2] }} (Rp)</th>
                        <th>Jumlah Total</th>
                    </tr>
                @else
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>Tanggal</th>
                        <th>Nama Donatur</th>
                        <th>Lingkungan</th>
                        <th>Volume</th>
                        <th>Total Nilai</th>
                        <th>Status</th>
                    </tr>
                @endif
            </thead>
            <tbody>
                @forelse($items as $i => $row)
                    @if($tipe === 'triwulan')
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-bold">{{ $row->nama_donatur }}</td>
                            <td>{{ $row->nama_lingkungan }}</td>
                            <td>Rp {{ number_format($row->bulan_1, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($row->bulan_2, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($row->bulan_3, 0, ',', '.') }}</td>
                            <td class="fw-bold text-success">Rp {{ number_format($row->total_nilai, 0, ',', '.') }}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
                            <td class="fw-bold">{{ $row->nama_donatur }}</td>
                            <td>{{ $row->nama_lingkungan }}</td>
                            <td>{{ number_format($row->berat, 2, ',', '.') }} L</td>
                            <td class="fw-bold text-success">Rp {{ number_format($row->total_nilai, 0, ',', '.') }}</td>
                            <td><span class="badge-table success">Selesai</span></td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="{{ $tipe === 'triwulan' ? '7' : '7' }}" class="empty-ph">
                            <i class="fas fa-inbox d-block mb-2" style="font-size:1.8rem;opacity:.2;color:var(--primary)"></i>
                            Belum ada data setoran minyak jelantah untuk periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if(count($items) > 0)
            <tfoot style="background: #F8FAF9; font-weight: 700; border-top: 2px solid rgba(15,66,41,0.1);">
                @if($tipe === 'triwulan')
                    <tr>
                        <td colspan="3" class="text-center">TOTAL KESELURUHAN</td>
                        <td>Rp {{ number_format($items->sum('bulan_1'), 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($items->sum('bulan_2'), 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($items->sum('bulan_3'), 0, ',', '.') }}</td>
                        <td class="text-success">Rp {{ number_format($totalNilai, 0, ',', '.') }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="4" class="text-center">TOTAL KESELURUHAN</td>
                        <td>{{ number_format($totalBerat, 2, ',', '.') }} L</td>
                        <td class="text-success">Rp {{ number_format($totalNilai, 0, ',', '.') }}</td>
                        <td></td>
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
</script>
@endpush
