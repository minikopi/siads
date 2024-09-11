<?php

use App\Http\Controllers\Mahasantri\PembayaranController;
use App\Http\Controllers\Mahasantri\RiwayatPembayaranController;
use Illuminate\Support\Facades\Route;

Route::get('pembayaran/riwayat', [RiwayatPembayaranController::class, 'index'])->name('pembayaran.riwayat.index');
Route::resource('pembayaran', PembayaranController::class)->only('index', 'store');
