<?php

use App\Http\Controllers\Mahasantri\CancelPembayaranController;
use App\Http\Controllers\Mahasantri\DosenController;
use App\Http\Controllers\Mahasantri\IpkController;
use App\Http\Controllers\Mahasantri\JadwalKuliahController;
use App\Http\Controllers\Mahasantri\MataKuliahController;
use App\Http\Controllers\Mahasantri\MusyrifController;
use App\Http\Controllers\Mahasantri\NilaiController;
use App\Http\Controllers\Mahasantri\PembayaranController;
use App\Http\Controllers\Mahasantri\PresensiController;
use App\Http\Controllers\Mahasantri\RiwayatPembayaranController;
use App\Http\Controllers\Mahasantri\TranskripNilaiController;
use Illuminate\Support\Facades\Route;

Route::resource('pembayaran', PembayaranController::class)->only('index', 'store');
Route::get('pembayaran/riwayat', [RiwayatPembayaranController::class, 'index'])->name('pembayaran.riwayat.index');
Route::get('pembayaran/{invoice}/cancel', CancelPembayaranController::class)->name('pembayaran.cancel');

Route::get('dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::get('dosen-data', [DosenController::class, 'data'])->name('dosen.data');

Route::get('musyrif-data', [DosenController::class, 'data2'])->name('musyrif.data');

Route::get('nilai', [NilaiController::class, 'index'])->name('nilai.index');
Route::get('nilai-data', [NilaiController::class, 'data'])->name('nilai.data');
Route::get('nilai/print', [NilaiController::class, 'print'])->name('nilai.print');

Route::get('jadwal-kuliah', [JadwalKuliahController::class, 'index'])->name('jadwal.index');
Route::get('jadwal-kuliah-data/{id}', [JadwalKuliahController::class, 'data'])->name('jadwal.data');
Route::get('jadwal-kuliah/{id}/print/{semester?}', [JadwalKuliahController::class, 'print'])->name('jadwal.print');

Route::get('presensi', [PresensiController::class, 'index'])->name('presensi.index');
Route::get('presensi-data', [PresensiController::class, 'data'])->name('presensi.data');

Route::get('ipk', [IpkController::class, 'index'])->name('ipk.index');
Route::get('ipk-data', [IpkController::class, 'data'])->name('ipk.data');

Route::get('mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah.index');
Route::get('mata-kuliah-data', [MataKuliahController::class, 'data'])->name('mata-kuliah.data');

Route::get('transkrip-nilai', [TranskripNilaiController::class, 'index'])->name('transkrip-nilai.index');
