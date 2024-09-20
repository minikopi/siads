<?php

use App\Http\Controllers\Bendahara\PaymentHistoryController;
use Illuminate\Support\Facades\Route;

Route::resource('payment-history', PaymentHistoryController::class);
Route::get('payment-history-data', [PaymentHistoryController::class, 'data'])->name('payment-history.data');
