<?php

namespace App\Http\Requests\Master;

use App\Traits\UpdatedBy;
use Illuminate\Foundation\Http\FormRequest;

class MahasantriUpdate extends FormRequest
{
    use UpdatedBy;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // DATA DIRI MAHASANTRI
            'nama_depan' => ['required', 'string', 'max:150'],
            'nama_belakang' => ['required', 'string', 'max:150'],
            'nik' => ['required', 'numeric', 'min_digits:16'],
            'email' => ['required', 'email', 'max:200'],
            'handphone' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string', 'max:250'],
            'kode_pos' => ['required', 'numeric', 'min_digits:5'],
            'tempat_lahir' => ['required', 'string', 'max:250'],
            'tanggal_lahir' => ['required', 'date'],
            'suku' => ['required', 'string', 'max:250'],
            'anak_ke' => ['required', 'numeric', 'min:1'],
            'saudara' => ['required', 'numeric', 'min:1'],
            'hobi' => ['required', 'string', 'max:250'],
            'golongan_darah' => ['required', 'string', 'max:250'],
            'berat_badan' => ['required', 'numeric', 'min:1'],
            'tinggi_badan' => ['required', 'numeric', 'min:1'],
            'penyakit' => ['required', 'string', 'max:250'],
            'kondisi_kemampuan' => ['required', 'string', 'max:250'],
            'foto' => ['nullable', 'image', 'max:2048'],

            // DATA AYAH
            'nama_ayah' => ['required', 'string', 'max:250'],
            'tempat_ayah' => ['required', 'string', 'max:250'],
            'lahir_ayah' => ['required', 'date'],
            'pendidikan_ayah' => ['required', 'string', 'max:250'],
            'pekerjaan_ayah' => ['required', 'string', 'max:250'],
            'penghasilan_ayah' => ['required', 'string', 'max:250'],

            // DATA IBU
            'nama_ibu' => ['required', 'string', 'max:250'],
            'tempat_ibu' => ['required', 'string', 'max:250'],
            'lahir_ibu' => ['required', 'date'],
            'pendidikan_ibu' => ['required', 'string', 'max:250'],
            'pekerjaan_ibu' => ['required', 'string', 'max:250'],
            'penghasilan_ibu' => ['required', 'string', 'max:250'],

            // DATA WALI
            'nama_wali' => ['required', 'string', 'max:250'],
            'alamat_wali' => ['required', 'string', 'max:250'],
            'handphone_wali' => ['required', 'string', 'max:50'],

            // RIWAYAT PRIBADI
            'asal_sekolah' => ['required', 'string', 'max:250'],
            'alamat_sekolah' => ['required', 'string', 'max:250'],
            'nomor_ijazah' => ['required', 'string', 'max:250'],
            'tanggal_ijazah' => ['required', 'date'],
            'asal_pesantren' => ['required', 'string', 'max:250'],
            'alamat_pesantren' => ['required', 'string', 'max:250'],
        ];
    }

    public function attributes(): array
    {
        return [
            'academic_year_id' => 'tahun ajaran',
            'kelas_id' => 'kelas',
            'penyakit' => 'riwayat penyakit',
        ];
    }
}
