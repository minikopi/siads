<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class MahasantriProfileUpdateRequest extends FormRequest
{
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
            'nama_depan' => 'nullable|string',
            'nama_belakang' => 'nullable|string',
            'email' => 'nullable|string',
            'handphone' => 'nullable|string',
            'nik' => 'nullable|string|size:16',
            'anak_ke' => 'nullable|string',
            'kondisi_kemampuan' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kode_pos' => 'nullable|string',
            'tanggal_lahir' => 'nullable|string',
            'suku' => 'nullable|string',
            'saudara' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'foto' => 'nullable|string',
            'nama_ayah' => 'nullable|string',
            'tempat_ayah' => 'nullable|string',
            'lahir_ayah' => 'nullable|string',
            'pendidikan_ayah' => 'nullable|string',
            'pekerjaan_ayah' => 'nullable|string',
            'penghasilan_ayah' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
            'tempat_ibu' => 'nullable|string',
            'lahir_ibu' => 'nullable|string',
            'pendidikan_ibu' => 'nullable|string',
            'pekerjaan_ibu' => 'nullable|string',
            'penghasilan_ibu' => 'nullable|string',
            'nama_wali' => 'nullable|string',
            'alamat_wali' => 'nullable|string',
            'handphone_wali' => 'nullable|string',
            'whatsapp_wali' => 'nullable|string',
            'asal_sekolah' => 'nullable|string',
            'alamat_sekolah' => 'nullable|string',
            'nomor_ijazah' => 'nullable|string',
            'tanggal_ijazah' => 'nullable|string',
            'asal_pesantren' => 'nullable|string',
            'alamat_pesantren' => 'nullable|string',
            'hobi' => 'nullable|string',
            'golongan_darah' => 'nullable|string',
            'berat_badan' => 'nullable|string',
            'tinggi_badan' => 'nullable|string',
            'penyakit' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
        ];
    }
}
