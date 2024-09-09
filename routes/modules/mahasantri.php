<?php

use App\Http\Controllers\Mahasantri\PembayaranController;
use Illuminate\Support\Facades\Route;

Route::resource('pembayaran', PembayaranController::class);
