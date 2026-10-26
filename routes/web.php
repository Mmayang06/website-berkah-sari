<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('umat.home');
})->name('home');

Route::get('/about', function () {
    return view('umat.about');
})->name('about');

Route::get('/service', function () {
    return view('umat.service');
})->name('service');

Route::get('/project', function () {
    return view('umat.project');
})->name('project');

Route::get('/feature', function () {
    return view('umat.feature');
})->name('feature');

Route::get('/quote', function () {
    return view('umat.quote');
})->name('quote');

Route::get('/team', function () {
    return view('umat.team');
})->name('team');

Route::get('/testimonial', function () {
    return view('umat.testimonial');
})->name('testimonial');

Route::get('/contact', function () {
    return view('umat.contact');
})->name('contact');


// portal login (ketua, pengurus, petugas)
Route::get('/portal-pengurus', [AuthController::class, 'showLogin'])->name('portal.login');
Route::post('/portal-pengurus', [AuthController::class, 'login'])->name('portal.login.submit');
Route::post('/portal-pengurus/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('portal.logout');


// ketua (formerly admin)
Route::prefix('ketua')->name('ketua.')->middleware(['auth', 'role:admin,ketua'])->group(function () {
    Route::get('/dashboard', function () {
        return view('ketua.dashboard');
    })->name('dashboard');

    Route::get('/akun-saya', function () {
        return view('ketua.akun-saya');
    })->name('akun-saya');

    Route::get('/kelola-user', [App\Http\Controllers\UserController::class, 'index'])->name('kelola-user');
    Route::post('/kelola-user', [App\Http\Controllers\UserController::class, 'store'])->name('kelola-user.store');
    Route::put('/kelola-user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('kelola-user.update');
    Route::delete('/kelola-user/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('kelola-user.destroy');
    Route::patch('/kelola-user/{user}/toggle-status', [App\Http\Controllers\UserController::class, 'toggleStatus'])->name('kelola-user.toggle-status');
});


// petugas input
Route::prefix('petugas')->name('petugas.')->middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('petugas.pilih');
    });

    Route::get('/pilih-input', function () {
        return view('petugas_input.pilih');
    })->name('pilih');

    Route::get('/dashboard', function () {
        return redirect()->route('petugas.pilih');
    })->name('dashboard');

    Route::get('/dashboard-bs', function () {
        return view('petugas_input.dashboard_bs');
    })->name('dashboard_bs');

    Route::get('/dashboard-mijel', function () {
        return view('petugas_input.dashboard_mijel');
    })->name('dashboard_mijel');
});


// pengurus
Route::prefix('pengurus')->name('pengurus.')->middleware(['auth', 'role:pengurus,ketua,admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\PengurusDashboardController::class, 'index'])->name('dashboard');

    Route::get('/akun-saya', function () {
        return view('pengurus.akun-saya');
    })->name('akun-saya');

    Route::put('/akun-saya/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('akun-saya.update');

    // Manajemen
    Route::get('/pengepul', function () {
        return view('pengurus.pengepul');
    })->name('pengepul');

    Route::get('/katalog/{id?}', function ($id = 1) {
        $pengepul = DB::table('pengepul')->where('id_pengepul', $id)->first();
        if (!$pengepul) {
            $pengepul = DB::table('pengepul')->where('nama_pengepul', 'like', "%{$id}%")->first();
        }
        if (!$pengepul) {
            $pengepul = DB::table('pengepul')->first();
        }

        $katalog = DB::table('harga_pengepul as hp')
            ->join('kategori_sampah as k', 'hp.id_kategori', '=', 'k.id_kategori')
            ->where('hp.id_pengepul', $pengepul->id_pengepul)
            ->where('k.kelompok', 'Sampah')
            ->select('hp.id_harga', 'k.jenis', 'k.satuan', 'hp.harga_jual', 'hp.periode')
            ->orderByRaw("CASE WHEN LOWER(k.jenis) LIKE '%lainnya%' THEN 1 ELSE 0 END ASC, k.jenis ASC")
            ->get();

        $daftar_pengepul = DB::table('pengepul')->get();

        return view('pengurus.katalog', compact('pengepul', 'katalog', 'daftar_pengepul'));
    })->name('katalog');

    Route::get('/kategori-sampah', function () {
        return view('pengurus.kategori_sampah');
    })->name('kategori-sampah');

    Route::get('/daftar-kategori/{jenis?}', function ($jenis = 'sampah') {
        $kelompok = ($jenis === 'minyak-jelantah') ? 'Minyak Jelantah' : 'Sampah';
        $title_kategori = ($kelompok === 'Minyak Jelantah') ? 'Minyak Jelantah' : 'Bank Sampah';

        $kategori = DB::table('kategori_sampah')
            ->where('kelompok', $kelompok)
            ->orderByRaw("CASE WHEN LOWER(jenis) LIKE '%lainnya%' THEN 1 ELSE 0 END ASC, jenis ASC")
            ->get();

        return view('pengurus.daftar_kategori', compact('kategori', 'kelompok', 'title_kategori', 'jenis'));
    })->name('daftar-kategori');

    Route::post('/kategori-sampah', function (Illuminate\Http\Request $request) {
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
        return redirect()->route('pengurus.daftar-kategori', $redirectJenis)->with('success', 'Jenis sampah berhasil ditambahkan');
    })->name('kategori-sampah.store');

    // Laporan
    Route::get('/laporan-bank-sampah', function () {
        return view('pengurus.laporan-bank-sampah');
    })->name('laporan-bank-sampah');

    Route::get('/laporan-minyak-jelantah', function () {
        return view('pengurus.laporan-minyak-jelantah');
    })->name('laporan-minyak-jelantah');

    Route::get('/laporan-operasional', function () {
        return view('pengurus.laporan-operasional');
    })->name('laporan-operasional');
});
