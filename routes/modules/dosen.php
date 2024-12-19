<?php

use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Dosen\JadwalKuliahController;
use App\Http\Controllers\Dosen\MataKuliahController;
use App\Http\Controllers\Dosen\PresensiController;
use Illuminate\Support\Facades\Route;

Route::get('dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::get('dosen-data', [DosenController::class, 'data'])->name('dosen.data');
Route::get('musyrif-data', [DosenController::class, 'data2'])->name('musyrif.data');

Route::get('mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah.index');
Route::get('mata-kuliah-data', [MataKuliahController::class, 'data'])->name('mata-kuliah.data');

Route::get('jadwal-kuliah', [JadwalKuliahController::class, 'index'])->name('jadwal-kuliah.index');
Route::get('jadwal-kuliah-data', [JadwalKuliahController::class, 'data'])->name('jadwal-kuliah.data');

Route::get('presensi-kuliah', [PresensiController::class, 'index'])->name('presensi-kuliah.index');
Route::get('presensi-kuliah-data', [PresensiController::class, 'data'])->name('presensi-kuliah.data');
