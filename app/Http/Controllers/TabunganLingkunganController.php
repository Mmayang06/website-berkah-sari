<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class TabunganLingkunganController extends Controller
{
    public function index(Request $request)
    {
        if (!Schema::hasTable('tabungan_lingkungan')) {
            Schema::create('tabungan_lingkungan', function ($table) {
                $table->id('id_tabungan');
                $table->unsignedBigInteger('id_lingkungan');
                $table->integer('bulan');
                $table->integer('tahun');
                $table->decimal('nominal', 15, 2)->default(0);
                $table->string('status', 20)->default('Ditabung');
                $table->timestamps();
            });
        }

        $bulan = (int) $request->get('bulan', date('n'));
        $tahun = (int) $request->get('tahun', date('Y'));
        $namaBulan = Carbon::create()->month($bulan)->locale('id')->isoFormat('MMMM');

        $daftar_lingkungan = DB::table('lingkungan')
            ->orderBy('nama_lingkungan', 'asc')
            ->get();

        $penjualan = DB::table('setoran_sampah as s')
            ->join('donatur as d', 's.id_donatur', '=', 'd.id_donatur')
            ->join('detail_setoran as ds', 's.id_setoran', '=', 'ds.id_setoran')
            ->join('kategori_sampah as k', 'ds.id_kategori', '=', 'k.id_kategori')
            ->where('k.kelompok', 'Sampah')
            ->whereYear('s.tanggal', $tahun)
            ->whereMonth('s.tanggal', $bulan)
            ->select(
                'd.id_lingkungan',
                DB::raw('SUM(ds.harga_total) as total_nominal'),
                DB::raw('SUM(ds.total) as total_berat'),
                DB::raw('COUNT(DISTINCT d.id_donatur) as total_donatur')
            )
            ->groupBy('d.id_lingkungan')
            ->get()
            ->keyBy('id_lingkungan');

        $tabunganBulanIni = DB::table('tabungan_lingkungan')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get()
            ->keyBy('id_lingkungan');

        $items = [];
        foreach ($daftar_lingkungan as $lingk) {
            $id = $lingk->id_lingkungan;
            $pj = $penjualan->get($id);
            $tb = $tabunganBulanIni->get($id);

            $nominal = $pj ? (float) $pj->total_nominal : 0;
            $berat = $pj ? (float) $pj->total_berat : 0;
            $donatur = $pj ? (int) $pj->total_donatur : 0;

            if ($tb) {
                $status = $tb->status;
                if ($tb->nominal != $nominal) {
                    DB::table('tabungan_lingkungan')
                        ->where('id_tabungan', $tb->id_tabungan)
                        ->update(['nominal' => $nominal, 'updated_at' => now()]);
                }
            } else {
                $status = 'Ditabung';
                if ($nominal > 0) {
                    DB::table('tabungan_lingkungan')->insert([
                        'id_lingkungan' => $id,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'nominal' => $nominal,
                        'status' => 'Ditabung',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            $saldoTabungan = (float) DB::table('tabungan_lingkungan')
                ->where('id_lingkungan', $id)
                ->where('status', 'Ditabung')
                ->sum('nominal');

            $items[] = (object) [
                'id_lingkungan' => $id,
                'nama_lingkungan' => $lingk->nama_lingkungan,
                'donatur' => $donatur,
                'berat' => $berat,
                'nominal' => $nominal,
                'status' => $status,
                'saldo_tabungan' => $saldoTabungan,
            ];
        }

        $totalTabunganSemua = (float) DB::table('tabungan_lingkungan')
            ->where('status', 'Ditabung')
            ->sum('nominal');

        $totalHasilBulanIni = collect($items)->sum('nominal');

        $totalTransferBulanIni = (float) DB::table('tabungan_lingkungan')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('status', 'Ditransfer')
            ->sum('nominal');

        return view('ketua.tabungan-lingkungan', compact(
            'items',
            'bulan',
            'tahun',
            'namaBulan',
            'totalTabunganSemua',
            'totalHasilBulanIni',
            'totalTransferBulanIni'
        ));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id_lingkungan' => 'required',
            'bulan' => 'required|integer',
            'tahun' => 'required|integer',
            'status' => 'required|in:Ditabung,Ditransfer',
        ]);

        $nominal = $request->input('nominal', 0);

        DB::table('tabungan_lingkungan')->updateOrInsert(
            [
                'id_lingkungan' => $request->id_lingkungan,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
            ],
            [
                'nominal' => $nominal,
                'status' => $request->status,
                'updated_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Status penyaluran lingkungan berhasil diperbarui!');
    }
}

