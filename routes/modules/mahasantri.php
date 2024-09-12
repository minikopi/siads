<?php

use App\Http\Controllers\Mahasantri\CancelPembayaranController;
use App\Http\Controllers\Mahasantri\PembayaranController;
use App\Http\Controllers\Mahasantri\RiwayatPembayaranController;
use Illuminate\Support\Facades\Route;

Route::resource('pembayaran', PembayaranController::class)->only('index', 'store');
Route::get('pembayaran/riwayat', [RiwayatPembayaranController::class, 'index'])->name('pembayaran.riwayat.index');
Route::get('pembayaran/{invoice}/cancel', CancelPembayaranController::class)->name('pembayaran.cancel');
