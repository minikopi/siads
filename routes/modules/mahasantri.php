<?php

use App\Http\Controllers\Mahasantri\CancelPembayaranController;
use App\Http\Controllers\Mahasantri\DosenController;
use App\Http\Controllers\Mahasantri\MusyrifController;
use App\Http\Controllers\Mahasantri\NilaiController;
use App\Http\Controllers\Mahasantri\PembayaranController;
use App\Http\Controllers\Mahasantri\RiwayatPembayaranController;
use Illuminate\Support\Facades\Route;

Route::resource('pembayaran', PembayaranController::class)->only('index', 'store');
Route::get('pembayaran/riwayat', [RiwayatPembayaranController::class, 'index'])->name('pembayaran.riwayat.index');
Route::get('pembayaran/{invoice}/cancel', CancelPembayaranController::class)->name('pembayaran.cancel');

Route::get('dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::get('dosen-data', [DosenController::class, 'data'])->name('dosen.data');

Route::get('musyrif-data', [DosenController::class, 'data2'])->name('musyrif.data');

Route::get('nilai', [NilaiController::class, 'index'])->name('nilai.index');
Route::get('nilai-data', [NilaiController::class, 'data'])->name('nilai.data');
