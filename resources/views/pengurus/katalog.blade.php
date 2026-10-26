@extends('layouts.pengurus')

@section('title', 'Katalog Harga - ' . $pengepul->nama_pengepul)
@section('page-title', 'Katalog Harga')

@push('styles')
<style>
    .katalog-header {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
    .katalog-title {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
        font-size: 1.25rem;
    }
    .katalog-sub {
        color: #6C7E75;
        font-size: .85rem;
        margin: 2px 0 0;
    }
    .table-card-custom {
        background: #fff;
        border-radius: 12px;
        border: 1px solid rgba(15,66,41,.08);
        box-shadow: 0 2px 8px rgba(15,66,41,.03);
        overflow: hidden;
    }
    .table-header-control {
        background: #fff;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid rgba(15,66,41,.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .table-search-box {
        position: relative;
        max-width: 260px;
        flex-grow: 1;
    }
    .table-search-input {
        width: 100%;
        padding: .45rem .9rem .45rem 2.2rem;
        font-size: .85rem;
        border-radius: 8px;
        border: 1px solid rgba(15,66,41,.12);
        background: #FDFDFD;
        font-family: 'Open Sans', sans-serif;
    }
    .table-search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(52,142,56,.08);
    }
    .table-search-icon {
        position: absolute;
        left: .75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6C7E75;
        font-size: .85rem;
    }
    .btn-action-custom {
        background: var(--primary);
        color: #fff;
        border: none;
        padding: .45rem 1rem;
        border-radius: 8px;
        font-size: .85rem;
        font-weight: 600;
        font-family: 'Jost', sans-serif;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all .2s;
    }
    .btn-action-custom:hover {
        background: var(--dark);
        color: #fff;
    }
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        vertical-align: middle;
    }
    .table-custom th, .table-custom td {
        padding: .85rem 1.25rem;
        border-bottom: 1px solid rgba(15,66,41,.05);
    }
    .table-custom th {
        background: #F8FAF9;
        color: #6C7E75;
        font-size: .75rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: .05em;
        border-bottom: 1px solid rgba(15,66,41,.08);
        white-space: nowrap;
    }
    .table-custom tbody tr:hover {
        background: rgba(52,142,56,.025);
    }
    .table-amount {
        font-weight: 700;
        color: var(--dark);
        font-family: 'Jost', sans-serif;
    }
    .table-btn-action {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: 1px solid rgba(15, 66, 41, 0.12);
        background-color: #fff;
        color: var(--dark);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all .2s;
    }
    .table-btn-action:hover {
        background-color: var(--primary);
        color: #fff;
        border-color: var(--primary);
    }
    .table-footer-control {
        background: #fff;
        padding: .85rem 1.25rem;
        border-top: 1px solid rgba(15,66,41,.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: .83rem;
        color: #6C7E75;
    }
</style>
@endpush

@section('content')

<div class="katalog-header">
    <div>
        <h4 class="katalog-title">Katalog Harga - {{ $pengepul->nama_pengepul }}</h4>
        <p class="katalog-sub">Daftar harga jual sampah untuk mitra ini</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <select class="form-select form-select-sm" style="width: auto; border-radius: 8px; font-size: .85rem;" onchange="location = this.value;">
            @foreach($daftar_pengepul as $dp)
                <option value="{{ route('pengurus.katalog', $dp->id_pengepul) }}" {{ $dp->id_pengepul == $pengepul->id_pengepul ? 'selected' : '' }}>
                    {{ $dp->nama_pengepul }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="table-card-custom">
    <div class="table-header-control">
        <div class="table-search-box">
            <i class="bi bi-search table-search-icon"></i>
            <input type="text" class="table-search-input" id="searchKatalog" placeholder="Cari jenis sampah...">
        </div>
        <div class="text-muted small">
            <i class="fas fa-calendar-alt me-1 text-primary"></i> Periode: <strong>{{ $katalog->first()->periode ?? '-' }}</strong>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-custom" id="tblKatalog">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Jenis Sampah</th>
                    <th>Satuan</th>
                    <th>Harga Jual</th>
                    <th>Periode</th>
                    <th class="text-center" style="width: 70px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($katalog as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold text-dark">{{ $item->jenis }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td class="table-amount">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $item->periode }}</td>
                        <td class="text-center">
                            <a href="#" class="table-btn-action" title="Edit"><i class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada data harga untuk mitra ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="table-footer-control">
        <span id="infoTotal">Menampilkan {{ count($katalog) }} data</span>
        <span>Mitra: <strong>{{ $pengepul->nama_pengepul }}</strong></span>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('searchKatalog').addEventListener('keyup', function() {
        let val = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tblKatalog tbody tr');
        let visible = 0;
        rows.forEach(function(r) {
            let text = r.innerText.toLowerCase();
            if (text.includes(val)) {
                r.style.display = '';
                visible++;
            } else {
                r.style.display = 'none';
            }
        });
        document.getElementById('infoTotal').innerText = 'Menampilkan ' + visible + ' data';
    });
</script>
@endpush

@endsection
