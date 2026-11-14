<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PengurusDashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $bulanIni = date('n');
        $tahunIni = date('Y');

        $koleksi = DB::selectOne("
            SELECT
                IFNULL(SUM(CASE WHEN k.kelompok = 'Minyak Jelantah' THEN ds.total ELSE 0 END), 0) AS total_minyak,
                IFNULL(SUM(CASE WHEN k.kelompok = 'Sampah'          THEN ds.total ELSE 0 END), 0) AS total_sampah
            FROM detail_setoran ds
            JOIN setoran_sampah s ON ds.id_setoran = s.id_setoran
            JOIN kategori_sampah k ON ds.id_kategori = k.id_kategori
            WHERE MONTH(s.tanggal) = ? AND YEAR(s.tanggal) = ?
        ", [$bulanIni, $tahunIni]);

        // Ringkasan setoran terbaru 
        $setoran_terbaru = DB::select("
            SELECT
                s.id_setoran,
                d.nama_donatur,
                l.nama_lingkungan,
                s.tanggal,
                s.jumlah,
                fn_total_stetoran(s.id_setoran) AS total_nilai
            FROM setoran_sampah s
            JOIN donatur d  ON s.id_donatur  = d.id_donatur
            JOIN lingkungan l ON d.id_lingkungan = l.id_lingkungan
            ORDER BY s.tanggal DESC, s.id_setoran DESC
            LIMIT 5
        ");

        $total_penjualan = (float) DB::table('detail_setoran as ds')
            ->join('setoran_sampah as s', 'ds.id_setoran', '=', 's.id_setoran')
            ->whereMonth('s.tanggal', $bulanIni)
            ->whereYear('s.tanggal', $tahunIni)
            ->sum('ds.harga_total');

        $ops = (float) DB::table('biaya_operasional')
            ->whereMonth('tanggal_keluar', $bulanIni)
            ->whereYear('tanggal_keluar', $tahunIni)
            ->sum('biaya_keluar');

        $bersih = $total_penjualan - $ops;

        return view('pengurus.dashboard', compact(
            'koleksi',
            'setoran_terbaru',
            'bersih',
            'ops'
        ));
    }
}
