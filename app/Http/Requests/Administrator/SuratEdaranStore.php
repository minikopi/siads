<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Foundation\Http\FormRequest;

class SuratEdaranStore extends FormRequest
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
            'nama'   => 'required',
            'no'        => 'required',
            'tanggal'   => 'required',
            'file'      => 'required|file|mimes:pdf'
        ];
    }

    public function attributes(): array
    {
        return [
            'nama'      => 'perihal',
            'no'        => 'nomor edaran',
        ];
    }
}
