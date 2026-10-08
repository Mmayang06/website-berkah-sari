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


// portal login (admin, pengurus, petugas)
Route::get('/portal-pengurus', [AuthController::class, 'showLogin'])->name('portal.login');
Route::post('/portal-pengurus', [AuthController::class, 'login'])->name('portal.login.submit');
Route::post('/portal-pengurus/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('portal.logout');


// admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/kelola-user', [App\Http\Controllers\UserController::class, 'index'])->name('kelola-user');
    Route::post('/kelola-user', [App\Http\Controllers\UserController::class, 'store'])->name('kelola-user.store');
    Route::put('/kelola-user/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('kelola-user.update');
    Route::delete('/kelola-user/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('kelola-user.destroy');
    Route::patch('/kelola-user/{user}/toggle-status', [App\Http\Controllers\UserController::class, 'toggleStatus'])->name('kelola-user.toggle-status');
});


// petugas input
Route::prefix('petugas')->name('petugas.')->middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/dashboard', function () {
        return view('petugas_input.dashboard');
    })->name('dashboard');
});


// pengurus
Route::prefix('pengurus')->name('pengurus.')->middleware(['auth', 'role:pengurus'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pengurus.dashboard');
    })->name('dashboard');
});



