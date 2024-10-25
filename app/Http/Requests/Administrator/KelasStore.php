<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Foundation\Http\FormRequest;

class KelasStore extends FormRequest
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
            'tahun_ajaran'  => 'required',
            'gender'        => 'required',
            'dosen_id'      => 'required|exists:dosens,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'gender'        => 'jenis kelamin',
            'dosen_id'      => 'musyrif',
        ];
    }
}
