<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Foundation\Http\FormRequest;

class KalenderAkademikUpdate extends FormRequest
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
            'nama'          => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
            'semester'      => 'required',
            'tahun_ajaran'  => 'required',
            'keterangan'    => 'nullable',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama'          => 'nama agenda',
        ];
    }
}
