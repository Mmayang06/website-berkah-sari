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

    .form-label-custom {
        display: inline-block;
        font-size: .85rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: .45rem;
        font-family: 'Open Sans', sans-serif;
    }
    .form-control-custom {
        display: block;
        width: 100%;
        padding: .6rem 1rem;
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(15, 66, 41, 0.15);
        border-radius: 8px;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        font-family: 'Open Sans', sans-serif;
    }
    .form-control-custom:focus {
        color: #212529;
        background-color: #fff;
        border-color: var(--primary);
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(52, 142, 56, 0.15);
    }
    .form-control-custom::placeholder {
        color: #8c9b93;
        opacity: 0.8;
    }

    .modal {
        z-index: 1060 !important;
    }
    .modal-backdrop {
        z-index: 1055 !important;
    }
    .modal-card-custom {
        background: #ffffff;
        border: 1px solid rgba(15, 66, 41, 0.1);
        border-radius: 14px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.18);
        padding: 1.75rem;
    }

    .btn-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.55rem 1.25rem;
        border-radius: 8px;
        border: 1px solid transparent;
        transition: all 0.2s;
        cursor: pointer;
        text-decoration: none;
        line-height: 1.5;
        font-family: 'Jost', sans-serif;
    }
    .btn-custom-primary {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #FFFFFF !important;
    }
    .btn-custom-primary:hover {
        background-color: var(--dark) !important;
        border-color: var(--dark) !important;
    }
    .btn-custom-light {
        background-color: #FFFFFF;
        border: 1px solid #dee2e6;
        color: #6c757d;
    }
    .btn-custom-light:hover {
        background-color: #f8f9fa;
        color: #495057;
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
        <button type="button" class="btn-action-custom" data-bs-toggle="modal" data-bs-target="#modalTambahJenis" id="btnTambahJenis">
            <i class="fas fa-plus"></i> Tambah Jenis Sampah
        </button>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3 shadow-sm" role="alert" style="border-radius: 8px; font-size: .85rem;">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-3 shadow-sm" role="alert" style="border-radius: 8px; font-size: .85rem;">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold text-dark">{{ $item->jenis }}</td>
                        <td>{{ $item->satuan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">
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

<div class="modal fade" id="modalTambahJenis" tabindex="-1" aria-labelledby="modalTambahJenisLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 580px;">
        <div class="modal-content modal-card-custom">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h5 class="card-title mb-0 d-flex align-items-center gap-2" id="modalTambahJenisLabel" style="font-family: 'Jost', sans-serif; font-size: 1.15rem; color: var(--dark); font-weight: 700;">
                    <i class="fas fa-plus-circle text-primary fs-5"></i>
                    <span>Tambah Jenis Sampah</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('pengurus.kategori-sampah.store') }}" method="POST">
                @csrf
                <input type="hidden" name="kelompok" value="{{ $kelompok }}">

                <div class="mb-3">
                    <label for="input_jenis" class="form-label-custom">Jenis Sampah <span class="text-danger">*</span></label>
                    <input type="text" class="form-control-custom" id="input_jenis" name="jenis" placeholder="Contoh: Plastik Bening, Kardus Box" value="{{ old('jenis') }}" required>
                </div>

                <div class="mb-4">
                    <label for="input_satuan" class="form-label-custom">Satuan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control-custom" id="input_satuan" name="satuan" placeholder="Contoh: kg, liter, pcs" value="{{ old('satuan') }}" required>
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

    document.addEventListener('DOMContentLoaded', function () {
        var btnTambah = document.getElementById('btnTambahJenis');
        var modalEl = document.getElementById('modalTambahJenis');
        
        if (btnTambah && modalEl) {
            btnTambah.addEventListener('click', function (e) {
                e.preventDefault();
                var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();
            });
        }

        @if($errors->any())
        if (modalEl) {
            var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }
        @endif
    });
</script>
@endpush

@endsection
