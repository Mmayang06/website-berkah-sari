@extends('layouts.pengurus')

@section('title', 'Laporan Operasional - Berkah Sari')
@section('page-title', 'Laporan Operasional')

@push('styles')
<style>
    :root {
        --primary: #348E38;
        --dark: #0F4229;
        --brand-forest-dark: #051C12;
        --brand-forest-medium: #072F1F;
        --brand-forest-light: #1A3E30;
        --brand-lime: #B4F105;
        --brand-lime-hover: #c1f824;
        --brand-lime-translucent: rgba(180, 241, 5, 0.2);
        --text-main: #0B130F;
        --text-muted-green: #6C7E75;
        --border-light: rgba(11, 19, 15, 0.08);
        --radius-sm: 8px;
        --radius-md: 10px;
        --radius-lg: 12px;
        --radius-xl: 16px;
        --radius-2xl: 20px;
        --shadow-sm: 0 2px 8px rgba(11, 19, 15, 0.04);
        --shadow-md: 0 4px 16px rgba(11, 19, 15, 0.06);
        --shadow-lg: 0 10px 30px rgba(11, 19, 15, 0.08);
        --sys-green: #22C55E;
        --sys-red: #EF4444;
    }

    .filter-card {
        background: #fff; border-radius: var(--radius-xl);
        border: 1px solid rgba(11, 19, 15, 0.06); box-shadow: var(--shadow-sm);
        padding: 20px 24px; margin-bottom: 20px;
    }
    .filter-card-title {
        font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: .95rem;
        color: var(--text-main); margin: 0 0 16px; display: flex; align-items: center; gap: 8px;
    }
    .filter-card-title i { color: var(--brand-forest-medium); }

    .form-label-custom {
        display: inline-block;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .form-label-custom .req {
        color: var(--sys-red);
        margin-left: 2px;
    }

    .form-control-custom {
        display: block;
        width: 100%;
        padding: 0.6rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        line-height: 1.5;
        color: var(--text-main);
        background-color: #FFFFFF;
        background-clip: padding-box;
        border: 1px solid rgba(11, 19, 15, 0.12);
        border-radius: var(--radius-lg);
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .form-control-custom:focus {
        color: var(--text-main);
        background-color: #FFFFFF;
        border-color: var(--brand-forest-medium);
        outline: 0;
        box-shadow: 0 0 0 3px rgba(7, 47, 31, 0.08);
    }
    .form-control-custom::placeholder {
        color: var(--text-muted-green);
        opacity: 0.5;
    }
    .form-control-custom:disabled,
    .form-control-custom[readonly] {
        background-color: #F8FAF9;
        border-color: rgba(11, 19, 15, 0.06);
        color: var(--text-muted-green);
        opacity: 0.8;
    }

    .form-select-custom {
        display: block;
        width: 100%;
        padding: 0.6rem 2.25rem 0.6rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        line-height: 1.5;
        color: var(--text-main);
        background-color: #FFFFFF;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23072F1F' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 12px 10px;
        border: 1px solid rgba(11, 19, 15, 0.12);
        border-radius: var(--radius-lg);
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        appearance: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .form-select-custom:focus {
        border-color: var(--brand-forest-medium);
        outline: 0;
        box-shadow: 0 0 0 3px rgba(7, 47, 31, 0.08);
    }

    .input-group-custom {
        position: relative;
        display: flex;
        flex-wrap: nowrap;
        align-items: stretch;
        width: 100%;
        border-radius: var(--radius-lg);
        border: 1px solid rgba(11, 19, 15, 0.12);
        background-color: #FFFFFF;
        overflow: hidden;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .input-group-custom:focus-within {
        border-color: var(--brand-forest-medium);
        box-shadow: 0 0 0 3px rgba(7, 47, 31, 0.08);
    }
    .input-group-text-custom {
        display: flex;
        align-items: center;
        padding: 0.375rem 0.85rem;
        font-size: 0.875rem;
        font-weight: 600;
        line-height: 1.5;
        color: var(--text-muted-green);
        text-align: center;
        white-space: nowrap;
        background-color: #F8FAF9;
        border: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .input-group-custom .form-control-custom {
        border: none !important;
        border-radius: 0 !important;
        flex: 1 1 auto;
        width: 1%;
        min-width: 0;
        padding-left: 0.75rem;
    }
    .input-group-custom .form-control-custom:focus {
        box-shadow: none !important;
    }

    .form-control-custom.is-valid-custom {
        border-color: var(--sys-green) !important;
    }
    .form-control-custom.is-valid-custom:focus {
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.08) !important;
    }
    .form-control-custom.is-invalid-custom {
        border-color: var(--sys-red) !important;
    }
    .form-feedback-custom {
        display: block;
        width: 100%;
        margin-top: 0.35rem;
        font-size: 0.75rem;
        font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .form-feedback-custom.valid-custom { color: var(--sys-green); }
    .form-feedback-custom.invalid-custom { color: var(--sys-red); }

    .btn-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
        border-radius: var(--radius-lg);
        border: 1px solid transparent;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        text-decoration: none;
        line-height: 1.5;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-custom:active { transform: scale(0.97); }
    .btn-custom-sm {
        padding: 0.48rem 1rem;
        font-size: 0.82rem;
        font-weight: 700;
        border-radius: var(--radius-lg);
    }
    .btn-custom-primary {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #FFFFFF !important;
    }
    .btn-custom-primary:hover {
        background-color: var(--dark) !important;
        border-color: var(--dark) !important;
        color: #FFFFFF !important;
    }
    .btn-custom-light {
        background-color: #FFFFFF;
        border: 1px solid #dee2e6;
        color: #6c757d;
    }
    .btn-custom-light:hover {
        background-color: #F8FAF9;
        color: #212529;
        border-color: #ced4da;
    }

    .btn-add-primary {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: var(--radius-lg);
        padding: .48rem 1rem;
        font-weight: 700;
        font-size: .85rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        transition: all .2s;
        text-decoration: none;
    }
    .btn-add-primary:hover {
        background: var(--dark);
        color: #fff;
    }

    .btn-filter-custom {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: var(--radius-lg);
        padding: .55rem 1.25rem;
        font-weight: 700;
        font-size: .875rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .4rem;
        transition: all .2s;
    }
    .btn-filter-custom:hover {
        background: var(--dark);
        color: #fff;
    }
    .btn-reset-custom {
        background: #fff;
        color: var(--dark);
        border: 1px solid rgba(15,66,41,.15);
        border-radius: var(--radius-lg);
        padding: .55rem 1rem;
        font-weight: 600;
        font-size: .875rem;
        cursor: pointer;
        transition: all .2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-reset-custom:hover {
        background: #f5f8f5;
        color: var(--dark);
    }

    .table-card-custom {
        background: #fff; border-radius: var(--radius-xl); border: 1px solid rgba(11, 19, 15, 0.06);
        box-shadow: var(--shadow-sm); overflow: hidden;
    }
    .table-header-control {
        background: #fff; padding: 1.25rem; border-bottom: 1px solid rgba(11, 19, 15, 0.06);
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
    }
    .tbl-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 1rem; color: var(--text-main); margin: 0; display: flex; align-items: center; gap: 8px; }
    .tbl-title i { color: #8B5CF6; }
    .table-search-box { position: relative; max-width: 280px; flex-grow: 1; }
    .table-search-input {
        width: 100%; padding: .48rem 1rem .48rem 2.25rem; font-size: .85rem;
        border-radius: var(--radius-lg); border: 1px solid rgba(11, 19, 15, 0.1);
        background: #FDFDFD; transition: all .2s; font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .table-search-input:focus { outline: none; border-color: var(--brand-forest-medium); box-shadow: 0 0 0 3px rgba(7, 47, 31, 0.08); }
    .table-search-icon { position: absolute; left: .75rem; top: 50%; transform: translateY(-50%); color: var(--text-muted-green); font-size: .85rem; }
    .btn-table-action {
        background: #fff; border: 1px solid rgba(11, 19, 15, 0.1); color: var(--brand-forest-dark);
        font-size: .85rem; font-weight: 600; padding: .48rem 1rem; border-radius: var(--radius-lg);
        display: inline-flex; align-items: center; gap: .35rem; transition: all .2s; cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-table-action:hover { background: #F8FAF9; border-color: var(--brand-forest-medium); }

    .table-custom { width: 100%; border-collapse: collapse; vertical-align: middle; }
    .table-custom th, .table-custom td { padding: .9rem 1.25rem; border-bottom: 1px solid rgba(11, 19, 15, 0.05); }
    .table-custom th {
        background: #F8FAF9; color: var(--text-muted-green); font-size: .72rem; text-transform: uppercase;
        font-weight: 700; letter-spacing: .05em; border-bottom: 1px solid rgba(11, 19, 15, 0.08); white-space: nowrap;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .table-custom tbody tr { transition: background .2s; }
    .table-custom tbody tr:hover { background: rgba(180, 241, 5, 0.03); }
    .table-custom tbody tr:last-child td { border-bottom: none; }

    .badge-table {
        display: inline-flex; align-items: center; gap: .35rem;
        padding: .25rem .65rem; font-size: .72rem; font-weight: 700; border-radius: 50rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .badge-table::before { content: ''; display: inline-block; width: 6px; height: 6px; border-radius: 50rem; }
    .badge-table.success { background: rgba(34,197,94,.1); color: #22C55E; }
    .badge-table.success::before { background: #22C55E; }
    .badge-table.pending { background: rgba(249,115,22,.1); color: #F97316; }
    .badge-table.pending::before { background: #F97316; }
    .badge-table.purple { background: rgba(139,92,246,.1); color: #8B5CF6; }
    .badge-table.purple::before { background: #8B5CF6; }

    .table-footer-control {
        background: #fff; padding: 1rem 1.25rem; border-top: 1px solid rgba(11, 19, 15, 0.06);
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
    }
    .table-pagination-info { font-size: .83rem; color: var(--text-muted-green); font-family: 'Plus Jakarta Sans', sans-serif; }
    .empty-ph { padding: 48px; text-align: center; color: var(--text-muted-green); font-size: .875rem; font-family: 'Plus Jakarta Sans', sans-serif; }

    /* ─── Spark Admin Premium Modal (Zero Cut-Off, Full Scrollable) ─── */
    .spark-modal .modal-dialog {
        max-width: 760px;
        margin: 1.75rem auto;
    }
    .spark-modal .modal-content {
        background: #FFFFFF;
        border-radius: var(--radius-xl);
        border: 1px solid rgba(11, 19, 15, 0.08);
        box-shadow: 0 20px 50px rgba(5, 28, 18, 0.16);
        overflow: hidden;
    }
    .spark-modal .modal-header {
        background: #FFFFFF;
        padding: 1.25rem 1.75rem;
        border-bottom: 1px solid rgba(11, 19, 15, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .spark-modal .modal-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin: 0;
    }
    .spark-modal .modal-title i {
        color: var(--brand-forest-medium);
        font-size: 1.25rem;
    }
    .spark-modal .modal-body {
        padding: 1.75rem;
        background: #FFFFFF;
    }
    .spark-modal .modal-footer {
        background: #F8FAF9;
        padding: 1rem 1.75rem;
        border-top: 1px solid rgba(11, 19, 15, 0.08);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 0.75rem;
    }
</style>
@endpush

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
        <div class="row g-3 align-items-end">
            <div class="col-sm-6 col-md-3">
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
            <div class="col-sm-6 col-md-3">
                <label class="form-label-custom" for="filter-tahun">Tahun</label>
                <select class="form-select-custom" name="tahun" id="filter-tahun">
                    @foreach(range(now()->year, now()->year - 3) as $y)
                        <option value="{{ $y }}" {{ request('tahun', now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="form-label-custom" for="filter-jenis">Jenis Transaksi</label>
                <select class="form-select-custom" name="jenis" id="filter-jenis">
                    <option value="">Semua Jenis</option>
                    <option value="pemasukan" {{ request('jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="pengeluaran" {{ request('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran Operasional</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-filter-custom flex-grow-1">
                        <i class="fas fa-search"></i> Tampilkan
                    </button>
                    <a href="{{ route('pengurus.laporan-operasional') }}" class="btn-reset-custom">Reset</a>
                </div>
            </div>
        </div>
    </form>
</div>

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

<div class="modal fade spark-modal" id="modalTambahPengeluaran" tabindex="-1" aria-labelledby="modalTambahPengeluaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPengeluaranLabel">
                    <i class="bi bi-wallet2"></i> Tambah Pengeluaran Operasional
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="formTambahPengeluaran" method="POST" action="#">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="mb-2">
                                <label class="form-label-custom" for="nama_barang">
                                    Nama Barang<span class="req">*</span>
                                </label>
                                <input type="text" class="form-control-custom" id="nama_barang" name="nama_barang"
                                    placeholder="Contoh: Kantong plastik, Bahan bakar, dll" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-2">
                                <label class="form-label-custom" for="kategori">
                                    Kategori Pengeluaran <span class="req">*</span>
                                </label>
                                <select class="form-select-custom" id="kategori" name="kategori" required>
                                    <option value="" selected disabled>Pilih Kategori...</option>
                                    <option value="bahan">Bahan / Material</option>
                                    <option value="peralatan">Peralatan Operasional</option>
                                    <option value="transportasi">Transportasi / BBM</option>
                                    <option value="administrasi">Administrasi & ATK</option>
                                    <option value="kebersihan">Upah / Kebersihan</option>
                                    <option value="lainnya">Lain-lain</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="mb-2">
                                <label class="form-label-custom" for="tanggal">
                                    Tanggal Transaksi <span class="req">*</span>
                                </label>
                                <input type="date" class="form-control-custom" id="tanggal" name="tanggal"
                                    value="{{ now()->format('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="mb-2">
                                <label class="form-label-custom" for="jumlah">
                                    Jumlah <span class="req">*</span>
                                </label>
                                <div class="input-group-custom">
                                    <span class="input-group-text-custom"><i class="bi bi-box-seam"></i></span>
                                    <input type="number" class="form-control-custom" id="jumlah" name="jumlah"
                                        placeholder="1" min="1" value="1" required>
                                    <span class="input-group-text-custom">Pcs/Unit</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="mb-2">
                                <label class="form-label-custom" for="harga_satuan">
                                    Harga Satuan <span class="req">*</span>
                                </label>
                                <div class="input-group-custom">
                                    <span class="input-group-text-custom">Rp</span>
                                    <input type="number" class="form-control-custom" id="harga_satuan" name="harga_satuan"
                                        placeholder="0" min="0" step="500" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-0">
                                <label class="form-label-custom" for="keterangan">Keterangan</label>
                                <textarea class="form-control-custom" id="keterangan" name="keterangan" rows="3"
                                    placeholder="Tuliskan keterangan pembelian (opsional)"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i> Batal
                </button>
                <button type="button" class="btn-custom btn-custom-primary" onclick="document.getElementById('formTambahPengeluaran').submit()">
                    <i class="bi bi-check-lg"></i> Simpan Pengeluaran
                </button>
            </div>

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

</script>
@endpush
