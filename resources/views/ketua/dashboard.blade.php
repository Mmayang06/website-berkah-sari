@extends('layouts.ketua')

@section('title', 'Dashboard Ketua - Silih Asih')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .db-wrap { display: flex; flex-direction: column; gap: 24px; }

    .top-row { display: flex; flex-direction: column; gap: 20px; }
    .metric-row { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; }

    .metric-card {
        background: #fff;
        border-radius: 12px;
        padding: 22px 20px;
        box-shadow: 0 2px 20px rgba(0,0,0,.06);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 170px;
        position: relative;
    }
    .metric-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    .metric-label {
        color: var(--secondary);
        font-size: 0.8rem;
        font-weight: 500;
    }
    .metric-value {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        font-size: 1.6rem;
        color: var(--dark);
        line-height: 1;
        margin: 10px 0 6px;
    }
    .metric-change {
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .metric-change.up { color: var(--primary); }

    .mid-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

    .chart-card {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 20px rgba(0,0,0,.06);
    }
    .card-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 4px;
    }
    .card-title {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        color: var(--dark);
        margin: 0;
    }
    .card-subtitle {
        font-size: 0.75rem;
        color: var(--secondary);
        margin: 0;
    }
    .legend-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 4px;
    }
    .chart-legend {
        display: flex;
        gap: 16px;
        font-size: 0.75rem;
        color: var(--secondary);
        align-items: center;
    }

    .bar-chart-wrap { margin-top: 20px; }
    .bar-group-row {
        display: flex;
        align-items: flex-end;
        gap: 8px;
        height: 160px;
        border-bottom: 1px solid #f0f5f0;
        padding-bottom: 0;
    }
    .bar-group {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
        height: 100%;
        justify-content: flex-end;
    }
    .bars { display: flex; gap: 3px; align-items: flex-end; }
    .bar {
        width: 12px;
        border-radius: 3px 3px 0 0;
        transition: opacity .2s;
    }
    .bar:hover { opacity: .75; }
    .bar.b1 { background: var(--dark); }
    .bar.b2 { background: var(--primary); }
    .bar-label { font-size: 0.68rem; color: #aab4ab; margin-top: 5px; }

    .tbl-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 20px rgba(0,0,0,.06);
        overflow: hidden;
    }
    .tbl-head {
        padding: 18px 22px;
        border-bottom: 1px solid #f0f5f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .tbl-title {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--dark);
        margin: 0;
    }

    table.dash-tbl { width: 100%; border-collapse: collapse; }
    table.dash-tbl th {
        padding: 10px 16px;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: #aab4ab;
        border-bottom: 1px solid #f0f5f0;
        text-align: left;
    }
    table.dash-tbl td {
        padding: 11px 16px;
        font-size: 0.83rem;
        color: var(--secondary);
        border-bottom: 1px solid #f0f5f0;
        vertical-align: middle;
    }
    table.dash-tbl tr:last-child td { border-bottom: none; }
    table.dash-tbl tbody tr:hover td { background: #fafff8; }
    .tbl-strong { font-weight: 600; color: var(--dark); }
    .tbl-num { font-family: 'Jost', sans-serif; font-weight: 600; color: var(--dark); }

    .empty-ph {
        padding: 36px;
        text-align: center;
        color: #ccc;
        font-size: 0.83rem;
    }

    @media (max-width: 1200px) {
        .metric-row { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
        .metric-row { grid-template-columns: 1fr; }
        .mid-row { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
@php
    $minyak = $koleksi->total_minyak ?? 0;
    $sampah = $koleksi->total_sampah ?? 0;
@endphp

<div class="db-wrap">

    <div class="top-row">
        <div class="metric-row">
            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-label">Total Minyak Jelantah</span>
                </div>
                <div class="metric-value">
                    {{ number_format($minyak, 1, ',', '.') }}
                    <span style="font-size:1rem;font-weight:500;color:var(--secondary)"> L</span>
                </div>
                <div class="metric-change up">
                    <i class="fas fa-tint" style="font-size:.65rem"></i>
                    Dari seluruh setoran donatur
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-label">Total Sampah</span>
                </div>
                <div class="metric-value">
                    {{ number_format($sampah, 1, ',', '.') }}
                    <span style="font-size:1rem;font-weight:500;color:var(--secondary)"> kg</span>
                </div>
                <div class="metric-change up">
                    <i class="fas fa-recycle" style="font-size:.65rem"></i>
                    Dari seluruh setoran donatur
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-label">Uang Bersih Diterima</span>
                </div>
                <div class="metric-value" style="font-size:1.35rem;">
                    Rp&nbsp;{{ number_format($bersih, 0, ',', '.') }}
                </div>
                <div class="metric-change up">
                    <i class="fas fa-check-circle" style="font-size:.65rem"></i>
                    Setelah potongan biaya operasional
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-label">Biaya Operasional</span>
                </div>
                <div class="metric-value" style="font-size:1.35rem;">
                    Rp&nbsp;{{ number_format($ops, 0, ',', '.') }}
                </div>
                <div class="metric-change up">
                    <i class="fas fa-cogs" style="font-size:.65rem"></i>
                    Total pengeluaran operasional
                </div>
            </div>

            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-label">Tabungan Lingkungan</span>
                </div>
                <div class="metric-value" style="font-size:1.35rem;">
                    Rp&nbsp;{{ number_format($tabungan_lingkungan, 0, ',', '.') }}
                </div>
                <div class="metric-change up">
                    <i class="fas fa-wallet" style="font-size:.65rem"></i>
                    Total tabungan seluruh lingkungan
                </div>
            </div>
        </div>
    </div>

    <div class="mid-row">
        <div class="chart-card">
            <div class="card-head">
                <div>
                    <p class="card-title">Statistik Bank Sampah dan Minyak Jelantah</p>
                    <p class="card-subtitle">Perbandingan sampah &amp; minyak jelantah</p>
                </div>
                <div class="chart-legend">
                    <span><span class="legend-dot" style="background:var(--dark)"></span>Sampah</span>
                    <span><span class="legend-dot" style="background:var(--primary)"></span>Minyak</span>
                </div>
            </div>

            <div class="bar-chart-wrap">
                @php
                    $bulan_labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags'];
                    $dummy_s = [40,55,35,70,60,45,20,10];
                    $dummy_m = [20,30,25,45,35,28,12,5];
                    $max_v   = max(array_merge($dummy_s, $dummy_m));
                @endphp
                <div class="bar-group-row">
                    @foreach($bulan_labels as $i => $bl)
                    <div class="bar-group">
                        <div class="bars">
                            <div class="bar b1" style="height: {{ round($dummy_s[$i]/$max_v * 140) }}px"
                                title="Sampah {{ $dummy_s[$i] }} kg"></div>
                            <div class="bar b2" style="height: {{ round($dummy_m[$i]/$max_v * 140) }}px"
                                title="Minyak {{ $dummy_m[$i] }} L"></div>
                        </div>
                        <span class="bar-label">{{ $bl }}</span>
                    </div>
                    @endforeach
                </div>
                <div style="margin-top:10px;display:flex;gap:10px;font-size:.72rem;color:#aab4ab;font-family:'Jost',sans-serif;">
                    <span>Total sampah: <strong style="color:var(--dark)">{{ number_format($sampah,1,',','.') }} kg</strong></span>
                    <span>&bull;</span>
                    <span>Total minyak: <strong style="color:var(--primary)">{{ number_format($minyak,1,',','.') }} L</strong></span>
                </div>
            </div>
        </div>

        <div class="tbl-card">
            <div class="tbl-head">
                <p class="tbl-title">Setoran Terbaru</p>
                <span style="color:#bbb; font-size:1.1rem;">···</span>
            </div>
            @if(count($setoran_terbaru) > 0)
            <table class="dash-tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Donatur</th>
                        <th>Tanggal</th>
                        <th style="text-align:right">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($setoran_terbaru as $s)
                    <tr>
                        <td class="tbl-strong">#{{ $s->id_setoran }}</td>
                        <td>
                            {{ $s->nama_donatur }}
                            <div style="font-size:.7rem;color:#aab4ab">{{ $s->nama_lingkungan }}</div>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($s->tanggal)->locale('id')->isoFormat('D MMM YY') }}</td>
                        <td style="text-align:right" class="tbl-num">Rp&nbsp;{{ number_format($s->total_nilai,0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-ph">
                <i class="fas fa-inbox" style="display:block;font-size:1.8rem;opacity:.25;margin-bottom:8px;color:var(--primary)"></i>
                Belum ada data setoran.
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
