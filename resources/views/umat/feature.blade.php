@extends('layouts.app')

@section('title', 'Fitur - Berkah Sari')

@section('content')

    @include('layouts.page-header', ['pageTitle' => 'Fitur', 'breadcrumbParent' => 'Halaman'])

    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Kenapa Memilih Kami!</p>
                    <h1 class="display-5 mb-4">Alasan Mengapa Kami Dipercaya Banyak Klien</h1>
                    <p class="mb-4">Berkah Sari hadir dengan standar layanan tertinggi, menggunakan peralatan modern dan tim bersertifikat untuk memberikan hasil terbaik bagi taman Anda.</p>
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check bg-light text-primary rounded me-3 p-1"></i>
                                <span>Harga Transparan</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check bg-light text-primary rounded me-3 p-1"></i>
                                <span>Tim Profesional</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check bg-light text-primary rounded me-3 p-1"></i>
                                <span>Garansi Pekerjaan</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check bg-light text-primary rounded me-3 p-1"></i>
                                <span>Layanan 24/7</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check bg-light text-primary rounded me-3 p-1"></i>
                                <span>Ramah Lingkungan</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check bg-light text-primary rounded me-3 p-1"></i>
                                <span>Peralatan Modern</span>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-4 mt-4" href="{{ route('quote') }}">Minta Penawaran</a>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                            <div class="row g-4">
                                <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                        <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                                            <i class="fa fa-check fa-3x text-primary"></i>
                                        </div>
                                        <h4 class="mb-0">100% Kepuasan</h4>
                                    </div>
                                </div>
                                <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                    <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                        <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                                            <i class="fa fa-users fa-3x text-primary"></i>
                                        </div>
                                        <h4 class="mb-0">Tim Berdedikasi</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                            <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                                    <i class="fa fa-tools fa-3x text-primary"></i>
                                </div>
                                <h4 class="mb-0">Peralatan Modern</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

@endsection
