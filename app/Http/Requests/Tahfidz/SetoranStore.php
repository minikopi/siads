<?php

namespace App\Http\Requests\Tahfidz;

use Illuminate\Foundation\Http\FormRequest;

class SetoranStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('tahfidz');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mahasantri_id' => ['required', 'numeric', 'exists:mahasantris,id'],
            'juz_number' => ['required', 'numeric', 'min:1', 'max:30'],
        ];
    }

    public function attributes(): array
    {
        return [
            'mahasantri_id' => 'nama mahasantri',
            'juz_number' => 'juz'
        ];
    }
}
