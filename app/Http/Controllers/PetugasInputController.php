<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasInputController extends Controller
{
    public function pilih()
    {
        return view('petugas_input.pilih');
    }

    public function dashboardBs()
    {
        $today = date('Y-m-d');
        $kelompok = 'Sampah';
        $satuanDefault = 'kg';

        $daftarLingkungan = DB::table('lingkungan')
            ->orderBy('nama_lingkungan', 'asc')
            ->get();

        $kategori = DB::table('kategori_sampah')
            ->where('kelompok', $kelompok)
            ->orderBy('jenis', 'asc')
            ->get();

        $setoranHariIni = DB::table('setoran_sampah as s')
            ->leftJoin('donatur as d', 's.id_donatur', '=', 'd.id_donatur')
            ->leftJoin('lingkungan as l', 'd.id_lingkungan', '=', 'l.id_lingkungan')
            ->join('detail_setoran as ds', 's.id_setoran', '=', 'ds.id_setoran')
            ->join('kategori_sampah as k', 'ds.id_kategori', '=', 'k.id_kategori')
            ->where('k.kelompok', $kelompok)
            ->whereDate('s.tanggal', $today)
            ->select(
                's.id_setoran',
                's.tanggal',
                DB::raw('COALESCE(l.nama_lingkungan, d.nama_donatur, "-") as nama_lingkungan'),
                'k.jenis as jenis_sampah',
                'k.satuan',
                'ds.total as berat'
            )
            ->orderBy('s.id_setoran', 'desc')
            ->get();

        $rekapHariIni = (object) [
            'total_transaksi' => $setoranHariIni->count(),
            'total_berat' => $setoranHariIni->sum('berat'),
        ];

        return view('petugas_input.dashboard_bs', compact(
            'daftarLingkungan',
            'kategori',
            'setoranHariIni',
            'rekapHariIni',
            'kelompok',
            'satuanDefault'
        ));
    }

    public function dashboardMijel()
    {
        $today = date('Y-m-d');
        $kelompok = 'Minyak Jelantah';
        $satuanDefault = 'Liter';

        $daftarLingkungan = DB::table('lingkungan')
            ->orderBy('nama_lingkungan', 'asc')
            ->get();

        $kategori = DB::table('kategori_sampah')
            ->where('kelompok', $kelompok)
            ->orderBy('jenis', 'asc')
            ->get();

        $setoranHariIni = DB::table('setoran_sampah as s')
            ->leftJoin('donatur as d', 's.id_donatur', '=', 'd.id_donatur')
            ->leftJoin('lingkungan as l', 'd.id_lingkungan', '=', 'l.id_lingkungan')
            ->join('detail_setoran as ds', 's.id_setoran', '=', 'ds.id_setoran')
            ->join('kategori_sampah as k', 'ds.id_kategori', '=', 'k.id_kategori')
            ->where('k.kelompok', $kelompok)
            ->whereDate('s.tanggal', $today)
            ->select(
                's.id_setoran',
                's.tanggal',
                DB::raw('COALESCE(l.nama_lingkungan, d.nama_donatur, "-") as nama_lingkungan'),
                'k.jenis as jenis_sampah',
                'k.satuan',
                'ds.total as berat'
            )
            ->orderBy('s.id_setoran', 'desc')
            ->get();

        $rekapHariIni = (object) [
            'total_transaksi' => $setoranHariIni->count(),
            'total_berat' => $setoranHariIni->sum('berat'),
        ];

        return view('petugas_input.dashboard_mijel', compact(
            'daftarLingkungan',
            'kategori',
            'setoranHariIni',
            'rekapHariIni',
            'kelompok',
            'satuanDefault'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lingkungan' => 'required',
            'id_kategori' => 'required',
            'berat' => 'required|numeric|min:0.01',
            'tanggal' => 'required|date',
        ]);

        $lingkungan = DB::table('lingkungan')->where('id_lingkungan', $request->id_lingkungan)->first();
        if (!$lingkungan) {
            return response()->json(['status' => 'error', 'message' => 'Lingkungan tidak valid.'], 422);
        }

        $donatur = DB::table('donatur')->where('id_lingkungan', $lingkungan->id_lingkungan)->first();
        if (!$donatur) {
            $id_donatur = DB::table('donatur')->insertGetId([
                'id_lingkungan' => $lingkungan->id_lingkungan,
                'nama_donatur' => $lingkungan->nama_lingkungan,
            ]);
        } else {
            $id_donatur = $donatur->id_donatur;
        }

        $id_setoran = DB::table('setoran_sampah')->insertGetId([
            'id_donatur' => $id_donatur,
            'id_user' => auth()->id() ?? 1,
            'tanggal' => $request->tanggal,
            'jumlah' => 1,
        ]);

        DB::table('detail_setoran')->insert([
            'id_setoran' => $id_setoran,
            'id_kategori' => $request->id_kategori,
            'total' => $request->berat,
            'harga_total' => 0,
        ]);

        $kategori = DB::table('kategori_sampah')->where('id_kategori', $request->id_kategori)->first();
        $kelompok = $kategori ? $kategori->kelompok : 'Sampah';

        $rekapHariIni = DB::table('setoran_sampah as s')
            ->join('detail_setoran as ds', 's.id_setoran', '=', 'ds.id_setoran')
            ->join('kategori_sampah as k', 'ds.id_kategori', '=', 'k.id_kategori')
            ->where('k.kelompok', $kelompok)
            ->whereDate('s.tanggal', $request->tanggal)
            ->selectRaw('COUNT(*) as total_transaksi, SUM(ds.total) as total_berat')
            ->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Data setoran berhasil disimpan!',
            'data' => [
                'id_setoran' => $id_setoran,
                'tanggal' => date('d M Y', strtotime($request->tanggal)),
                'nama_lingkungan' => $lingkungan->nama_lingkungan,
                'jenis_sampah' => $kategori->jenis ?? '-',
                'satuan' => $kategori->satuan ?? 'kg',
                'berat' => number_format($request->berat, 2, ',', '.'),
            ],
            'rekap' => [
                'total_transaksi' => $rekapHariIni->total_transaksi ?? 0,
                'total_berat' => number_format($rekapHariIni->total_berat ?? 0, 2, ',', '.'),
            ]
        ]);
    }

    public function destroy($id)
    {
        $detail = DB::table('detail_setoran')->where('id_setoran', $id)->first();
        $kelompok = 'Sampah';
        if ($detail) {
            $kat = DB::table('kategori_sampah')->where('id_kategori', $detail->id_kategori)->first();
            if ($kat) $kelompok = $kat->kelompok;
        }

        DB::table('detail_setoran')->where('id_setoran', $id)->delete();
        DB::table('setoran_sampah')->where('id_setoran', $id)->delete();

        $today = date('Y-m-d');
        $rekapHariIni = DB::table('setoran_sampah as s')
            ->join('detail_setoran as ds', 's.id_setoran', '=', 'ds.id_setoran')
            ->join('kategori_sampah as k', 'ds.id_kategori', '=', 'k.id_kategori')
            ->where('k.kelompok', $kelompok)
            ->whereDate('s.tanggal', $today)
            ->selectRaw('COUNT(*) as total_transaksi, SUM(ds.total) as total_berat')
            ->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Setoran berhasil dibatalkan!',
            'rekap' => [
                'total_transaksi' => $rekapHariIni->total_transaksi ?? 0,
                'total_berat' => number_format($rekapHariIni->total_berat ?? 0, 2, ',', '.'),
            ]
        ]);
    }
}


