@extends('layouts.petugas_input')

@section('title', 'Input Minyak Jelantah - Berkah Sari')
@section('brand_title', 'Berkah Sari Minyak Jelantah')
@section('page-title', 'Input Minyak Jelantah')

@section('topbar_action')
    <a href="{{ route('petugas.dashboard_bs') }}" class="btn-switch-module" title="Pindah ke Bank Sampah">
        <i class="fas fa-recycle icon-module"></i>
        <span>Pindah ke Bank Sampah</span>
        <i class="fas fa-exchange-alt ms-1 text-muted" style="font-size:0.75rem;"></i>
    </a>
    <a href="{{ route('petugas.pilih') }}" class="btn btn-sm btn-outline-secondary d-none d-md-inline-flex align-items-center gap-1" style="border-radius: 50px; font-size: 0.8rem; font-weight: 600; padding: 6px 14px;">
        <i class="fas fa-th-large"></i> Menu
    </a>
@endsection

@section('content')

<div style="margin-bottom: 20px;">
    <h4 style="font-family:'Jost',sans-serif; font-weight:700; color:var(--dark); margin:0 0 4px; font-size:1.25rem;">
        Input Minyak Jelantah
    </h4>
    <p style="color:#6C7E75; font-size:.85rem; margin:0;">
        Input setoran minyak jelantah donatur hari ini ({{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}).
    </p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="summary-card">
            <div class="summary-label">Total Transaksi Hari Ini</div>
            <div class="summary-value" id="rekap-transaksi">{{ $rekapHariIni->total_transaksi }}</div>
            <div class="summary-unit">Setoran masuk</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="summary-card">
            <div class="summary-label">Total Volume Minyak</div>
            <div class="summary-value text-primary">
                <span id="rekap-berat">{{ number_format($rekapHariIni->total_berat, 2, ',', '.') }}</span>
                <span style="font-size:1rem; font-weight:500; color:var(--secondary)">Liter</span>
            </div>
            <div class="summary-unit">Total liter terkumpul hari ini</div>
        </div>
    </div>
</div>

<div id="alertBox" style="display: none;" class="mb-3"></div>

<div class="row g-4">
    <div class="col-12 col-lg-5">
        <div class="card border-light shadow-sm p-4">
            <h5 class="card-title mb-4" style="font-family:'Jost',sans-serif; font-weight:700; color:var(--dark);">
                Form Input Minyak Jelantah
            </h5>

            <form id="formQuickEntry">
                @csrf
                <div class="mb-3">
                    <label for="input-tanggal" class="form-label-custom">Tanggal Setoran</label>
                    <input type="date" class="form-control-custom" id="input-tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label for="select-lingkungan" class="form-label-custom">Lingkungan</label>
                    <select class="form-select-custom" id="select-lingkungan" name="id_lingkungan" required autofocus>
                        <option value="">Pilih Lingkungan</option>
                        @foreach($daftarLingkungan as $l)
                            <option value="{{ $l->id_lingkungan }}">{{ $l->nama_lingkungan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="select-kategori" class="form-label-custom">Jenis Minyak</label>
                    <select class="form-select-custom" id="select-kategori" name="id_kategori" required>
                        <option value="" data-satuan="Liter">Pilih Jenis Minyak</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id_kategori }}" data-satuan="{{ $k->satuan }}" {{ $loop->first ? 'selected' : '' }}>
                                {{ $k->jenis }} ({{ $k->satuan }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="input-berat" class="form-label-custom">Volume Minyak (<span id="lbl-satuan">Liter</span>)</label>
                    <input type="number" step="0.01" min="0.01" class="form-control-custom" id="input-berat" name="berat" placeholder="Masukkan volume (contoh: 5.0)" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 mt-2" id="btnSimpan" style="font-family:'Jost',sans-serif; font-weight:600; border-radius:8px;">
                    Simpan Setoran
                </button>
            </form>
        </div>
    </div>

    <div class="col-12 col-lg-7">
        <div class="card border-light shadow-sm p-4">
            <h5 class="card-title mb-4" style="font-family:'Jost',sans-serif; font-weight:700; color:var(--dark);">
                Daftar Setoran Hari Ini
            </h5>

            <div class="table-responsive">
                <table class="table-custom" id="tblSetoranHariIni">
                    <thead>
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>Lingkungan</th>
                            <th>Jenis Minyak</th>
                            <th style="text-align: right;">Volume</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($setoranHariIni as $i => $row)
                            <tr id="row-{{ $row->id_setoran }}">
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $row->nama_lingkungan }}</div>
                                </td>
                                <td>{{ $row->jenis_sampah }}</td>
                                <td style="text-align: right;" class="fw-bold">
                                    {{ number_format($row->berat, 2, ',', '.') }} {{ $row->satuan }}
                                </td>
                            </tr>
                        @empty
                            <tr id="row-empty">
                                <td colspan="4" class="text-center py-4 text-muted">
                                    Belum ada data setoran hari ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('#select-kategori').on('change', function() {
        var satuan = $('#select-kategori option:selected').data('satuan') || 'Liter';
        $('#lbl-satuan').text(satuan);
    });

    function showNotif(pesan, tipe) {
        var html = `
            <div class="alert alert-${tipe} alert-dismissible fade show" role="alert">
                ${pesan}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        $('#alertBox').html(html).slideDown(200);
        setTimeout(function() {
            $('#alertBox').slideUp(300);
        }, 3000);
    }

    $('#formQuickEntry').on('submit', function(e) {
        e.preventDefault();

        var btn = $('#btnSimpan');
        btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "{{ route('petugas.store') }}",
            type: "POST",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(res) {
                btn.prop('disabled', false).text('Simpan Setoran');

                if (res.status === 'success') {
                    $('#row-empty').remove();

                    var barisBaru = `
                        <tr id="row-${res.data.id_setoran}">
                            <td>•</td>
                            <td>
                                <div class="fw-bold text-dark">${res.data.nama_lingkungan}</div>
                            </td>
                            <td>${res.data.jenis_sampah}</td>
                            <td style="text-align: right;" class="fw-bold">${res.data.berat} ${res.data.satuan}</td>
                        </tr>
                    `;

                    $('#tblSetoranHariIni tbody').prepend(barisBaru);

                    $('#rekap-transaksi').text(res.rekap.total_transaksi);
                    $('#rekap-berat').text(res.rekap.total_berat);

                    $('#input-berat').val('');
                    $('#select-lingkungan').focus();

                    showNotif(res.message, 'success');
                }
            },
            error: function(xhr) {
                btn.prop('disabled', false).text('Simpan Setoran');
                var err = 'Gagal menyimpan data setoran.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    err = xhr.responseJSON.message;
                }
                showNotif(err, 'danger');
            }
        });
    });
</script>
@endpush
