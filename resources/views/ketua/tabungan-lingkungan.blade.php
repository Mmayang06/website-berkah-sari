@extends('layouts.ketua')

@section('title', 'Tabungan Lingkungan - Berkah Sari')
@section('page-title', 'Tabungan Lingkungan')

@section('content')

<div style="margin-bottom: 20px;">
    <h4 style="font-family:'Jost',sans-serif; font-weight:700; color:var(--dark); margin:0 0 4px; font-size:1.2rem;">
        Tabungan Lingkungan
    </h4>
    <p style="color:#6C7E75; font-size:.85rem; margin:0;">
        Penyaluran hasil bank sampah tiap lingkungan (Ditabung atau Ditransfer).
    </p>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="filter-card">
    <p class="filter-card-title"><i class="fas fa-filter"></i> Filter Periode</p>
    <form method="GET" action="{{ route('ketua.tabungan-lingkungan') }}" id="filterForm">
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
        <div class="table-search-box">
            <i class="bi bi-search table-search-icon"></i>
            <input type="text" class="table-search-input" placeholder="Cari nama lingkungan..." id="searchTbl">
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small">
                Periode: <strong>{{ $namaBulan }} {{ $tahun }}</strong>
            </span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-custom" id="tblTabungan">
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Nama Lingkungan</th>
                    <th>Donatur</th>
                    <th>Berat Sampah</th>
                    <th>Hasil Bulan Ini</th>
                    <th style="min-width: 140px;">Status Penyaluran</th>
                    <th>Total Tabungan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-bold">{{ $row->nama_lingkungan }}</td>
                        <td>{{ $row->donatur }} orang</td>
                        <td>{{ number_format($row->berat, 2, ',', '.') }} kg</td>
                        <td class="fw-bold">Rp {{ number_format($row->nominal, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('ketua.tabungan-lingkungan.update-status') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_lingkungan" value="{{ $row->id_lingkungan }}">
                                <input type="hidden" name="bulan" value="{{ $bulan }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                                <input type="hidden" name="nominal" value="{{ $row->nominal }}">
                                <select name="status" class="form-select form-select-sm {{ $row->status == 'Ditabung' ? 'text-success fw-bold border-success' : 'text-primary fw-bold border-primary' }}" style="border-radius: 6px; font-size: .85rem; width: 130px; cursor: pointer;" onchange="this.form.submit()" title="Ubah status penyaluran">
                                    <option value="Ditabung" {{ $row->status == 'Ditabung' ? 'selected' : '' }}>Ditabung</option>
                                    <option value="Ditransfer" {{ $row->status == 'Ditransfer' ? 'selected' : '' }}>Ditransfer</option>
                                </select>
                            </form>
                        </td>
                        <td class="fw-bold text-success">Rp {{ number_format($row->saldo_tabungan, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada data lingkungan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if(count($items) > 0)
            <tfoot style="background: #F8FAF9; font-weight: 700; border-top: 2px solid rgba(15,66,41,0.1);">
                <tr>
                    <td colspan="3" class="text-center">TOTAL KESELURUHAN</td>
                    <td>{{ number_format(collect($items)->sum('berat'), 2, ',', '.') }} kg</td>
                    <td>Rp {{ number_format($totalHasilBulanIni, 0, ',', '.') }}</td>
                    <td></td>
                    <td class="text-success">Rp {{ number_format($totalTabunganSemua, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>

    <div class="table-footer-control">
        <span class="table-pagination-info">Menampilkan {{ count($items) }} lingkungan</span>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('searchTbl').addEventListener('keyup', function() {
        var val = this.value.toLowerCase();
        document.querySelectorAll('#tblTabungan tbody tr').forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
        });
    });
</script>
@endpush

