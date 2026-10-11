<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PengurusDashboardController extends Controller
{
    public function index()
    {
        // Statistik
        // Total berat minyak jelantah & sampah dari detail_setoran
        $koleksi = DB::selectOne("
            SELECT
                IFNULL(SUM(CASE WHEN k.kelompok = 'Minyak Jelantah' THEN ds.total ELSE 0 END), 0) AS total_minyak,
                IFNULL(SUM(CASE WHEN k.kelompok = 'Sampah'          THEN ds.total ELSE 0 END), 0) AS total_sampah
            FROM detail_setoran ds
            JOIN kategori_sampah k ON ds.id_kategori = k.id_kategori
        ");

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

        return view('pengurus.dashboard', compact(
            'koleksi',
            'setoran_terbaru'
        ));
    }
}
