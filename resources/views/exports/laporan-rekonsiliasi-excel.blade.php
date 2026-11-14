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
            <td colspan="7" class="title">LAPORAN ARUS KAS (CASH FLOW) BANK SAMPAH SILIH ASIH</td>
        </tr>
        <tr>
            <td colspan="7" class="sub">Periode: {{ $labelPeriode }}</td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold; background-color: #f0f0f0;">Ringkasan Posisi Kas:</td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="3">Total Saldo Kas Bank Sampah (Di Bank)</td>
            <td colspan="4" class="text-right" style="font-weight: bold;">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="3">Hak Tabungan Lingkungan (Titipan Tabungan)</td>
            <td colspan="4" class="text-right" style="font-weight: bold; color: #2e7d32;">Rp {{ number_format($hakTabunganLingkungan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="3">Kas Bersih Bank Sampah (Dana Bebas Paroki)</td>
            <td colspan="4" class="text-right" style="font-weight: bold;">Rp {{ number_format($kasBersihParoki, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th>Tanggal</th>
                <th>Keterangan Transaksi</th>
                <th>Kategori</th>
                <th>Masuk (Rp)</th>
                <th>Keluar (Rp)</th>
                <th>Saldo Kas (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr style="background-color: #f9f9f9;">
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td style="font-weight: bold;">Saldo Awal Periode</td>
                <td class="text-center">Saldo Awal</td>
                <td class="text-right">-</td>
                <td class="text-right">-</td>
                <td class="text-right" style="font-weight: bold;">{{ number_format($saldoAwal, 0, ',', '.') }}</td>
            </tr>
            @forelse($mutasi as $i => $row)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center">{{ $row['tanggal'] }}</td>
                    <td>{{ $row['keterangan'] }}</td>
                    <td class="text-center">{{ $row['kategori'] }}</td>
                    <td class="text-right">{{ $row['masuk'] > 0 ? number_format($row['masuk'], 0, ',', '.') : '-' }}</td>
                    <td class="text-right">{{ $row['keluar'] > 0 ? number_format($row['keluar'], 0, ',', '.') : '-' }}</td>
                    <td class="text-right" style="font-weight: bold;">{{ number_format($row['saldo'], 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada transaksi di bulan ini.</td>
                </tr>
            @endforelse
            <tr class="bg-total">
                <td colspan="4" class="text-right">TOTAL MUTASI BULAN INI:</td>
                <td class="text-right">{{ number_format($totalMasuk, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totalKeluar, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($saldoAkhir, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>

