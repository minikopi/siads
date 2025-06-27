<?php

namespace App\Http\Requests\Master;

use App\Traits\UpdatedBy;
use Illuminate\Foundation\Http\FormRequest;

class AcademicYearUpdate extends FormRequest
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
            'start_year' => ['required', 'numeric'],
            // 'end_year' => ['required', 'numeric', 'gt:start_year'],
            'visible' => ['nullable', 'boolean'],
            'active' => ['nullable', 'boolean'],
            'registration' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'start_year' => 'tahun awal',
            'end_year' => 'tahun akhir',
            'visible' => 'status',
            'active' => 'tahun ajaran berjalan',
            'registration' => 'tahun ajaran baru'
        ];
    }
}
