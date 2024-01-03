<?php

use App\Http\Controllers\AkademikController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasantriController;
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
Route::delete('/dosen/delete/{user_id}', [DosenController::class, 'delete'])->name('dosen.delete');

//Mahasantri
Route::get('/mahasantri', [MahasantriController::class, 'index'])->name('mahasantri.index');
Route::get('/data_mahasantri', [MahasantriController::class, 'dataGet'])->name('mahasantri.dataGet');
Route::get('/mahasantri/create', [MahasantriController::class, 'create'])->name('mahasantri.create');
Route::post('/mahasantri', [MahasantriController::class, 'store'])->name('mahasantri.store');
Route::get('/mahasantri/edit/{id}', [MahasantriController::class, 'edit'])->name('mahasantri.edit');
Route::put('/mahasantri{id}', [MahasantriController::class, 'update'])->name('mahasantri.update');
Route::delete('/mahasantri/delete/{user_id}', [MahasantriController::class, 'delete'])->name('mahasantri.delete');

//Mata Kuliah
Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah.index');
Route::get('/mata-kuliah/dataGet', [MataKuliahController::class, 'dataGet'])->name('mata-kuliah.dataGet');
Route::get('/mata-kuliah/create', [MataKuliahController::class, 'create'])->name('mata-kuliah.create');
Route::post('/mata-kuliah', [MataKuliahController::class, 'store'])->name('mata-kuliah.store');

//Mata Kuliah
Route::get('/kelas', [ClassController::class, 'index'])->name('kelas.index');
Route::get('/query/kelas', [ClassController::class, 'jsonClass'])->name('kelas.jsonClass');
Route::get('/kelas/dataGet', [ClassController::class, 'dataGet'])->name('kelas.dataGet');
Route::get('/kelas/create', [ClassController::class, 'create'])->name('kelas.create');
Route::post('/kelas', [ClassController::class, 'store'])->name('kelas.store');
Route::get('/kelas/{id}', [ClassController::class, 'detail'])->name('kelas.detail');
Route::get('/kelas/create/matkul/{id}', [ClassController::class, 'createSchedule'])->name('kelas.matkulPerKelas.detail');
Route::post('/kelas/store/matkul/{id}', [ClassController::class, 'storeSchedule'])->name('kelas.matkulPerKelas.store');
Route::get('/kelas/data-get/{id}', [ClassController::class, 'dataGetSchedule'])->name('kelas.matkulPerKelas.dataGet');

//Akademik
Route::get('/akademik', [AkademikController::class, 'index'])->name('akademik.index');
Route::get('/akademik/dataGet', [AkademikController::class, 'dataGet'])->name('akademik.dataGet');
Route::get('/akademik/dataGet2', [AkademikController::class, 'dataGet2'])->name('akademik.dataGet2');
Route::get('/akademik/kalendar/create', [AkademikController::class, 'createKalender'])->name('akademik.createKalender');
Route::post('/akademik/kalendar', [AkademikController::class, 'storeKalender'])->name('akademik.storeKalender');
Route::get('/akademik/edaran/create', [AkademikController::class, 'createEdaran'])->name('akademik.createEdaran');
Route::post('/akademik/edaran', [AkademikController::class, 'storeEdaran'])->name('akademik.storeEdaran');
