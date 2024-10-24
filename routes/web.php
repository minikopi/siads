<?php

use App\Http\Controllers\AbsentController;
use App\Http\Controllers\Administrator\AcademicYearController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IpkController;
use App\Http\Controllers\MahasantriController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScoreController;
use App\Models\PaymentType;
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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::prefix('master')->group(function () {
                Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
                Route::get('/data_dosen', [DosenController::class, 'dataGet'])->name('dosen.dataGet');
                Route::get('/data_dosen2', [DosenController::class, 'dataGet2'])->name('dosen.dataGet2');
                Route::get('/data_dosen/json', [DosenController::class, 'dosenMatkul'])->name('dosen.json');
                Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
                Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
                Route::get('/dosen/edit/{id}', [DosenController::class, 'edit'])->name('dosen.edit');
                Route::post('/dosen/update/{id}', [DosenController::class, 'update'])->name('dosen.update');
                Route::delete('/dosen/delete/{id}', [DosenController::class, 'delete'])->name('dosen.delete');

                //Mahasantri
                Route::get('/mahasantri', [MahasantriController::class, 'index'])->name('mahasantri.index');
                Route::get('/data_mahasantri', [MahasantriController::class, 'dataGet'])->name('mahasantri.dataGet');
                Route::get('/mahasantri/create', [MahasantriController::class, 'create'])->name('mahasantri.create');
                Route::post('/mahasantri', [MahasantriController::class, 'store'])->name('mahasantri.store');
                Route::get('/mahasantri/edit/{id}', [MahasantriController::class, 'edit'])->name('mahasantri.edit');
                Route::put('/mahasantri{id}', [MahasantriController::class, 'update'])->name('mahasantri.update');
                Route::delete('/mahasantri/delete/{id}', [MahasantriController::class, 'delete'])->name('mahasantri.delete');

                //Mata Kuliah
                Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah.index');
                Route::get('/mata-kuliah/query', [MataKuliahController::class, 'jsonMatkul'])->name('mata-kuliah.json');
                Route::get('/mata-kuliah/dataGet', [MataKuliahController::class, 'dataGet'])->name('mata-kuliah.dataGet');
                Route::get('/mata-kuliah/create', [MataKuliahController::class, 'create'])->name('mata-kuliah.create');
                Route::post('/mata-kuliah', [MataKuliahController::class, 'store'])->name('mata-kuliah.store');
                Route::get('/mata-kuliah/{id}', [MataKuliahController::class, 'edit'])->name('mata-kuliah.edit');
                Route::post('/mata-kuliah/update/{id}', [MataKuliahController::class, 'update'])->name('mata-kuliah.update');
                Route::delete('/mata-kuliah/delete/{id}', [MataKuliahController::class, 'delete'])->name('mata-kuliah.delete');

                // Tahun Ajaran
                Route::get('/academic-year/dataGet', [AcademicYearController::class, 'dataGet'])->name('academic-year.dataGet');
                Route::resource('academic-year', AcademicYearController::class);

                //Schedule
                Route::get('/jadwal-kuliah', [ScheduleController::class, 'index'])->name('schedule.index');
                Route::get('/jadwal-kuliah/{id}', [ScheduleController::class, 'detail'])->name('schedule.detail');
                Route::get('/jadwal-kuliah/cetak/{id}', [ScheduleController::class, 'generatePDF'])->name('schedule.cetak');
                // Route::get('/jadwal-kuliah/dataGet', [MataKuliahController::class, 'dataGet'])->name('mata-kuliah.dataGet');
                // Route::get('/jadwal-kuliah/create', [MataKuliahController::class, 'create'])->name('mata-kuliah.create');
                // Route::post('/jadwal-kuliah', [MataKuliahController::class, 'store'])->name('mata-kuliah.store');

                //Persensi
                Route::get('/presensi', [AbsentController::class, 'index'])->name('absent.index');
                Route::get('/presensi/{id}', [AbsentController::class, 'detail'])->name('absent.detail');
                Route::get('/presensi/admin/{id}', [AbsentController::class, 'AbsentAdmin'])->name('absent.AbsentAdmin');
                Route::get('/presensi/admin/form/{id}', [AbsentController::class, 'AbsentForm'])->name('absent.AbsentForm');
                Route::get('/presensi/admin/edit/{id}/tanggal/{date}', [AbsentController::class, 'AbsentFormEdit'])->name('absent.AbsentFormEdit');
                Route::delete('/presensi/admin/delete/{id}/tanggal/{date}', [AbsentController::class, 'DeleteAbsent'])->name('absent.delete');
                Route::post('/presensi/admin/store/{schedule_id}', [AbsentController::class, 'store'])->name('absent.store');
                Route::post('/presensi/admin/update/{schedule_id}', [AbsentController::class, 'update'])->name('absent.update');


                Route::get('/presensi/mahasantri/abs', [AbsentController::class, 'AbsentMahasiswa'])->name('absent.mahasantri.index');
                Route::get('/presensi/mahasantri/json', [AbsentController::class, 'dataGetScheduleMahasiswa'])->name('absent.mahasantri.getData');
                Route::get('/presensi/mahasiswa/cetak', [AbsentController::class, 'GeneratePDF'])->name('absent.mahasantri.cetak');


                //penilaian
                Route::get('/score', [ScoreController::class, 'index'])->name('score.index');
                Route::get('/score/{id}', [ScoreController::class, 'detail'])->name('score.detail');
                Route::get('/score/admin/{id}', [ScoreController::class, 'AbsentAdmin'])->name('score.AbsentAdmin');
                Route::get('/score/admin/form/{id}', [ScoreController::class, 'scoreForm'])->name('score.scoreForm');
                Route::get('/score/admin/store/{schedule_id}', [ScoreController::class, 'store'])->name('score.store');
                Route::get('/score/data-get/{id}', [ScoreController::class, 'dataGet'])->name('score.matkulPerKelas.dataGet');


                Route::get('/score/mahasantri/abs', [ScoreController::class, 'AbsentMahasiswa'])->name('score.mahasantri.index');
                Route::get('/score/mahasantri/json', [ScoreController::class, 'dataGetScheduleMahasiswa'])->name('score.mahasantri.getData');
                Route::get('/score/mahasantri/cetak', [ScoreController::class, 'generatePDF'])->name('score.mahasantri.cetak');

                //Mata Kuliah
                Route::get('/kelas', [ClassController::class, 'index'])->name('kelas.index');
                Route::get('/query/kelas', [ClassController::class, 'jsonClass'])->name('kelas.jsonClass');
                Route::get('/kelas/dataGet', [ClassController::class, 'dataGet'])->name('kelas.dataGet');
                Route::get('/kelas/create', [ClassController::class, 'create'])->name('kelas.create');
                Route::post('/kelas', [ClassController::class, 'store'])->name('kelas.store');
                Route::post('/kelas/smester/update', [ClassController::class, 'updateCurrentSmester'])->name('kelas.updateSmester');
                Route::get('/kelas/{id}', [ClassController::class, 'detail'])->name('kelas.detail');
                Route::get('/kelas/create/matkul/{id}', [ClassController::class, 'createSchedule'])->name('kelas.matkulPerKelas.detail');
                Route::get('/kelas/edit/matkul/{id}', [ClassController::class, 'editSchedule'])->name('kelas.matkulPerKelas.edit');
                Route::post('/kelas/update/matkul/{id}', [ClassController::class, 'updateSchedule'])->name('kelas.matkulPerKelas.update');
                Route::post('/kelas/store/matkul/{id}', [ClassController::class, 'storeSchedule'])->name('kelas.matkulPerKelas.store');
                Route::delete('/kelas/delete/matkul/{id}', [ClassController::class, 'deleteSchedule'])->name('kelas.matkulPerKelas.delete');
                Route::get('/kelas/data-get/{id}', [ClassController::class, 'dataGetSchedule'])->name('kelas.matkulPerKelas.dataGet');

                //Akademik
                Route::get('/akademik', [AkademikController::class, 'index'])->name('akademik.index');
                Route::get('/akademik/dataGet', [AkademikController::class, 'dataGet'])->name('akademik.dataGet');
                Route::get('/akademik/dataGet2', [AkademikController::class, 'dataGet2'])->name('akademik.dataGet2');
                Route::get('/akademik/kalendar/create', [AkademikController::class, 'createKalender'])->name('akademik.createKalender');
                Route::post('/akademik/kalendar', [AkademikController::class, 'storeKalender'])->name('akademik.storeKalender');
                Route::get('/akademik/edaran/create', [AkademikController::class, 'createEdaran'])->name('akademik.createEdaran');
                Route::post('/akademik/edaran', [AkademikController::class, 'storeEdaran'])->name('akademik.storeEdaran');

                //IPK
                Route::get('/ipk', [IpkController::class, 'index'])->name('ipk.index');
                Route::get('/ipk/dataGet', [IpkController::class, 'dataGet'])->name('ipk.dataGet');

                //Pembayaran
                // Route::get('/pembayaran', [PaymentController::class, 'index'])->name('pembayaran.index');

                //Sidang
                Route::get('/sidang', [PaymentController::class, 'index'])->name('sidang.index');

                //Wisuda
                Route::get('/wisuda', [PaymentController::class, 'index'])->name('wisuda.index');
            }
        );
        Route::group(['prefix' => 'pembayaran'], function () {
            //Pembayaran
            Route::get('/', [PaymentController::class, 'ListSiswa'])->name('pembayaran.ListSiswa');
            Route::get('/data/json', [PaymentController::class, 'ListSiswaData'])->name('pembayaran.ListSiswaData');
            Route::get('/{test?}', [PaymentController::class, 'index'])->name('pembayaran.index');
            Route::post('/', [PaymentController::class, 'PaymentSend'])->name('pembayaran.store');
            //master
            Route::group(['prefix' => 'master/type', 'middleware' => ['role:admin']], function () {
                Route::get('/', [PaymentTypeController::class, 'index'])->name('paymentType.index');
                Route::get('/dataGet', [PaymentTypeController::class, 'dataGet'])->name('paymentType.dataGet');
                Route::get('/create', [PaymentTypeController::class, 'create'])->name('paymentType.create');
                Route::post('/', [PaymentTypeController::class, 'store'])->name('paymentType.store');
                Route::get('/edit/{id}', [PaymentTypeController::class, 'edit'])->name('paymentType.edit');
                Route::put('/update/{id}', [PaymentTypeController::class, 'update'])->name('paymentType.update');
                Route::delete('/delete/{id}', [PaymentTypeController::class, 'delete'])->name('paymentType.delete');
                Route::get('/publish/{id}', [PaymentTypeController::class, 'publish'])->name('paymentType.publish');
                Route::put('/publish/{id}', [PaymentTypeController::class, 'publishing'])->name('paymentType.publishing');
            });
        });
        Route::group(['prefix' => 'wisuda'], function () {
            //Prestasi
            Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
            Route::get('/data_prestasi', [PrestasiController::class, 'dataGet'])->name('prestasi.dataGet');
            Route::get('/prestasi/create', [PrestasiController::class, 'create'])->name('prestasi.create');
            Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
            Route::get('/prestasi/edit/{id}', [PrestasiController::class, 'edit'])->name('prestasi.edit');
            Route::post('/prestasi/update/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
            Route::delete('/prestasi/delete/{id}', [PrestasiController::class, 'delete'])->name('prestasi.delete');
            Route::post('/prestasi/accept/{id}', [PrestasiController::class, 'accept'])->name('prestasi.accept');

            // Route for updating status to "Ditolak" with a reason
            Route::post('/prestasi/reject/{id}', [PrestasiController::class, 'reject'])->name('prestasi.reject');
        });

        Route::prefix('administrator')->as('administrator.')->middleware(['auth:sanctum'])->group(
            base_path('routes/modules/administrator.php'),
        );

        Route::prefix('mahasantri')->as('mahasantri.')->middleware(['auth:sanctum'])->group(
            base_path('routes/modules/mahasantri.php'),
        );

        Route::prefix('bendahara')->as('bendahara.')->middleware(['auth:sanctum'])->group(
            base_path('routes/modules/bendahara.php'),
        );
    }
);
