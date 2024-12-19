<?php

use App\Http\Controllers\Administrator\KalenderAkademikController;
use App\Http\Controllers\Administrator\RoleController;
use App\Http\Controllers\Administrator\SuratEdaranController;
use App\Http\Controllers\Administrator\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::resource('akademik', KalenderAkademikController::class)->except('show');
Route::get('akademik-data', [KalenderAkademikController::class, 'data'])->name('akademik.data');

Route::resource('edaran', SuratEdaranController::class)->except('show');
Route::get('edaran-data', [SuratEdaranController::class, 'data'])->name('edaran.data');

Route::resource('roles', RoleController::class)->except('show');
Route::get('roles-data', [RoleController::class, 'data'])->name('roles.data');

Route::resource('user-role', UserRoleController::class)->except('show');
Route::get('user-role-data', [UserRoleController::class, 'data'])->name('user-role.data');
