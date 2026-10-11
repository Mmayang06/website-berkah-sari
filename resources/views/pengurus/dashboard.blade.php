@extends('layouts.pengurus')

@section('title', 'Dashboard Pengurus - Berkah Sari')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .db-wrap { display: flex; flex-direction: column; gap: 24px; }

    .top-row { display: flex; flex-direction: column; gap: 20px; }
    .metric-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }

    .hero-card {
        background: var(--dark);
        border-radius: 12px;
        padding: 28px 26px;
        position: relative;
        overflow: hidden;
        min-height: 190px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .hero-card::before {
        content: '✱';
        position: absolute;
        right: -10px;
        bottom: -20px;
        font-size: 9rem;
        color: var(--primary);
        opacity: .35;
        line-height: 1;
        pointer-events: none;
    }
    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--primary);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
        width: fit-content;
        margin-bottom: 10px;
    }
    .hero-tag span { width: 6px; height: 6px; background: #fff; border-radius: 50%; }
    .hero-date { color: rgba(232,245,233,.45); font-size: 0.72rem; margin-bottom: 8px; }
    .hero-title {
        color: #fff;
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        font-size: 1.2rem;
        line-height: 1.3;
        margin: 0 0 18px;
    }
    .hero-link {
        color: var(--primary);
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .hero-link:hover { color: #6fcf72; }

    .metric-card {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 20px rgba(0,0,0,.06);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 190px;
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
    .metric-dots { color: #ccc; font-size: 1.1rem; letter-spacing: 2px; cursor: default; }
    .metric-value {
        font-family: 'Jost', sans-serif;
        font-weight: 700;
        font-size: 1.85rem;
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
    .metric-change.down { color: #d9534f; }
    .metric-mini-chart {
        height: 48px;
        border-radius: 4px;
        overflow: hidden;
        margin-top: 12px;
    }
    .metric-mini-chart svg { width: 100%; height: 100%; }

    /* ── middle row: chart + donut ─── */
    .mid-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

    .chart-card, .donut-card {
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

    .donut-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 16px;
    }
    .donut-wrap svg { overflow: visible; }
    .donut-legends { margin-top: 20px; width: 100%; }
    .donut-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #f0f5f0;
        font-size: 0.8rem;
    }
    .donut-item:last-child { border-bottom: none; }
    .donut-item-label { display: flex; align-items: center; gap: 8px; color: var(--secondary); }
    .donut-item-val { font-family: 'Jost', sans-serif; font-weight: 700; color: var(--dark); font-size: 0.85rem; }
    .d-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

    /* ── bottom row: tabel ─── */
    .bot-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

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
    .tbl-more { color: #bbb; font-size: 1.1rem; letter-spacing: 2px; cursor: default; }

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

    .keuangan-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        border-bottom: 1px solid #f0f5f0;
    }
    .keu-item {
        padding: 18px 20px;
        border-right: 1px solid #f0f5f0;
    }
    .keu-item:last-child { border-right: none; }
    .keu-label { font-size: 0.72rem; color: #aab4ab; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 6px; }
    .keu-val { font-family: 'Jost', sans-serif; font-weight: 700; font-size: 1.1rem; color: var(--dark); }
    .keu-val.minus { color: #d9534f; }
    .keu-val.plus { color: #348E38; }

    .empty-ph {
        padding: 36px;
        text-align: center;
        color: #ccc;
        font-size: 0.83rem;
    }

    @media (max-width: 1100px) {
        .metric-row { grid-template-columns: 1fr 1fr; }
        .mid-row { grid-template-columns: 1fr; }
        .bot-row { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .top-row { grid-template-columns: 1fr; }
        .keuangan-row { grid-template-columns: 1fr; }
        .keu-item { border-right: none; border-bottom: 1px solid #f0f5f0; }
    }
</style>
@endpush

@section('content')
@php
    $minyak     = $koleksi->total_minyak ?? 0;
    $sampah     = $koleksi->total_sampah ?? 0;
    $kotor      = $keuangan->total_kotor ?? 0;
    $ops        = $keuangan->total_operasional ?? 0;
    $bersih     = $keuangan->total_bersih ?? 0;
    $bulan      = now()->locale('id')->isoFormat('MMMM YYYY');
    $tgl        = now()->locale('id')->isoFormat('D MMMM YYYY');

    $total_material = $minyak + $sampah;
    $pct_minyak = $total_material > 0 ? round($minyak / $total_material * 100) : 0;
    $pct_sampah = $total_material > 0 ? round($sampah / $total_material * 100) : 0;
    $pct_ops    = $kotor > 0 ? round($ops / $kotor * 100) : 10;
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
                <div class="metric-value" style="font-size:1.45rem;">
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
                <div class="metric-value" style="font-size:1.45rem;">
                    Rp&nbsp;{{ number_format($ops, 0, ',', '.') }}
                </div>
                <div class="metric-change up">
                    <i class="fas fa-cogs" style="font-size:.65rem"></i>
                    10% dari total penjualan kotor
                </div>
            </div>
        </div>
    </div>

    <div class="mid-row">
        <div class="chart-card">
            <div class="card-head">
                <div>
                    <p class="card-title">Statistik Bank Sampah dan Minyak Jelantah</p>
                    <p class="card-subtitle">
                        Perbandingan sampah &amp; minyak jelantah
                    </p>
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
                <span class="tbl-more">···</span>
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
            <div class="empty-ph"><i class="fas fa-inbox" style="display:block;font-size:1.8rem;opacity:.25;margin-bottom:8px;color:var(--primary)"></i>Belum ada data setoran.</div>
            @endif
        </div>
    </div>

</div>
@endsection
