@extends('layouts.pengurus')

@section('title', 'Daftar Kategori - ' . $title_kategori)
@section('page-title', 'Daftar Kategori')

@push('styles')
<style>
    .katalog-header {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
    .katalog-title {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
        font-size: 1.25rem;
    }
    .katalog-sub {
        color: #6C7E75;
        font-size: .85rem;
        margin: 2px 0 0;
    }
    .btn-action-custom {
        background: var(--primary);
        color: #fff;
        border: none;
        padding: .45rem 1rem;
        border-radius: 8px;
        font-size: .85rem;
        font-weight: 600;
        font-family: 'Jost', sans-serif;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all .2s;
        cursor: pointer;
    }
    .btn-action-custom:hover {
        background: var(--dark);
        color: #fff;
    }
    .table-card-custom {
        background: #fff;
        border-radius: 12px;
        border: 1px solid rgba(15,66,41,.08);
        box-shadow: 0 2px 8px rgba(15,66,41,.03);
        overflow: hidden;
    }
    .table-header-control {
        background: #fff;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid rgba(15,66,41,.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .table-search-box {
        position: relative;
        max-width: 260px;
        flex-grow: 1;
    }
    .table-search-input {
        width: 100%;
        padding: .45rem .9rem .45rem 2.2rem;
        font-size: .85rem;
        border-radius: 8px;
        border: 1px solid rgba(15,66,41,.12);
        background: #FDFDFD;
        font-family: 'Open Sans', sans-serif;
    }
    .table-search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(52,142,56,.08);
    }
    .table-search-icon {
        position: absolute;
        left: .75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6C7E75;
        font-size: .85rem;
    }
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        vertical-align: middle;
    }
    .table-custom th, .table-custom td {
        padding: .85rem 1.25rem;
        border-bottom: 1px solid rgba(15,66,41,.05);
    }
    .table-custom th {
        background: #F8FAF9;
        color: #6C7E75;
        font-size: .75rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: .05em;
        border-bottom: 1px solid rgba(15,66,41,.08);
        white-space: nowrap;
    }
    .table-custom tbody tr:hover {
        background: rgba(52,142,56,.025);
    }
    .table-btn-action {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: 1px solid rgba(15, 66, 41, 0.12);
        background-color: #fff;
        color: var(--dark);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all .2s;
    }
    .table-btn-action:hover {
        background-color: var(--primary);
        color: #fff;
        border-color: var(--primary);
    }
    .table-footer-control {
        background: #fff;
        padding: .85rem 1.25rem;
        border-top: 1px solid rgba(15,66,41,.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: .83rem;
        color: #6C7E75;
    }
</style>
@endpush

@section('content')

<div class="katalog-header">
    <div>
        <h4 class="katalog-title">Daftar Kategori - {{ $title_kategori }}</h4>
        <p class="katalog-sub">Daftar jenis kategori sampah yang terdaftar di sistem</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <select class="form-select form-select-sm" style="width: auto; border-radius: 8px; font-size: .85rem;" onchange="location = this.value;">
            <option value="{{ route('pengurus.daftar-kategori', 'sampah') }}" {{ $jenis == 'sampah' ? 'selected' : '' }}>Bank Sampah</option>
            <option value="{{ route('pengurus.daftar-kategori', 'minyak-jelantah') }}" {{ $jenis == 'minyak-jelantah' ? 'selected' : '' }}>Minyak Jelantah</option>
        </select>
        <button type="button" class="btn-action-custom" data-bs-toggle="modal" data-bs-target="#modalTambahJenis">
            <i class="fas fa-plus"></i> Tambah Jenis Sampah
        </button>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="border-radius: 8px; font-size: .85rem;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="table-card-custom">
    <div class="table-header-control">
        <div class="table-search-box">
            <i class="bi bi-search table-search-icon"></i>
            <input type="text" class="table-search-input" id="searchKategori" placeholder="Cari jenis sampah...">
        </div>
        <div class="text-muted small">
            Total: <strong>{{ count($kategori) }} Jenis</strong>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-custom" id="tblKategori">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Jenis Sampah</th>
                    <th>Satuan</th>
                    <th class="text-center" style="width: 70px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold text-dark">{{ $item->jenis }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td class="text-center">
                            <a href="#" class="table-btn-action" title="Edit"><i class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            Belum ada data kategori sampah.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="table-footer-control">
        <span id="infoTotal">Menampilkan {{ count($kategori) }} data</span>
        <span>Kategori: <strong>{{ $title_kategori }}</strong></span>
    </div>
</div>

<div class="modal fade" id="modalTambahJenis" tabindex="-1" aria-labelledby="modalTambahJenisLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header" style="border-bottom: 1px solid rgba(15, 66, 41, 0.08); padding: 1.25rem 1.5rem;">
                <h5 class="modal-title fw-bold text-dark" id="modalTambahJenisLabel" style="font-family: 'Jost', sans-serif; font-size: 1.1rem;">
                    <i class="fas fa-plus-circle text-primary me-2"></i>Tambah Jenis Sampah
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pengurus.kategori-sampah.store') }}" method="POST">
                @csrf
                <div class="modal-body" style="background: #F8FAF9; padding: 1.5rem;">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-1">Kelompok <span class="text-danger">*</span></label>
                        <select class="form-select" name="kelompok" required style="border-radius: 8px; font-size: .875rem;">
                            <option value="Sampah" {{ $kelompok == 'Sampah' ? 'selected' : '' }}>Bank Sampah</option>
                            <option value="Minyak Jelantah" {{ $kelompok == 'Minyak Jelantah' ? 'selected' : '' }}>Minyak Jelantah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-1">Jenis Sampah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="jenis" placeholder="Contoh: Plastik Bening, Kardus Box" required style="border-radius: 8px; font-size: .875rem;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-1">Satuan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="satuan" placeholder="Contoh: kg, liter, pcs" required style="border-radius: 8px; font-size: .875rem;">
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid rgba(15, 66, 41, 0.08); padding: 1rem 1.5rem;">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm" style="background: var(--primary); border-color: var(--primary); border-radius: 8px;">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('searchKategori').addEventListener('keyup', function() {
        let val = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tblKategori tbody tr');
        let visible = 0;
        rows.forEach(function(r) {
            let text = r.innerText.toLowerCase();
            if (text.includes(val)) {
                r.style.display = '';
                visible++;
            } else {
                r.style.display = 'none';
            }
        });
        document.getElementById('infoTotal').innerText = 'Menampilkan ' + visible + ' data';
    });
</script>
@endpush

@endsection
