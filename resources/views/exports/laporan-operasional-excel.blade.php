<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        table { border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; }
        th { background-color: #348E38; color: #ffffff; border: 1px solid #444; padding: 8px; font-weight: bold; }
        td { border: 1px solid #999; padding: 6px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bg-total { background-color: #E8F5E9; font-weight: bold; }
        .title { font-size: 14pt; font-weight: bold; color: #0F4229; }
        .sub { font-size: 10pt; color: #555; }
    </style>
</head>
<body>
    <table>
        <tr>
            <td colspan="{{ $tipe === 'triwulan' ? '6' : '4' }}" class="title">REKAP BIAYA OPERASIONAL BERKAH SARI</td>
        </tr>
        <tr>
            <td colspan="{{ $tipe === 'triwulan' ? '6' : '4' }}" class="sub">Periode: {{ $labelPeriode }}</td>
        </tr>
        <tr>
            <td colspan="{{ $tipe === 'triwulan' ? '6' : '4' }}"></td>
        </tr>
    </table>

    <table>
        <thead>
            @if($tipe === 'triwulan')
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Keterangan Pengeluaran</th>
                    <th>{{ $namaBulan[0] }} (Rp)</th>
                    <th>{{ $namaBulan[1] }} (Rp)</th>
                    <th>{{ $namaBulan[2] }} (Rp)</th>
                    <th>Jumlah Total (Rp)</th>
                </tr>
            @else
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Tanggal Pengeluaran</th>
                    <th>Keterangan</th>
                    <th>Biaya Keluar (Rp)</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @forelse($items as $i => $row)
                @if($tipe === 'triwulan')
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $row->keterangan }}</td>
                        <td class="text-right">{{ number_format($row->bulan_1, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($row->bulan_2, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($row->bulan_3, 0, ',', '.') }}</td>
                        <td class="text-right" style="font-weight: bold;">{{ number_format($row->total_biaya, 0, ',', '.') }}</td>
                    </tr>
                @else
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($row->tanggal_keluar)->format('d/m/Y') }}</td>
                        <td>{{ $row->keterangan }}</td>
                        <td class="text-right">{{ number_format($row->biaya_keluar, 0, ',', '.') }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="{{ $tipe === 'triwulan' ? '6' : '4' }}" class="text-center">Tidak ada data untuk periode ini</td>
                </tr>
            @endforelse
        </tbody>
        @if(count($items) > 0)
        <tfoot>
            @if($tipe === 'triwulan')
                <tr class="bg-total">
                    <td colspan="2" class="text-center">TOTAL</td>
                    <td class="text-right">{{ number_format($items->sum('bulan_1'), 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($items->sum('bulan_2'), 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($items->sum('bulan_3'), 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($totalBiaya, 0, ',', '.') }}</td>
                </tr>
            @else
                <tr class="bg-total">
                    <td colspan="3" class="text-center">TOTAL</td>
                    <td class="text-right">{{ number_format($totalBiaya, 0, ',', '.') }}</td>
                </tr>
            @endif
        </tfoot>
        @endif
    </table>
</body>
</html>

