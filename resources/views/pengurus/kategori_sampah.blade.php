@extends('layouts.pengurus')

@section('title', 'Kategori Sampah - Berkah Sari')
@section('page-title', 'Kategori Sampah')


@section('content')

    <div class="container-xxl py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h4 class="mb-1 fw-bold" style="color: var(--dark); font-family: 'Jost', sans-serif;">Kategori Sampah</h4>
                    <p class="text-muted mb-0 small">Daftar kategori sampah yang dikelola</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 wow fadeInUp">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3 bg-white shadow-sm d-flex align-items-center justify-content-center">
                                <i class="fas fa-recycle fa-3x text-primary"></i>
                            </div>
                            <h4 class="mb-3">Bank Sampah</h4>
                            <p class="mb-4">Pengelolaan kategori sampah anorganik seperti plastik, kertas, kardus, botol kaca, dan logam.</p>
                            <a class="btn btn-sm" href="{{ route('pengurus.daftar-kategori', 'sampah') }}">Lihat</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3 bg-white shadow-sm d-flex align-items-center justify-content-center">
                                <i class="fas fa-oil-can fa-3x text-primary"></i>
                            </div>
                            <h4 class="mb-3">Minyak Jelantah</h4>
                            <p class="mb-4">Pengelolaan limbah minyak jelantah bekas pakai rumah tangga untuk didaur ulang.</p>
                            <a class="btn btn-sm" href="{{ route('pengurus.daftar-kategori', 'minyak-jelantah') }}">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
