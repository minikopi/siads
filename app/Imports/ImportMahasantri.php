<?php

namespace App\Imports;

use App\Models\AcademicYear;
use App\Models\Mahasantri;
use App\Models\Role;
use App\Models\User;
use App\Service\MahasantriService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportMahasantri implements ToCollection, WithHeadingRow
{
    public $academic_year, $error = [];

    public function __construct(AcademicYear $academic_year)
    {
        $this->academic_year = $academic_year;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);
        foreach ($collection as $row) {

            // check keunikan email
            $userCheck = User::firstWhere('email', $row['email']);
            $mahasantriCheck = Mahasantri::firstWhere('email', $row['email']);
            if ($userCheck || $mahasantriCheck) {
                Log::error(sprintf('Skip duplikat email mahasantri saat import: %s', $row['email']), [
                    'action' => 'import mahasantri',
                    'data' => collect($row)->toArray(),
                ]);
                continue;
            }

            // dd(Carbon::instance(Date::excelToDateTimeObject(intval($row['tanggal_lahir_ibu']))));

            try {
                DB::beginTransaction();

                $user = User::create([
                    'name'      => $row['nama_depan'] . " " . $row['nama_belakang'],
                    'email'     => $row['email'],
                    'password'  => password_hash('password', PASSWORD_DEFAULT),
                    'role'      => Role::Mahasantri,
                ]);

                $user->addRole(Role::Mahasantri);

                $user->mahasantri()->create([
                    'nama_depan' => trim($row['nama_depan']),
                    'nama_belakang' => trim($row['nama_belakang']),
                    'nim' => MahasantriService::createNim($this->academic_year),
                    'academic_year_id' => $this->academic_year->getKey(),
                    'kelas_id' => MahasantriService::createClass($this->academic_year, trim($row['jenis_kelamin']))->getKey(),
                    'wakaf' => trim(intval($row['wakaf'])),
                    'email' => trim($row['email']),
                    'handphone' => trim($row['nomor_handphone']),
                    'whatsapp' => trim($row['nomor_handphone']),
                    'nik' => trim($row['nik']),
                    'alamat' => trim($row['alamat']),
                    'kode_pos' => trim($row['kode_pos']),
                    'tanggal_lahir' => Carbon::instance(Date::excelToDateTimeObject(intval($row['tanggal_lahir']))),
                    // 'tanggal_lahir' => Carbon::parse(trim(intval($row['tanggal_lahir'])))->format('Y-m-d'),
                    'tempat_lahir' => trim($row['tempat_lahir']),
                    'suku' => trim($row['suku']),
                    'saudara' => trim($row['saudara']),
                    'anak_ke' => trim($row['anak_ke']),
                    'nama_ayah' => trim($row['nama_ayah']),
                    'tempat_ayah' => trim($row['tempat_lahir_ayah']),
                    'lahir_ayah' => Carbon::instance(Date::excelToDateTimeObject(intval($row['tanggal_lahir_ayah']))),
                    // 'lahir_ayah' => Carbon::parse(trim(intval($row['tanggal_lahir_ayah'])))->format('Y-m-d'),
                    'pendidikan_ayah' => trim($row['pendidikan_terakhir_ayah']),
                    'pekerjaan_ayah' => trim($row['pekerjaan_ayah']),
                    'penghasilan_ayah' => trim($row['penghasilan_ayah']),
                    'nama_ibu' => trim($row['nama_ibu']),
                    'tempat_ibu' => trim($row['tempat_lahir_ibu']),
                    'lahir_ibu' => Carbon::instance(Date::excelToDateTimeObject(intval($row['tanggal_lahir_ibu']))),
                    // 'lahir_ibu' => Carbon::parse(trim(intval($row['tanggal_lahir_ibu'])))->format('Y-m-d'),
                    'pendidikan_ibu' => trim($row['pendidikan_terakhir_ibu']),
                    'pekerjaan_ibu' => trim($row['pekerjaan_ibu']),
                    'penghasilan_ibu' => trim($row['penghasilan_ibu']),
                    'nama_wali' => trim($row['nama_wali']),
                    'alamat_wali' => trim($row['alamat_wali']),
                    'handphone_wali' => trim($row['handphone_wali']),
                    'whatsapp_wali' => trim($row['handphone_wali']),
                    'asal_sekolah' => trim($row['asal_sekolah']),
                    'alamat_sekolah' => trim($row['alamat_sekolah']),
                    'asal_pesantren' => trim($row['asal_pesantren']),
                    'alamat_pesantren' => trim($row['alamat_pesantren']),
                    'nomor_ijazah' => trim((string) $row['nomor_ijazah']),
                    'tanggal_ijazah' => Carbon::instance(Date::excelToDateTimeObject(intval($row['tanggal_ijazah']))),
                    // 'tanggal_ijazah' => Carbon::parse(trim(intval($row['tanggal_ijazah'])))->format('Y-m-d'),
                    'hobi' => trim($row['hobi']),
                    'golongan_darah' => trim($row['golongan_darah']),
                    'berat_badan' => trim($row['berat_badan']),
                    'tinggi_badan' => trim($row['tinggi_badan']),
                    'penyakit' => trim($row['riwayat_penyakit']),
                    'jenis_kelamin' => trim($row['jenis_kelamin']),
                    'kondisi_kemampuan' => trim($row['kemampuan'])
                ]);


                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();

                Log::error('Gagal import data mahasantri: ' . $th->getMessage(), [
                    'action' => 'import mahasantri',
                    'data' => collect($row)->toArray(),
                    'exception' => $th,
                ]);

                return back()->withInput()->with('error', 'Data Mahasantri Gagal Di-import!');
            }
        }
    }
}
