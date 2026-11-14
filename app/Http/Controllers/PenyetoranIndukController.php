<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PenyetoranIndukController extends Controller
{
    private function getRole()
    {
        return request()->is('ketua*') ? 'ketua' : 'pengurus';
    }

    public function index(Request $request)
    {
        $role = $this->getRole();

        $daftarPengepul = DB::table('pengepul')->orderBy('nama_pengepul')->get();

        $daftarPenyetoran = DB::table('penyetoran_induk as pi')
            ->join('pengepul as p', 'pi.id_pengepul', '=', 'p.id_pengepul')
            ->select('pi.*', 'p.nama_pengepul')
            ->orderBy('pi.tanggal_setor', 'desc')
            ->orderBy('pi.id_penyetoran', 'desc')
            ->get();

        $setoranBelumSetor = DB::table('detail_setoran as ds')
            ->join('setoran_sampah as s', 'ds.id_setoran', '=', 's.id_setoran')
            ->join('kategori_sampah as k', 'ds.id_kategori', '=', 'k.id_kategori')
            ->leftJoin('donatur as d', 's.id_donatur', '=', 'd.id_donatur')
            ->leftJoin('lingkungan as l', 'd.id_lingkungan', '=', 'l.id_lingkungan')
            ->whereNull('ds.id_penyetoran')
            ->select(
                'ds.id_detail',
                's.tanggal',
                'd.nama_donatur',
                DB::raw('COALESCE(l.nama_lingkungan, "-") as nama_lingkungan'),
                'k.jenis as jenis_sampah',
                'k.kelompok',
                'k.satuan',
                'ds.total as berat'
            )
            ->orderBy('s.tanggal', 'desc')
            ->get();

        $totalPenyetoran = $daftarPenyetoran->count();
        $totalSampahKg = $daftarPenyetoran->where('kelompok', 'Sampah')->sum('total_berat');
        $totalMinyakL = 0;
        $totalPendapatan = $daftarPenyetoran->sum('total_pendapatan');

        return view("{$role}.penyetoran", compact(
            'daftarPengepul',
            'daftarPenyetoran',
            'setoranBelumSetor',
            'totalPenyetoran',
            'totalSampahKg',
            'totalMinyakL',
            'totalPendapatan'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_setor' => 'required|date',
            'id_pengepul' => 'required|integer|exists:pengepul,id_pengepul',
            'kelompok' => 'required|in:Sampah',
            'id_details' => 'required|array|min:1',
            'id_details.*' => 'integer|exists:detail_setoran,id_detail',
            'catatan' => 'nullable|string|max:500',
        ]);

        $idPengepul = (int) $request->id_pengepul;
        $tanggalSetor = $request->tanggal_setor;
        $bulan = (int) date('n', strtotime($tanggalSetor));
        $tahun = (int) date('Y', strtotime($tanggalSetor));

        $idPenyetoran = DB::table('penyetoran_induk')->insertGetId([
            'kelompok' => $request->kelompok,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'id_pengepul' => $idPengepul,
            'tanggal_setor' => $tanggalSetor,
            'total_berat' => 0,
            'total_pendapatan' => 0,
            'catatan' => $request->catatan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $hargaKatalog = DB::table('harga_pengepul')
            ->where('id_pengepul', $idPengepul)
            ->pluck('harga_jual', 'id_kategori');

        $items = DB::table('detail_setoran')
            ->whereIn('id_detail', $request->id_details)
            ->whereNull('id_penyetoran')
            ->get();

        foreach ($items as $item) {
            $hargaPerUnit = (float) ($hargaKatalog[$item->id_kategori] ?? 0);
            $hargaTotal = $item->total * $hargaPerUnit;

            DB::table('detail_setoran')
                ->where('id_detail', $item->id_detail)
                ->update([
                    'id_penyetoran' => $idPenyetoran,
                    'harga_total' => $hargaTotal,
                ]);
        }

        $rekap = DB::table('detail_setoran')
            ->where('id_penyetoran', $idPenyetoran)
            ->selectRaw('SUM(total) as berat, SUM(harga_total) as rupiah')
            ->first();

        DB::table('penyetoran_induk')
            ->where('id_penyetoran', $idPenyetoran)
            ->update([
                'total_berat' => $rekap->berat ?? 0,
                'total_pendapatan' => $rekap->rupiah ?? 0,
            ]);

        $pengepul = DB::table('pengepul')->where('id_pengepul', $idPengepul)->first();
        $namaPengepul = $pengepul ? $pengepul->nama_pengepul : 'Bank Sampah Induk';

        return redirect()->back()->with('success', "Penyetoran ke {$namaPengepul} berhasil disimpan! Data setoran terpilih telah diperbarui nilainya.");
    }

    public function destroy($id)
    {
        $penyetoran = DB::table('penyetoran_induk')->where('id_penyetoran', $id)->first();
        if (!$penyetoran) {
            return redirect()->back()->with('error', 'Data penyetoran tidak ditemukan.');
        }

        DB::table('detail_setoran')
            ->where('id_penyetoran', $id)
            ->update([
                'id_penyetoran' => null,
                'harga_total' => 0,
            ]);

        DB::table('penyetoran_induk')->where('id_penyetoran', $id)->delete();

        return redirect()->back()->with('success', 'Catatan penyetoran berhasil dibatalkan. Setoran terkait dikembalikan ke status belum disetor.');
    }
}
