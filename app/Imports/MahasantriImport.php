<?php

namespace App\Imports;

use App\Models\AcademicYear;
use App\Models\Mahasantri;
use App\Models\Role;
use App\Models\User;
use App\Service\MahasantriService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\{
    Importable,
    SkipsEmptyRows,
    SkipsFailures,
    SkipsOnFailure,
    ToCollection,
    WithHeadingRow,
    WithValidation
};

class MahasantriImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsEmptyRows
{
    use Importable, SkipsFailures;

    public function __construct(public readonly AcademicYear $academic_year)
    {
        //
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            // skip contoh data
            if ($key === 0) continue;

            // check keunikan email
            $userCheck = User::firstWhere('email', $row['email']);
            $mahasantriCheck = Mahasantri::firstWhere('email', $row['email']);
            if ($userCheck || $mahasantriCheck) {
                Log::warning('Skip duplikat email mahasantri saat import', [
                    'action' => 'store mahasantri',
                    'data' => $row,
                ]);
                continue;
            }

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
                    'wakaf' => trim($row['wakaf']),
                    'email' => trim($row['email']),
                    'handphone' => trim($row['handphone']),
                    'whatsapp' => trim($row['handphone']),
                    'nik' => trim($row['nik']),
                    'alamat' => trim($row['alamat']),
                    'kode_pos' => trim($row['kode_pos']),
                    'tanggal_lahir' => trim($row['tanggal_lahir']),
                    'tempat_lahir' => trim($row['tempat_lahir']),
                    'suku' => trim($row['suku']),
                    'saudara' => trim($row['saudara']),
                    'anak_ke' => trim($row['anak_ke']),
                    'nama_ayah' => trim($row['nama_ayah']),
                    'tempat_ayah' => trim($row['tempat_lahir_ayah']),
                    'lahir_ayah' => trim($row['tanggal_lahir_ayah']),
                    'pendidikan_ayah' => trim($row['pendidikan_terakhir_ayah']),
                    'pekerjaan_ayah' => trim($row['pekerjaan_ayah']),
                    'penghasilan_ayah' => trim($row['penghasilan_ayah']),
                    'nama_ibu' => trim($row['nama_ibu']),
                    'tempat_ibu' => trim($row['tempat_lahir_ibu']),
                    'lahir_ibu' => trim($row['tanggal_lahir_ibu']),
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
                    'nomor_ijazah' => trim($row['nomor_ijazah']),
                    'tanggal_ijazah' => trim($row['tanggal_ijazah']),
                    'hobi' => trim($row['hobi']),
                    'golongan_darah' => trim($row['golongan_darah']),
                    'berat_badan' => trim($row['berat_badan']),
                    'tinggi_badan' => trim($row['tinggi_badan']),
                    'penyakit' => trim($row['riwayat_penyakit']),
                    'jenis_kelamin' => trim($row['jenis_kelamin']),
                    'kondisi_kemampuan' => trim($row['kemampuan']),
                    'nama_depan' => trim($row['nama_depan']),
                ]);


                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();

                Log::warning($th->getMessage(), [
                    'action' => 'import mahasantri',
                    'data' => $row,
                ]);
            }
        }
    }

    public function headingRow(): int
    {
        return 5;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',

            // Above is alias for as it always validates in batches
            '*.email' => 'required|email',
        ];
    }
}
