@extends('layouts.pengurus')

@section('title', 'Penyetoran ke Induk - Silih Asih')
@section('page-title', 'Penyetoran ke Induk')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h4 class="mb-1 fw-bold" style="color: var(--dark); font-family: 'Jost', sans-serif;">Penyetoran ke Bank Sampah Induk</h4>
        <p class="text-muted mb-0 small">Catat penyaluran sampah ke mitra bank sampah induk</p>
    </div>
    <button type="button" class="btn-add-primary" data-bs-toggle="modal" data-bs-target="#modalPenyetoran" id="btnBukaModalPenyetoran">
        <i class="fas fa-plus"></i> Catat Penyetoran ke Induk
    </button>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-4">
        <div class="summary-card">
            <div class="summary-label">Total Penyetoran</div>
            <div class="summary-value">{{ $totalPenyetoran }}</div>
            <div class="summary-unit">Transaksi penyaluran</div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="summary-card">
            <div class="summary-label">Sampah Disalurkan</div>
            <div class="summary-value text-primary">{{ number_format($totalSampahKg, 2, ',', '.') }}</div>
            <div class="summary-unit">Kilogram (kg)</div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-4">
        <div class="summary-card">
            <div class="summary-label">Total Nilai Penjualan</div>
            <div class="summary-value text-success" style="font-size: 1.35rem;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            <div class="summary-unit">Total pendapatan dari mitra</div>
        </div>
    </div>
</div>

<div class="table-card-custom">
    <div class="table-header-control">
        <h6 class="tbl-title"><i class="fas fa-truck"></i> Riwayat Penyetoran ke Bank Sampah Induk</h6>
        <div class="table-search-box">
            <i class="bi bi-search table-search-icon"></i>
            <input type="text" class="table-search-input" placeholder="Cari penyetoran..." id="searchRiwayat">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-custom" id="tblRiwayatPenyetoran">
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Tanggal Setor</th>
                    <th>Bank Sampah Induk</th>
                    <th>Total Volume</th>
                    <th>Total Nilai</th>
                    <th>Catatan</th>
                    <th class="text-center" style="width: 80px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftarPenyetoran as $idx => $row)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal_setor)->format('d/m/Y') }}</td>
                        <td class="fw-bold text-dark">{{ $row->nama_pengepul }}</td>
                        <td>
                            {{ number_format($row->total_berat, 2, ',', '.') }}
                            <small class="text-muted">kg</small>
                        </td>
                        <td class="fw-bold text-success">Rp {{ number_format($row->total_pendapatan, 0, ',', '.') }}</td>
                        <td>{{ $row->catatan ?: '-' }}</td>
                        <td class="text-center">
                            <form method="POST" action="{{ route(request()->is('ketua*') ? 'ketua.penyetoran.destroy' : 'pengurus.penyetoran.destroy', $row->id_penyetoran) }}" onsubmit="return confirm('Batalkan penyetoran ini? Setoran yang terkait akan dikembalikan ke status belum disetor.');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Batalkan Penyetoran" style="border-radius: 6px; padding: 3px 8px; font-size: 0.75rem;">
                                    Batalkan
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-truck d-block mb-2" style="font-size:2rem; opacity:0.3; color:var(--primary);"></i>
                            Belum ada riwayat penyetoran ke Bank Sampah Induk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalPenyetoran" tabindex="-1" aria-labelledby="modalPenyetoranLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header border-bottom px-4 py-3">
                <h5 class="modal-title fw-bold" id="modalPenyetoranLabel" style="color: var(--dark); font-family: 'Jost', sans-serif;">
                    Catat Penyetoran ke Bank Sampah Induk
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route(request()->is('ketua*') ? 'ketua.penyetoran.store' : 'pengurus.penyetoran.store') }}" id="formPenyetoran">
                @csrf
                <input type="hidden" name="kelompok" value="Sampah">
                <div class="modal-body px-4 py-3">
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label-custom" for="tanggal_setor">Tanggal Penyetoran</label>
                            <input type="date" class="form-control-custom" id="tanggal_setor" name="tanggal_setor" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom" for="id_pengepul">Bank Sampah Induk / Pembeli</label>
                            <select class="form-select-custom" id="id_pengepul" name="id_pengepul" required>
                                <option value="">Pilih Bank Sampah Induk</option>
                                @foreach($daftarPengepul as $p)
                                    <option value="{{ $p->id_pengepul }}">{{ $p->nama_pengepul }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom" for="catatan">Catatan (Opsional)</label>
                        <input type="text" class="form-control-custom" id="catatan" name="catatan" placeholder="Contoh: Pengangkutan rit 1 oleh truk BSB">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
                        <span class="form-label-custom mb-0">Pilih Setoran yang Disalurkan:</span>
                        <div class="d-flex align-items-center gap-2">
                            <div class="form-check m-0">
                                <input class="form-check-input" type="checkbox" id="checkAllSetoran">
                                <label class="form-check-label small" for="checkAllSetoran">Pilih Semua</label>
                            </div>
                            <span class="badge bg-light text-dark border small" id="counterTerpilih">0 dipilih</span>
                        </div>
                    </div>

                    <div class="border rounded p-2" style="max-height: 260px; overflow-y: auto; background: #fafdfa;">
                        <table class="table table-sm align-middle mb-0" id="tblPilihSetoran" style="font-size: 0.85rem;">
                            <thead class="text-muted" style="border-bottom: 2px solid #e2ece2;">
                                <tr>
                                    <th style="width: 35px;"></th>
                                    <th>Tanggal</th>
                                    <th>Lingkungan</th>
                                    <th>Jenis</th>
                                    <th class="text-end">Berat / Volume</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($setoranBelumSetor as $item)
                                    <tr class="row-setoran-item" data-kelompok="{{ $item->kelompok }}">
                                        <td>
                                            <input class="form-check-input check-item-setoran" type="checkbox" name="id_details[]" value="{{ $item->id_detail }}" data-berat="{{ $item->berat }}">
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                        <td class="fw-bold">{{ $item->nama_lingkungan }}</td>
                                        <td>{{ $item->jenis_sampah }}</td>
                                        <td class="text-end fw-bold">{{ number_format($item->berat, 2, ',', '.') }} {{ $item->satuan }}</td>
                                    </tr>
                                @empty
                                    <tr id="emptySetoranRow">
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Tidak ada data setoran yang belum disetor.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer border-top px-4 py-3">
                    <button type="button" class="btn btn-sm btn-light px-3" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-sm btn-success px-4" style="border-radius: 8px; font-weight: 600;" id="btnSubmitPenyetoran">
                        Simpan Penyetoran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkAll = document.getElementById('checkAllSetoran');
        var counter = document.getElementById('counterTerpilih');
        var rows = document.querySelectorAll('.row-setoran-item');

        function updateCounter() {
            var checked = document.querySelectorAll('.check-item-setoran:checked');
            var totalBerat = 0;
            checked.forEach(function(cb) {
                totalBerat += parseFloat(cb.getAttribute('data-berat') || 0);
            });
            if (counter) {
                counter.textContent = checked.length + ' item dipilih (' + totalBerat.toFixed(2) + ' kg)';
            }
        }

        if (checkAll) {
            checkAll.addEventListener('change', function() {
                var isChecked = this.checked;
                rows.forEach(function(row) {
                    var cb = row.querySelector('.check-item-setoran');
                    if (cb) cb.checked = isChecked;
                });
                updateCounter();
            });
        }

        document.querySelectorAll('.check-item-setoran').forEach(function(cb) {
            cb.addEventListener('change', updateCounter);
        });

        var searchRiwayat = document.getElementById('searchRiwayat');
        if (searchRiwayat) {
            searchRiwayat.addEventListener('keyup', function() {
                var val = this.value.toLowerCase();
                document.querySelectorAll('#tblRiwayatPenyetoran tbody tr').forEach(function(r) {
                    r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush
