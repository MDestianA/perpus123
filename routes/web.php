<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


use App\Models\Buku;

Route::get('/', function () {
    $buku = Buku::latest()->get();

    return view('index', compact('buku'));
})->name('home');

// Route yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Dashboard Anggota
    Route::get('/anggota/dashboard', [AController::class, 'dashboard'])
        ->name('anggota.dashboard');

    Route::get('/anggota/peminjaman', [PeminjamanController::class, 'indexAnggota'])
        ->name('anggota.peminjaman');

  // Profil Anggota
Route::get('/anggota/profil', [AController::class, 'profil'])
    ->name('anggota.profil');

Route::put('/anggota/profil', [AController::class, 'updateProfil'])
    ->name('anggota.profil.update');

Route::put('/anggota/password', [AController::class, 'updatePassword'])
    ->name('anggota.password.update');

    // Halaman Buku Anggota
    Route::get('/anggota/buku', [AController::class, 'buku'])
        ->name('anggota.buku');

    // CRUD Buku
    Route::resource('buku', BukuController::class);

    // CRUD Anggota
    Route::resource('anggota', AnggotaController::class)
        ->parameters(['anggota' => 'anggota']);

    // CRUD Peminjaman
    Route::resource('peminjaman', PeminjamanController::class);

    // CRUD Pengembalian
    Route::resource('pengembalian', PengembalianController::class);

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Pengajuan peminjaman oleh anggota
    Route::post('/anggota/peminjaman', [PeminjamanController::class, 'storeAnggota'])
        ->name('anggota.peminjaman.store');

    Route::patch(
        '/peminjaman/{peminjaman}/setujui',
        [PeminjamanController::class, 'setujui']
    )->name('peminjaman.setujui');

    Route::patch(
        '/peminjaman/{peminjaman}/tolak',
        [PeminjamanController::class, 'tolak']
    )->name('peminjaman.tolak');

    Route::patch(
        '/peminjaman/{peminjaman}/kembalikan',
        [PeminjamanController::class, 'prosesPengembalian']
    )->name('peminjaman.kembalikan');
});

require __DIR__ . '/auth.php';
