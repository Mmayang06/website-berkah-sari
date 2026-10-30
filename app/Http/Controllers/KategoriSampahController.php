<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriSampahController extends Controller
{
    private function getRole()
    {
        return request()->is('ketua*') ? 'ketua' : 'pengurus';
    }

    public function index()
    {
        $role = $this->getRole();
        return view("{$role}.kategori_sampah");
    }

    public function daftar($jenis = 'sampah')
    {
        $kelompok = ($jenis === 'minyak-jelantah') ? 'Minyak Jelantah' : 'Sampah';
        $title_kategori = ($kelompok === 'Minyak Jelantah') ? 'Minyak Jelantah' : 'Bank Sampah';

        $kategori = DB::table('kategori_sampah')
            ->where('kelompok', $kelompok)
            ->orderByRaw("CASE WHEN LOWER(jenis) LIKE '%lainnya%' THEN 1 ELSE 0 END ASC, jenis ASC")
            ->get();

        $role = $this->getRole();
        return view("{$role}.daftar_kategori", compact('kategori', 'kelompok', 'title_kategori', 'jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelompok' => 'required|in:Sampah,Minyak Jelantah',
            'jenis' => 'required|string|max:100',
            'satuan' => 'required|string|max:50',
        ]);

        DB::table('kategori_sampah')->insert([
            'kelompok' => $request->kelompok,
            'jenis' => $request->jenis,
            'satuan' => $request->satuan,
        ]);

        $redirectJenis = ($request->kelompok === 'Minyak Jelantah') ? 'minyak-jelantah' : 'sampah';
        $role = $this->getRole();

        return redirect()->route("{$role}.daftar-kategori", $redirectJenis)
            ->with('success', 'Jenis sampah berhasil ditambahkan');
    }
}
