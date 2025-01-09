<?php

namespace App\Http\Requests\Master;

use App\Traits\CreatedBy;
use Illuminate\Foundation\Http\FormRequest;

class MahasantriStore extends FormRequest
{
    use CreatedBy;
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
            'nama_depan' => ['nullable', 'string', 'max:150'],
            'nama_belakang' => ['nullable', 'string', 'max:150'],
            'academic_year_id' => ['nullable', 'numeric', 'exists:academic_years,id'],
            'wakaf' => ['nullable', 'numeric'],
            'jenis_kelamin' => ['nullable', 'string', 'max:20'],
            'kelas_id' => ['nullable', 'numeric', 'exists:classes,id'],
            'nik' => ['nullable', 'numeric', 'min_digits:16'],
            'email' => ['nullable', 'email', 'max:200'],
            'handphone' => ['nullable', 'string', 'max:50'],
            'alamat' => ['nullable', 'string', 'max:250'],
            'kode_pos' => ['nullable', 'numeric', 'min_digits:5'],
            'tempat_lahir' => ['nullable', 'string', 'max:250'],
            'tanggal_lahir' => ['nullable', 'date'],
            'suku' => ['nullable', 'string', 'max:250'],
            'anak_ke' => ['nullable', 'numeric', 'min:1'],
            'saudara' => ['nullable', 'numeric', 'min:1'],
            'hobi' => ['nullable', 'string', 'max:250'],
            'golongan_darah' => ['nullable', 'string', 'max:250'],
            'berat_badan' => ['nullable', 'numeric', 'min:1'],
            'tinggi_badan' => ['nullable', 'numeric', 'min:1'],
            'penyakit' => ['nullable', 'string', 'max:250'],
            'kondisi_kemampuan' => ['nullable', 'string', 'max:250'],
            'foto' => ['nullable', 'image', 'max:2048'],

            // DATA AYAH
            'nama_ayah' => ['nullable', 'string', 'max:250'],
            'tempat_ayah' => ['nullable', 'string', 'max:250'],
            'lahir_ayah' => ['nullable', 'date'],
            'pendidikan_ayah' => ['nullable', 'string', 'max:250'],
            'pekerjaan_ayah' => ['nullable', 'string', 'max:250'],
            'penghasilan_ayah' => ['nullable', 'string', 'max:250'],

            // DATA IBU
            'nama_ibu' => ['nullable', 'string', 'max:250'],
            'tempat_ibu' => ['nullable', 'string', 'max:250'],
            'lahir_ibu' => ['nullable', 'date'],
            'pendidikan_ibu' => ['nullable', 'string', 'max:250'],
            'pekerjaan_ibu' => ['nullable', 'string', 'max:250'],
            'penghasilan_ibu' => ['nullable', 'string', 'max:250'],

            // DATA WALI
            'nama_wali' => ['nullable', 'string', 'max:250'],
            'alamat_wali' => ['nullable', 'string', 'max:250'],
            'handphone_wali' => ['nullable', 'string', 'max:50'],

            // RIWAYAT PRIBADI
            'asal_sekolah' => ['nullable', 'string', 'max:250'],
            'alamat_sekolah' => ['nullable', 'string', 'max:250'],
            'nomor_ijazah' => ['nullable', 'string', 'max:250'],
            'tanggal_ijazah' => ['nullable', 'date'],
            'asal_pesantren' => ['nullable', 'string', 'max:250'],
            'alamat_pesantren' => ['nullable', 'string', 'max:250'],
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
