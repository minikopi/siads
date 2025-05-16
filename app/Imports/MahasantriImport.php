<?php

namespace App\Imports;

use App\Models\AcademicYear;
use App\Models\Mahasantri;
use App\Models\Role;
use App\Models\User;
use App\Service\MahasantriService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\{
    Importable,
    SkipsEmptyRows,
    SkipsFailures,
    SkipsOnFailure,
    ToCollection,
    WithChunkReading,
    WithColumnFormatting,
    WithHeadingRow,
    WithSkipDuplicates,
    WithValidation
};
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MahasantriImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsEmptyRows, ShouldQueue, WithChunkReading, WithSkipDuplicates, WithColumnFormatting
{
    use Importable, SkipsFailures;

    public $academic_year;

    public function __construct(AcademicYear $academic_year)
    {
        $this->academic_year = $academic_year;
    }

    public function columnFormats(): array
    {
        return [
            // 'F' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            // 'P' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            // 'V' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            // 'AH' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'tanggal_lahir' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'tanggal_lahir_ayah' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'tanggal_lahir_ibu' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'tanggal_ijazah' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            if ($key === 0) continue;

            // check keunikan email
            $userCheck = User::firstWhere('email', $row['email']);
            $mahasantriCheck = Mahasantri::firstWhere('email', $row['email']);
            if ($userCheck || $mahasantriCheck) {
                Log::warning('Skip duplikat email mahasantri saat import', [
                    'action' => 'store mahasantri',
                    'data' => collect($row)->toArray(),
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
                    'kelas_id' => MahasantriService::createClass($this->academic_year, trim($row['jenis_kelamin']))->getKey(),
                    'wakaf' => trim($row['wakaf']),
                    'email' => trim($row['email']),
                    'handphone' => trim($row['nomor_handphone']),
                    'whatsapp' => trim($row['nomor_handphone']),
                    'nik' => trim($row['nik']),
                    'alamat' => trim($row['alamat']),
                    'kode_pos' => trim($row['kode_pos']),
                    'tanggal_lahir' => Carbon::parse(trim($row['tanggal_lahir']))->format('Y-m-d'),
                    'tempat_lahir' => trim($row['tempat_lahir']),
                    'suku' => trim($row['suku']),
                    'saudara' => trim($row['saudara']),
                    'anak_ke' => trim($row['anak_ke']),
                    'nama_ayah' => trim($row['nama_ayah']),
                    'tempat_ayah' => trim($row['tempat_lahir_ayah']),
                    'lahir_ayah' => Carbon::parse(trim($row['tanggal_lahir_ayah']))->format('Y-m-d'),
                    'pendidikan_ayah' => trim($row['pendidikan_terakhir_ayah']),
                    'pekerjaan_ayah' => trim($row['pekerjaan_ayah']),
                    'penghasilan_ayah' => trim($row['penghasilan_ayah']),
                    'nama_ibu' => trim($row['nama_ibu']),
                    'tempat_ibu' => trim($row['tempat_lahir_ibu']),
                    'lahir_ibu' => Carbon::parse(trim($row['tanggal_lahir_ibu']))->format('Y-m-d'),
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
                    'tanggal_ijazah' => Carbon::parse(trim($row['tanggal_ijazah']))->format('Y-m-d'),
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

                Log::warning($th->getMessage(), [
                    'action' => 'import mahasantri',
                    'data' => collect($row)->toArray(),
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

    // public function prepareForValidation($data, $index)
    // {
    //     info('data', collect($data)->toArray());
    //     //Fix that Excel's numeric date (counting in days since 1900-01-01)
    //     $data['tanggal_lahir'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data['tanggal_lahir'])->format('Y-m-d');
    //     $data['tanggal_lahir_ayah'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data['tanggal_lahir_ayah'])->format('Y-m-d');
    //     $data['tanggal_lahir_ibu'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data['tanggal_lahir_ibu'])->format('Y-m-d');
    //     $data['tanggal_ijazah'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data['tanggal_ijazah'])->format('Y-m-d');
    //     //...
    // }

    public function chunkSize(): int
    {
        return 100;
    }
}
