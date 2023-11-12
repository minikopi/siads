<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MataKuliahController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//Dosen
Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
Route::get('/data_dosen', [DosenController::class, 'dataGet'])->name('dosen.dataGet');
Route::get('/data_dosen2', [DosenController::class, 'dataGet2'])->name('dosen.dataGet2');
Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
Route::get('/dosen/edit/{id}', [DosenController::class, 'edit'])->name('dosen.edit');
Route::put('/dosen{id}', [DosenController::class, 'update'])->name('dosen.update');
Route::delete('/dosen/delete/{id}', [DosenController::class, 'delete'])->name('dosen.delete');

//Mata Kuliah
Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah.index');
Route::get('/mata-kuliah/dataGet', [MataKuliahController::class, 'dataGet'])->name('mata-kuliah.dataGet');
Route::get('/mata-kuliah/create', [MataKuliahController::class, 'create'])->name('mata-kuliah.create');
