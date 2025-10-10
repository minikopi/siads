<?php

use App\Http\Controllers\Takhrij\PoinTakhrijController;
use Illuminate\Support\Facades\Route;

Route::get('points/dataGet', [PoinTakhrijController::class, 'dataGet'])->name('points.dataGet');
Route::resource('points', PoinTakhrijController::class);
