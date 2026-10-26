@extends('layouts.pengurus')

@section('title', 'Bank Sampah Induk - Berkah Sari')
@section('page-title', 'Bank Sampah Induk')

@push('styles')
<style>
    .btn-add-primary {
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: .5rem 1.15rem;
        font-weight: 700;
        font-size: .875rem;
        font-family: 'Jost', sans-serif;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        transition: all .2s;
        text-decoration: none;
        box-shadow: 0 2px 6px rgba(52, 142, 56, 0.25);
    }

    .form-label-custom {
        display: inline-block;
        font-size: .82rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: .45rem;
    }
    .form-control-custom {
        display: block;
        width: 100%;
        padding: .55rem 1rem;
        font-size: .875rem;
        font-weight: 500;
        line-height: 1.5;
        color: var(--dark);
        background: #fff;
        border: 1px solid rgba(15,66,41,.12);
        border-radius: 8px;
        transition: border-color .2s, box-shadow .2s;
        font-family: 'Open Sans', sans-serif;
    }
    .form-control-custom:focus {
        border-color: var(--primary);
        outline: 0;
        box-shadow: 0 0 0 3px rgba(52,142,56,.09);
    }
    .form-select-custom {
        display: block;
        width: 100%;
        padding: .55rem 2.25rem .55rem 1rem;
        font-size: .875rem;
        font-weight: 500;
        line-height: 1.5;
        color: var(--dark);
        background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%230F4229' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") no-repeat right 1rem center / 12px 10px;
        border: 1px solid rgba(15,66,41,.12);
        border-radius: 8px;
        transition: border-color .2s, box-shadow .2s;
        appearance: none;
        font-family: 'Open Sans', sans-serif;
    }
    .form-select-custom:focus {
        border-color: var(--primary);
        outline: 0;
        box-shadow: 0 0 0 3px rgba(52,142,56,.09);
    }
    .modal-header-custom {
        background: #FFFFFF;
        border-bottom: 1px solid rgba(15, 66, 41, 0.08);
        padding: 1.25rem 1.5rem;
    }
    .modal-title-custom {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .modal-body-custom {
        padding: 1.5rem;
        background: #F8FAF9;
    }
    .modal-footer-custom {
        background: #FFFFFF;
        border-top: 1px solid rgba(15, 66, 41, 0.08);
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
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
    .btn-custom-light {
        background-color: #FFFFFF;
        border: 1px solid #dee2e6;
        color: #6c757d;
    }
</style>
@endpush

@section('content')

    <div class="container-xxl py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h4 class="mb-1 fw-bold" style="color: var(--dark); font-family: 'Jost', sans-serif;">Daftar Bank Sampah Induk & Pengepul</h4>
                    <p class="text-muted mb-0 small">Kelola data mitra bank sampah induk, pengepul, dan pembeli</p>
                </div>
                <button type="button" class="btn-add-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengepul" id="btnTambahPengepul">
                    <i class="fas fa-plus"></i> Tambah Pengepul
                </button>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3 bg-white shadow-sm overflow-hidden p-2 d-flex align-items-center justify-content-center">
                                <img class="img-fluid rounded-circle" src="{{ asset('img/icon/bank-sampah-bersinar.jpg') }}" alt="Bank Sampah Bersinar" style="object-fit: contain; width: 100%; height: 100%;">
                            </div>
                            <h4 class="mb-3">Bank Sampah Bersinar</h4>
                            <p class="mb-4">Jl. Terusan Bojongsoang No. 174A, Bandung</p>
                            <a class="btn btn-sm" href="{{ route('pengurus.katalog', 1) }}">Lihat</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3 bg-white shadow-sm overflow-hidden p-1 d-flex align-items-center justify-content-center">
                                <img class="img-fluid rounded-circle" src="{{ asset('img/icon/great-bandung.jpg') }}" alt="Great Bandung" style="object-fit: cover; width: 100%; height: 100%; transform: scale(1.35);">
                            </div>
                            <h4 class="mb-3">Great Bandung</h4>
                            <p class="mb-4">Jl. Kalipah Apo No. 41 / Gg. Bahim No. 6, Kota Bandung</p>
                            <a class="btn btn-sm" href="{{ route('pengurus.katalog', 3) }}">Lihat</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3 bg-white shadow-sm overflow-hidden p-1 d-flex align-items-center justify-content-center">
                                <img class="img-fluid rounded-circle" src="{{ asset('img/icon/pengepul.svg') }}" alt="Pengepul" style="object-fit: contain; width: 100%; height: 100%;">
                            </div>
                            <h4 class="mb-3">Pengepul</h4>
                            <p class="mb-4">Kolektor / pegepul mitra</p>
                            <a class="btn btn-sm" href="{{ route('pengurus.katalog', 2) }}">Lihat</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3 bg-white shadow-sm overflow-hidden p-0 d-flex align-items-center justify-content-center">
                                <img class="img-fluid rounded-circle" src="{{ asset('img/icon/buyer-internal.jpg') }}" alt="Buyer Internal" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <h4 class="mb-3">Buyer Internal</h4>
                            <p class="mb-4">pengurus / nasabah bank sampah </p>
                            <a class="btn btn-sm" href="{{ route('pengurus.katalog', 4) }}">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pengepul -->
    <div class="modal fade" id="modalTambahPengepul" tabindex="-1" aria-labelledby="modalTambahPengepulLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="modalTambahPengepulLabel">
                        <i class="fas fa-truck text-primary"></i> Tambah Pengepul / Mitra
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambahPengepul" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body modal-body-custom">
                        <div class="mb-3">
                            <label class="form-label-custom" for="nama_pengepul">Nama Mitra / Pengepul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control-custom" id="nama_pengepul" name="nama" placeholder="Contoh: Bank Sampah Bersinar, UD Maju Jaya" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom" for="kategori_mitra">Kategori / Jenis Mitra <span class="text-danger">*</span></label>
                            <select class="form-select-custom" id="kategori_mitra" name="kategori" required>
                                <option value="" selected disabled>Pilih Kategori...</option>
                                <option value="Bank Sampah Induk">Bank Sampah Induk</option>
                                <option value="Pengepul">Pengepul</option>
                                <option value="Buyer Internal">Buyer Internal</option>
                                <option value="Mitra Lainnya">Mitra Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom" for="alamat_pengepul">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control-custom" id="alamat_pengepul" name="alamat" rows="2" placeholder="Alamat lengkap lokasi pengepul..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom" for="kontak_pengepul">No. Telepon / Kontak</label>
                            <input type="text" class="form-control-custom" id="kontak_pengepul" name="kontak" placeholder="Contoh: 081234567890">
                        </div>
                        <div class="mb-2">
                            <label class="form-label-custom" for="logo_pengepul">Foto / Logo</label>
                            <input type="file" class="form-control-custom" id="logo_pengepul" name="logo" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-custom">
                        <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn-custom btn-custom-primary" onclick="alert('Data pengepul berhasil disimpan!'); bootstrap.Modal.getInstance(document.getElementById('modalTambahPengepul')).hide();">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
