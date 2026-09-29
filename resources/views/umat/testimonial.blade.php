@extends('layouts.app')

@section('title', 'Testimoni - Berkah Sari')

@section('content')

    @include('layouts.page-header', ['pageTitle' => 'Testimoni', 'breadcrumbParent' => 'Halaman'])

    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Testimoni</p>
                <h1 class="display-5 mb-5">Apa Kata Klien Kami!</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Testimoni Klien</p>
                    <h1 class="display-5 mb-5">Apa Kata Mereka Tentang Kami!</h1>
                    <p class="mb-4">Kepercayaan dan kepuasan klien adalah prioritas utama kami. Setiap proyek dikerjakan dengan sepenuh hati untuk hasil yang memuaskan.</p>
                    <a class="btn btn-primary py-3 px-4" href="{{ route('contact') }}">Hubungi Kami</a>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="testimonial-item">
                            <img class="img-fluid rounded mb-3" src="{{ asset('img/testimonial-1.jpg') }}" alt="">
                            <p class="fs-5">"Berkah Sari mengubah halaman rumah kami menjadi taman impian yang indah. Tim mereka sangat profesional dan hasilnya melebihi ekspektasi!"</p>
                            <h4>Budi Santoso</h4>
                            <span>Pemilik Rumah di Jakarta</span>
                        </div>
                        <div class="testimonial-item">
                            <img class="img-fluid rounded mb-3" src="{{ asset('img/testimonial-2.jpg') }}" alt="">
                            <p class="fs-5">"Tim Berkah Sari sangat profesional, tepat waktu, dan hasilnya memuaskan. Taman kantor kami sekarang jauh lebih indah dan asri."</p>
                            <h4>Siti Rahayu</h4>
                            <span>Manager Perusahaan di Surabaya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

@endsection
