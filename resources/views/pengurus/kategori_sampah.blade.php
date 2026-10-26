@extends('layouts.pengurus')

@section('title', 'Kategori Sampah - Berkah Sari')
@section('page-title', 'Kategori Sampah')

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
