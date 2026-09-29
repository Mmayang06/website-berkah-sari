@extends('layouts.app')

@section('title', 'Penawaran Gratis - Berkah Sari')

@section('content')

    @include('layouts.page-header', ['pageTitle' => 'Penawaran Gratis', 'breadcrumbParent' => 'Halaman'])

    <!-- Quote Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Penawaran Gratis</p>
                    <h1 class="display-5 mb-4">Dapatkan Penawaran Terbaik dari Kami</h1>
                    <p class="mb-4">Isi formulir di sebelah kanan dan tim kami akan segera menghubungi Anda untuk memberikan penawaran terbaik sesuai kebutuhan taman Anda.</p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="btn-lg-square bg-primary rounded-circle me-3">
                            <i class="fa fa-phone text-white"></i>
                        </div>
                        <div>
                            <p class="mb-0">Hubungi Kami</p>
                            <h5 class="mb-0">+012 345 67890</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="btn-lg-square bg-primary rounded-circle me-3">
                            <i class="fa fa-envelope text-white"></i>
                        </div>
                        <div>
                            <p class="mb-0">Email Kami</p>
                            <h5 class="mb-0">info@berkahsari.com</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded p-4 p-sm-5">
                        <h1 class="display-5 text-center mb-5">Minta Penawaran Gratis</h1>
                        <form action="#" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-white border-0" id="gname" name="name" placeholder="Nama Anda">
                                        <label for="gname">Nama Anda</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-white border-0" id="gmail" name="email" placeholder="Email Anda">
                                        <label for="gmail">Email Anda</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-white border-0" id="cname" name="phone" placeholder="No. HP">
                                        <label for="cname">No. HP</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <select class="form-select bg-white border-0" id="cage" name="service">
                                            <option value="">Pilih Layanan</option>
                                            <option value="landscaping">Landscaping</option>
                                            <option value="pruning">Pemangkasan Tanaman</option>
                                            <option value="irrigation">Irigasi &amp; Drainase</option>
                                            <option value="maintenance">Pemeliharaan Taman</option>
                                            <option value="green">Green Technology</option>
                                            <option value="urban">Urban Gardening</option>
                                        </select>
                                        <label for="cage">Jenis Layanan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-white border-0" placeholder="Pesan" id="message" name="message" style="height: 100px"></textarea>
                                        <label for="message">Pesan</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary py-3 px-4" type="submit">Kirim Sekarang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->

@endsection
