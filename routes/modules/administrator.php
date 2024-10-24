<?php

use App\Http\Controllers\Administrator\KalenderAkademikController;
use App\Http\Controllers\Administrator\SuratEdaranController;
use Illuminate\Support\Facades\Route;

Route::resource('akademik', KalenderAkademikController::class)->except('show');
Route::get('akademik-data', [KalenderAkademikController::class, 'data'])->name('akademik.data');

Route::resource('edaran', SuratEdaranController::class)->except('show');
Route::get('edaran-data', [SuratEdaranController::class, 'data'])->name('edaran.data');
