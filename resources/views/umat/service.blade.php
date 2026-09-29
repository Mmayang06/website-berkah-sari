@extends('layouts.app')

@section('title', 'Layanan Kami - Berkah Sari')

@section('content')

    @include('layouts.page-header', ['pageTitle' => 'Layanan Kami', 'breadcrumbParent' => 'Halaman'])

    <!-- Services Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Layanan Kami</p>
                <h1 class="display-5 mb-5">Layanan yang Kami Tawarkan untuk Anda</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="{{ asset('img/service-1.jpg') }}" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('img/icon/icon-3.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Landscaping</h4>
                            <p class="mb-4">Desain dan penataan taman yang estetik sesuai selera dan anggaran Anda.</p>
                            <a class="btn btn-sm" href="{{ route('quote') }}"><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="{{ asset('img/service-2.jpg') }}" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('img/icon/icon-6.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Pemangkasan Tanaman</h4>
                            <p class="mb-4">Perawatan dan pemangkasan tanaman secara rutin dan profesional.</p>
                            <a class="btn btn-sm" href="{{ route('quote') }}"><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="{{ asset('img/service-3.jpg') }}" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('img/icon/icon-5.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Irigasi &amp; Drainase</h4>
                            <p class="mb-4">Sistem pengairan modern untuk taman yang selalu hijau dan sehat.</p>
                            <a class="btn btn-sm" href="{{ route('quote') }}"><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="{{ asset('img/service-4.jpg') }}" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('img/icon/icon-4.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Pemeliharaan Taman</h4>
                            <p class="mb-4">Jasa pemeliharaan taman berkala untuk menjaga keindahan taman Anda.</p>
                            <a class="btn btn-sm" href="{{ route('quote') }}"><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="{{ asset('img/service-5.jpg') }}" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('img/icon/icon-8.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Green Technology</h4>
                            <p class="mb-4">Teknologi hijau ramah lingkungan untuk taman modern dan berkelanjutan.</p>
                            <a class="btn btn-sm" href="{{ route('quote') }}"><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="{{ asset('img/service-6.jpg') }}" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('img/icon/icon-2.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Urban Gardening</h4>
                            <p class="mb-4">Solusi berkebun di lahan terbatas untuk kawasan perkotaan.</p>
                            <a class="btn btn-sm" href="{{ route('quote') }}"><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

@endsection
