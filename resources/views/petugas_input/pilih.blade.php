@extends('layouts.petugas_input')

@section('title', 'Pilih Jenis Input - Berkah Sari')
@section('page-title', 'Pilih Jenis')

@push('styles')
<style>
    .petugas-sidebar,
    .topbar-toggle,
    .topbar-search {
        display: none !important;
    }

    .petugas-main {
        margin-left: 0 !important;
    }

    .service-item {
        text-decoration: none;
    }

    .service-item .service-text {
        width: 100%;
    }

    .service-item .service-text h2 {
        color: var(--dark);
        transition: .3s;
    }

    .service-item:hover .service-text h2 {
        color: #FFFFFF !important;
    }
</style>
@endpush

@section('content')

    <div class="container-xxl py-5">
        <div class="container"></div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a href="{{ route('petugas.dashboard_bs') }}" class="service-item rounded d-flex h-100 text-decoration-none">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="{{ asset('img/service-1.jpg') }}" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <i class="fas fa-recycle fa-3x text-primary"></i>
                            </div>
                            <h2 class="mb-3">Bank Sampah</h2>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <a href="{{ route('petugas.dashboard_mijel') }}" class="service-item rounded d-flex h-100 text-decoration-none">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="{{ asset('img/service-2.jpg') }}" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <i class="fas fa-oil-can fa-3x text-primary"></i>
                            </div>
                            <h2 class="mb-3">Minyak Jelantah</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
