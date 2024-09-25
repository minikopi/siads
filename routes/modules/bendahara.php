<?php

use App\Http\Controllers\Bendahara\CancelPembayaranController;
use App\Http\Controllers\Bendahara\MasterPaymentController;
use App\Http\Controllers\Bendahara\PaymentHistoryController;
use Illuminate\Support\Facades\Route;

Route::resource('payment-history', PaymentHistoryController::class);
Route::get('payment-history-data', [PaymentHistoryController::class, 'data'])->name('payment-history.data');

Route::get('pembayaran/{invoice}/cancel', CancelPembayaranController::class)->name('pembayaran.cancel');
Route::get('master-payment-data/{mahasantri_id}', [MasterPaymentController::class, 'data'])->name('master-payment.data');

Route::resource('master-payment.payment', MasterPaymentController::class)->parameters([
    'master-payment' => 'mahasantri'
]);
