<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PengepulController extends Controller
{
    private function getRole()
    {
        return request()->is('ketua*') ? 'ketua' : 'pengurus';
    }

    public function index()
    {
        $role = $this->getRole();
        $daftar_pengepul = DB::table('pengepul')->get();

        return view("{$role}.pengepul", compact('daftar_pengepul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengepul' => 'required|string|max:100',
            'alamat' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $columns = Schema::getColumnListing('pengepul');
        $insertData = [];

        if (in_array('nama_pengepul', $columns)) {
            $insertData['nama_pengepul'] = $request->nama_pengepul;
        } elseif (in_array('nama', $columns)) {
            $insertData['nama'] = $request->nama_pengepul;
        }

        if (in_array('alamat', $columns)) {
            $insertData['alamat'] = $request->alamat;
        } elseif (in_array('alamat_pengepul', $columns)) {
            $insertData['alamat_pengepul'] = $request->alamat;
        }

        if (in_array('kontak', $columns)) {
            $insertData['kontak'] = $request->kontak;
        } elseif (in_array('no_telp', $columns)) {
            $insertData['no_telp'] = $request->kontak;
        }

        $idPengepul = DB::table('pengepul')->insertGetId($insertData);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $fileName = 'pengepul_' . $idPengepul . '.' . $ext;
            $file->move(public_path('img/icon'), $fileName);

            if (in_array('logo', $columns)) {
                DB::table('pengepul')->where('id_pengepul', $idPengepul)->update(['logo' => $fileName]);
            }
        }

        $role = $this->getRole();
        return redirect()->route("{$role}.pengepul")->with('success', 'Data Bank Sampah Induk berhasil ditambahkan!');
    }

    public function katalog($id = 1)
    {
        $pengepul = DB::table('pengepul')->where('id_pengepul', $id)->first();
        if (!$pengepul) {
            $pengepul = DB::table('pengepul')->first();
        }

        $daftar_pengepul = DB::table('pengepul')->get();

        $katalog = [];
        if ($pengepul) {
            $katalog = DB::table('harga_pengepul')
                ->join('kategori_sampah', 'harga_pengepul.id_kategori', '=', 'kategori_sampah.id_kategori')
                ->where('harga_pengepul.id_pengepul', $pengepul->id_pengepul)
                ->select(
                    'harga_pengepul.id_harga',
                    'kategori_sampah.nama_kategori',
                    'harga_pengepul.harga_jual',
                    'harga_pengepul.periode',
                    'kategori_sampah.jenis_sampah'
                )
                ->get();
        }

        $role = $this->getRole();
        return view("{$role}.katalog", compact('pengepul', 'katalog', 'daftar_pengepul'));
    }

    public function updateHarga(Request $request)
    {
        $request->validate([
            'id_harga' => 'required|integer',
            'harga_jual' => 'required|numeric|min:0',
            'periode' => 'required|string|max:50',
        ]);

        DB::table('harga_pengepul')
            ->where('id_harga', $request->id_harga)
            ->update([
                'harga_jual' => $request->harga_jual,
                'periode' => $request->periode,
            ]);

        return back()->with('success', 'Harga jual dan periode berhasil diperbarui!');
    }
}

