@extends('layouts.app')

@section('title', 'Hubungi Kami - Berkah Sari')

@section('content')

    @include('layouts.page-header', ['pageTitle' => 'Hubungi Kami', 'breadcrumbParent' => 'Halaman'])

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Hubungi Kami</p>
                <h1 class="display-5 mb-5">Kami Siap Membantu Anda</h1>
            </div>
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center bg-light rounded p-4">
                        <div class="btn-lg-square bg-primary rounded-circle me-3">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold">Alamat</p>
                            <p class="mb-0">Jl. Contoh No. 123, Jakarta, Indonesia</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center bg-light rounded p-4">
                        <div class="btn-lg-square bg-primary rounded-circle me-3">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold">Telepon</p>
                            <p class="mb-0">+012 345 67890</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center bg-light rounded p-4">
                        <div class="btn-lg-square bg-primary rounded-circle me-3">
                            <i class="fa fa-envelope text-white"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold">Email</p>
                            <p class="mb-0">info@berkahsari.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded p-4 p-sm-5">
                        <h1 class="display-6 mb-4">Kirim Pesan</h1>
                        <form action="#" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-white border-0" id="cname" name="name" placeholder="Nama Anda">
                                        <label for="cname">Nama Anda</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-white border-0" id="cemail" name="email" placeholder="Email Anda">
                                        <label for="cemail">Email Anda</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-white border-0" id="csubject" name="subject" placeholder="Subjek">
                                        <label for="csubject">Subjek</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-white border-0" placeholder="Pesan" id="cmessage" name="message" style="height: 150px"></textarea>
                                        <label for="cmessage">Pesan</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary py-3 px-4" type="submit">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="rounded overflow-hidden" style="height: 100%; min-height: 400px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5210498750895!2d106.82716531476882!3d-6.194668895509814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f42d3a8939d7%3A0x45bde6bf37c97f64!2sMonumen%20Nasional!5e0!3m2!1sid!2sid!4v1627987842049!5m2!1sid!2sid"
                            width="100%"
                            height="100%"
                            style="border:0; min-height: 400px;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection
