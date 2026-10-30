@extends('layouts.ketua')

@section('title', 'Bank Sampah Induk - Berkah Sari')
@section('page-title', 'Bank Sampah Induk')


@section('content')

    <div class="container-xxl py-5">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h4 class="mb-1 fw-bold" style="color: var(--dark); font-family: 'Jost', sans-serif;">Daftar Bank Sampah Induk & Pengepul</h4>
                    <p class="text-muted mb-0 small">Kelola data mitra bank sampah induk, pengepul, dan pembeli</p>
                </div>
                <button type="button" class="btn-add-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengepul" id="btnTambahPengepul">
                    <i class="fas fa-plus"></i> Tambah Bank Sampah Induk
                </button>
            </div>

            <div class="row g-4">
                @if(isset($daftar_pengepul) && $daftar_pengepul->isNotEmpty())
                    @foreach($daftar_pengepul as $p)
                        @php
                            $namaLower = strtolower($p->nama_pengepul);
                            $imgSrc = asset('img/icon/pengepul.svg');
                            $fitStyle = 'object-fit: contain; width: 100%; height: 100%;';

                            if (file_exists(public_path('img/icon/pengepul_' . $p->id_pengepul . '.jpg'))) {
                                $imgSrc = asset('img/icon/pengepul_' . $p->id_pengepul . '.jpg');
                            } elseif (file_exists(public_path('img/icon/pengepul_' . $p->id_pengepul . '.png'))) {
                                $imgSrc = asset('img/icon/pengepul_' . $p->id_pengepul . '.png');
                            } elseif (str_contains($namaLower, 'bersinar')) {
                                $imgSrc = asset('img/icon/bank-sampah-bersinar.jpg');
                            } elseif (str_contains($namaLower, 'great')) {
                                $imgSrc = asset('img/icon/great-bandung.jpg');
                                $fitStyle = 'object-fit: cover; width: 100%; height: 100%; transform: scale(1.35);';
                            } elseif (str_contains($namaLower, 'buyer')) {
                                $imgSrc = asset('img/icon/buyer-internal.jpg');
                                $fitStyle = 'object-fit: cover; width: 100%; height: 100%;';
                            }
                        @endphp
                        <div class="col-lg-4 col-md-6 wow fadeInUp">
                            <div class="service-item rounded d-flex h-100">
                                <div class="service-text rounded p-5">
                                    <div class="btn-square rounded-circle mx-auto mb-3 bg-white shadow-sm overflow-hidden p-2 d-flex align-items-center justify-content-center">
                                        <img class="img-fluid rounded-circle" src="{{ $imgSrc }}" alt="{{ $p->nama_pengepul }}" style="{{ $fitStyle }}">
                                    </div>
                                    <h4 class="mb-3">{{ $p->nama_pengepul }}</h4>
                                    <p class="mb-4 text-muted small">Mitra Bank Sampah Induk / Pengepul</p>
                                    <a class="btn btn-sm" href="{{ route('pengurus.katalog', $p->id_pengepul) }}">Lihat</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
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
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahPengepul" tabindex="-1" aria-labelledby="modalTambahPengepulLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 620px;">
            <div class="modal-content modal-card-custom">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <h5 class="card-title mb-0 d-flex align-items-center gap-2" id="modalTambahPengepulLabel" style="font-family: 'Jost', sans-serif; font-size: 1.15rem; color: var(--dark); font-weight: 700;">
                        <i class="fas fa-truck text-primary fs-5"></i>
                        <span>Tambah Bank Sampah Induk</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="formTambahPengepul" action="{{ route('pengurus.pengepul.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_pengepul" class="form-label-custom">Nama Bank Sampah Induk<span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="nama_pengepul" name="nama_pengepul" placeholder="Contoh: Bank Sampah Bersinar, UD Maju Jaya" value="{{ old('nama_pengepul') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_pengepul" class="form-label-custom">Keterangan <span class="badge bg-light text-muted border fw-normal ms-1">Opsional</span></label>
                        <textarea class="form-control-custom" id="alamat_pengepul" name="alamat" rows="2" placeholder="Contoh: isi dengan alamat atau keterangan lainnya">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="logo_pengepul" class="form-label-custom">Upload Logo <span class="badge bg-light text-muted border fw-normal ms-1">Tidak Wajib</span></label>
                        <input type="file" class="form-control-custom" id="logo_pengepul" name="logo" accept="image/*">
                        <span class="text-muted small">Format foto/logo: JPG, JPEG, PNG, atau SVG (Maks. 2MB). Tidak wajib diisi.</span>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <button type="button" class="btn-custom btn-custom-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-custom btn-custom-primary">
                            <i class="fas fa-save me-1"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var btnTambah = document.getElementById('btnTambahPengepul');
        var modalEl = document.getElementById('modalTambahPengepul');
        
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
