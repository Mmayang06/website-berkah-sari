<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KetuaDashboardController;
use App\Http\Controllers\PengurusDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengepulController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\LaporanController;
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
    Route::get('/dashboard', [KetuaDashboardController::class, 'index'])->name('dashboard');

    Route::get('/akun-saya', function () {
        return view('ketua.akun-saya');
    })->name('akun-saya');

    Route::get('/kelola-user', [UserController::class, 'index'])->name('kelola-user');
    Route::post('/kelola-user', [UserController::class, 'store'])->name('kelola-user.store');
    Route::put('/kelola-user/{user}', [UserController::class, 'update'])->name('kelola-user.update');
    Route::delete('/kelola-user/{user}', [UserController::class, 'destroy'])->name('kelola-user.destroy');
    Route::patch('/kelola-user/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('kelola-user.toggle-status');

    // Manajemen
    Route::get('/pengepul', [PengepulController::class, 'index'])->name('pengepul');
    Route::post('/pengepul', [PengepulController::class, 'store'])->name('pengepul.store');
    Route::get('/katalog/{id?}', [PengepulController::class, 'katalog'])->name('katalog');
    Route::post('/katalog/update-harga', [PengepulController::class, 'updateHarga'])->name('katalog.update-harga');

    Route::get('/kategori-sampah', [KategoriSampahController::class, 'index'])->name('kategori-sampah');
    Route::post('/kategori-sampah', [KategoriSampahController::class, 'store'])->name('kategori-sampah.store');
    Route::get('/daftar-kategori/{jenis?}', [KategoriSampahController::class, 'daftar'])->name('daftar-kategori');

    // Laporan
    Route::get('/laporan-bank-sampah', [LaporanController::class, 'bankSampah'])->name('laporan-bank-sampah');
    Route::get('/laporan-bank-sampah/export', [LaporanController::class, 'exportBankSampah'])->name('laporan-bank-sampah.export');
    Route::get('/laporan-minyak-jelantah', [LaporanController::class, 'minyakJelantah'])->name('laporan-minyak-jelantah');
    Route::get('/laporan-minyak-jelantah/export', [LaporanController::class, 'exportMinyakJelantah'])->name('laporan-minyak-jelantah.export');
    Route::get('/laporan-operasional', [LaporanController::class, 'operasional'])->name('laporan-operasional');
    Route::get('/laporan-operasional/export', [LaporanController::class, 'exportOperasional'])->name('laporan-operasional.export');
    Route::post('/laporan-operasional', [LaporanController::class, 'storeOperasional'])->name('laporan-operasional.store');
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
    Route::get('/dashboard', [PengurusDashboardController::class, 'index'])->name('dashboard');

    Route::get('/akun-saya', function () {
        return view('pengurus.akun-saya');
    })->name('akun-saya');

    Route::put('/akun-saya/{user}', [UserController::class, 'update'])->name('akun-saya.update');

    // Manajemen
    Route::get('/pengepul', [PengepulController::class, 'index'])->name('pengepul');
    Route::post('/pengepul', [PengepulController::class, 'store'])->name('pengepul.store');
    Route::get('/katalog/{id?}', [PengepulController::class, 'katalog'])->name('katalog');
    Route::post('/katalog/update-harga', [PengepulController::class, 'updateHarga'])->name('katalog.update-harga');

    Route::get('/kategori-sampah', [KategoriSampahController::class, 'index'])->name('kategori-sampah');
    Route::post('/kategori-sampah', [KategoriSampahController::class, 'store'])->name('kategori-sampah.store');
    Route::get('/daftar-kategori/{jenis?}', [KategoriSampahController::class, 'daftar'])->name('daftar-kategori');

    // Laporan
    Route::get('/laporan-bank-sampah', [LaporanController::class, 'bankSampah'])->name('laporan-bank-sampah');
    Route::get('/laporan-bank-sampah/export', [LaporanController::class, 'exportBankSampah'])->name('laporan-bank-sampah.export');
    Route::get('/laporan-minyak-jelantah', [LaporanController::class, 'minyakJelantah'])->name('laporan-minyak-jelantah');
    Route::get('/laporan-minyak-jelantah/export', [LaporanController::class, 'exportMinyakJelantah'])->name('laporan-minyak-jelantah.export');
    Route::get('/laporan-operasional', [LaporanController::class, 'operasional'])->name('laporan-operasional');
    Route::get('/laporan-operasional/export', [LaporanController::class, 'exportOperasional'])->name('laporan-operasional.export');
    Route::post('/laporan-operasional', [LaporanController::class, 'storeOperasional'])->name('laporan-operasional.store');
});
