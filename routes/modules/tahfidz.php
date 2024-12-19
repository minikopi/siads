<?php

use App\Http\Controllers\Tahfidz\DataController;
use App\Http\Controllers\Tahfidz\SetoranController;
use Illuminate\Support\Facades\Route;

Route::resource('setoran', SetoranController::class);

Route::get('data', [DataController::class, 'index'])->name('data.index');
Route::get('data-data', [DataController::class, 'data'])->name('data.data');
