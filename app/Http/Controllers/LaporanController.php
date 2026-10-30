<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    private function getRole()
    {
        return request()->is('ketua*') ? 'ketua' : 'pengurus';
    }

    private function getFilterParams(Request $request)
    {
        $tipe = $request->get('tipe', 'bulan');
        $tahun = (int) $request->get('tahun', date('Y'));
        $bulan = (int) $request->get('bulan', date('n'));
        $triwulan = (int) $request->get('triwulan', ceil(date('n') / 3));
        $lingkungan = trim($request->get('lingkungan', ''));

        if ($tipe === 'triwulan') {
            $m1 = ($triwulan - 1) * 3 + 1;
            $m2 = $m1 + 1;
            $m3 = $m1 + 2;
            $months = [$m1, $m2, $m3];
            $namaBulan = [
                Carbon::create()->month($m1)->locale('id')->isoFormat('MMMM'),
                Carbon::create()->month($m2)->locale('id')->isoFormat('MMMM'),
                Carbon::create()->month($m3)->locale('id')->isoFormat('MMMM'),
            ];
            $labelPeriode = "Triwulan {$triwulan} ({$namaBulan[0]} - {$namaBulan[2]}) {$tahun}";
        } else {
            $tipe = 'bulan';
            $months = [$bulan];
            $namaBulan = [Carbon::create()->month($bulan)->locale('id')->isoFormat('MMMM')];
            $labelPeriode = "Bulan {$namaBulan[0]} {$tahun}";
            $m1 = $bulan;
            $m2 = $bulan;
            $m3 = $bulan;
        }

        return compact('tipe', 'tahun', 'bulan', 'triwulan', 'lingkungan', 'months', 'namaBulan', 'labelPeriode', 'm1', 'm2', 'm3');
    }

    private function getLaporanSetoranData($kelompok, $params)
    {
        $tipe = $params['tipe'];
        $tahun = $params['tahun'];
        $lingkungan = $params['lingkungan'];

        if ($tipe === 'triwulan') {
            $m1 = $params['m1'];
            $m2 = $params['m2'];
            $m3 = $params['m3'];

            $query = DB::table('setoran_sampah as s')
                ->join('donatur as d', 's.id_donatur', '=', 'd.id_donatur')
                ->leftJoin('lingkungan as l', 'd.id_lingkungan', '=', 'l.id_lingkungan')
                ->join('detail_setoran as ds', 's.id_setoran', '=', 'ds.id_setoran')
                ->join('kategori_sampah as k', 'ds.id_kategori', '=', 'k.id_kategori')
                ->where('k.kelompok', $kelompok)
                ->whereYear('s.tanggal', $tahun)
                ->whereBetween(DB::raw('MONTH(s.tanggal)'), [$m1, $m3]);

            if (!empty($lingkungan)) {
                $query->where('l.nama_lingkungan', $lingkungan);
            }

            $items = $query->select(
                'd.id_donatur',
                'd.nama_donatur',
                DB::raw('COALESCE(l.nama_lingkungan, "-") as nama_lingkungan'),
                DB::raw("SUM(CASE WHEN MONTH(s.tanggal) = {$m1} THEN ds.harga_total ELSE 0 END) as bulan_1"),
                DB::raw("SUM(CASE WHEN MONTH(s.tanggal) = {$m2} THEN ds.harga_total ELSE 0 END) as bulan_2"),
                DB::raw("SUM(CASE WHEN MONTH(s.tanggal) = {$m3} THEN ds.harga_total ELSE 0 END) as bulan_3"),
                DB::raw("SUM(CASE WHEN MONTH(s.tanggal) = {$m1} THEN ds.total ELSE 0 END) as vol_1"),
                DB::raw("SUM(CASE WHEN MONTH(s.tanggal) = {$m2} THEN ds.total ELSE 0 END) as vol_2"),
                DB::raw("SUM(CASE WHEN MONTH(s.tanggal) = {$m3} THEN ds.total ELSE 0 END) as vol_3"),
                DB::raw('SUM(ds.harga_total) as total_nilai'),
                DB::raw('SUM(ds.total) as total_berat')
            )
            ->groupBy('d.id_donatur', 'd.nama_donatur', 'l.nama_lingkungan')
            ->orderBy('d.nama_donatur', 'asc')
            ->get();

            $totalBerat = $items->sum('total_berat');
            $totalNilai = $items->sum('total_nilai');
            $totalDonatur = $items->count();

            return compact('items', 'totalBerat', 'totalNilai', 'totalDonatur');
        } else {
            $bulan = $params['bulan'];

            $query = DB::table('setoran_sampah as s')
                ->join('donatur as d', 's.id_donatur', '=', 'd.id_donatur')
                ->leftJoin('lingkungan as l', 'd.id_lingkungan', '=', 'l.id_lingkungan')
                ->join('detail_setoran as ds', 's.id_setoran', '=', 'ds.id_setoran')
                ->join('kategori_sampah as k', 'ds.id_kategori', '=', 'k.id_kategori')
                ->where('k.kelompok', $kelompok)
                ->whereYear('s.tanggal', $tahun)
                ->whereMonth('s.tanggal', $bulan);

            if (!empty($lingkungan)) {
                $query->where('l.nama_lingkungan', $lingkungan);
            }

            $items = $query->select(
                's.id_setoran',
                's.tanggal',
                'd.nama_donatur',
                DB::raw('COALESCE(l.nama_lingkungan, "-") as nama_lingkungan'),
                'k.jenis as jenis_sampah',
                'ds.total as berat',
                'ds.harga_total as total_nilai'
            )
            ->orderBy('s.tanggal', 'desc')
            ->orderBy('s.id_setoran', 'desc')
            ->get();

            $totalBerat = $items->sum('berat');
            $totalNilai = $items->sum('total_nilai');
            $totalDonatur = $items->pluck('nama_donatur')->unique()->count();

            return compact('items', 'totalBerat', 'totalNilai', 'totalDonatur');
        }
    }

    private function getLaporanOperasionalData($params)
    {
        $tipe = $params['tipe'];
        $tahun = $params['tahun'];

        if ($tipe === 'triwulan') {
            $m1 = $params['m1'];
            $m2 = $params['m2'];
            $m3 = $params['m3'];

            $items = DB::table('biaya_operasional')
                ->whereYear('tanggal_keluar', $tahun)
                ->whereBetween(DB::raw('MONTH(tanggal_keluar)'), [$m1, $m3])
                ->select(
                    'keterangan',
                    DB::raw("SUM(CASE WHEN MONTH(tanggal_keluar) = {$m1} THEN biaya_keluar ELSE 0 END) as bulan_1"),
                    DB::raw("SUM(CASE WHEN MONTH(tanggal_keluar) = {$m2} THEN biaya_keluar ELSE 0 END) as bulan_2"),
                    DB::raw("SUM(CASE WHEN MONTH(tanggal_keluar) = {$m3} THEN biaya_keluar ELSE 0 END) as bulan_3"),
                    DB::raw('SUM(biaya_keluar) as total_biaya'),
                    DB::raw('COUNT(*) as total_transaksi')
                )
                ->groupBy('keterangan')
                ->orderBy('keterangan', 'asc')
                ->get();

            $totalBiaya = $items->sum('total_biaya');
            $totalTransaksi = $items->sum('total_transaksi');

            return compact('items', 'totalBiaya', 'totalTransaksi');
        } else {
            $bulan = $params['bulan'];

            $items = DB::table('biaya_operasional')
                ->whereYear('tanggal_keluar', $tahun)
                ->whereMonth('tanggal_keluar', $bulan)
                ->select('id_biaya', 'tanggal_keluar', 'biaya_keluar', 'keterangan')
                ->orderBy('tanggal_keluar', 'desc')
                ->orderBy('id_biaya', 'desc')
                ->get();

            $totalBiaya = $items->sum('biaya_keluar');
            $totalTransaksi = $items->count();

            return compact('items', 'totalBiaya', 'totalTransaksi');
        }
    }

    public function bankSampah(Request $request)
    {
        $params = $this->getFilterParams($request);
        $data = $this->getLaporanSetoranData('Sampah', $params);
        $role = $this->getRole();
        $daftarLingkungan = DB::table('lingkungan')
            ->whereNotNull('nama_lingkungan')
            ->where('nama_lingkungan', '<>', '')
            ->orderBy('nama_lingkungan')
            ->pluck('nama_lingkungan');

        return view("{$role}.laporan-bank-sampah", array_merge($params, $data, compact('daftarLingkungan')));
    }

    public function minyakJelantah(Request $request)
    {
        $params = $this->getFilterParams($request);
        $data = $this->getLaporanSetoranData('Minyak Jelantah', $params);
        $role = $this->getRole();
        $daftarLingkungan = DB::table('lingkungan')
            ->whereNotNull('nama_lingkungan')
            ->where('nama_lingkungan', '<>', '')
            ->orderBy('nama_lingkungan')
            ->pluck('nama_lingkungan');

        return view("{$role}.laporan-minyak-jelantah", array_merge($params, $data, compact('daftarLingkungan')));
    }

    public function operasional(Request $request)
    {
        $params = $this->getFilterParams($request);
        $data = $this->getLaporanOperasionalData($params);
        $role = $this->getRole();

        return view("{$role}.laporan-operasional", array_merge($params, $data));
    }

    public function storeOperasional(Request $request)
    {
        $request->validate([
            'tanggal_keluar' => 'required|date',
            'biaya_keluar' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
        ]);

        DB::table('biaya_operasional')->insert([
            'id_user' => auth()->id() ?? 1,
            'tanggal_keluar' => $request->tanggal_keluar,
            'biaya_keluar' => $request->biaya_keluar,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function exportBankSampah(Request $request)
    {
        $params = $this->getFilterParams($request);
        $data = $this->getLaporanSetoranData('Sampah', $params);

        $filename = "Laporan_Bank_Sampah_" . str_replace([' ', '/', '(', ')', '-'], '_', $params['labelPeriode']) . ".xls";

        return response()->streamDownload(function() use ($params, $data) {
            echo view('exports.laporan-bank-sampah-excel', array_merge($params, $data))->render();
        }, $filename, [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control' => 'max-age=0',
        ]);
    }

    public function exportMinyakJelantah(Request $request)
    {
        $params = $this->getFilterParams($request);
        $data = $this->getLaporanSetoranData('Minyak Jelantah', $params);

        $filename = "Laporan_Minyak_Jelantah_" . str_replace([' ', '/', '(', ')', '-'], '_', $params['labelPeriode']) . ".xls";

        return response()->streamDownload(function() use ($params, $data) {
            echo view('exports.laporan-minyak-jelantah-excel', array_merge($params, $data))->render();
        }, $filename, [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control' => 'max-age=0',
        ]);
    }

    public function exportOperasional(Request $request)
    {
        $params = $this->getFilterParams($request);
        $data = $this->getLaporanOperasionalData($params);

        $filename = "Laporan_Operasional_" . str_replace([' ', '/', '(', ')', '-'], '_', $params['labelPeriode']) . ".xls";

        return response()->streamDownload(function() use ($params, $data) {
            echo view('exports.laporan-operasional-excel', array_merge($params, $data))->render();
        }, $filename, [
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
