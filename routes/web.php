<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\JadwalKontrolController;
use App\Http\Controllers\JadwalpraktikController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ReservasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);

Route::get('reservasi/slots', [ReservasiController::class, 'showSlots'])->name('reservasi.slots');


Route::middleware('auth')->group(function () {
    Route::middleware('role:dokter,admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
        Route::resource('dokter', DokterController::class);
        Route::resource('pasien', PasienController::class);
        Route::resource('jadwalpraktik', JadwalpraktikController::class);
        Route::resource('rekam_medis', RekamMedisController::class)->except('create');
        Route::get('rekam_medis/create/{id}', [RekamMedisController::class, 'create'])->name('rekam_medis.create');
        Route::resource('jadwalkontrol', JadwalKontrolController::class);
    });

    // Untuk pasien
    Route::middleware('role:pasien')->group(function () {
        Route::post('reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
        Route::get('reservasi/index', [ReservasiController::class, 'index'])->name('reservasi.index');
        Route::get('/reservasi/riwayat', [ReservasiController::class, 'riwayat'])->name('reservasi.riwayat');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';