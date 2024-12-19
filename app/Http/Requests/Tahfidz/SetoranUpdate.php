<?php

namespace App\Http\Requests\Tahfidz;

use Illuminate\Foundation\Http\FormRequest;

class SetoranUpdate extends FormRequest
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
            'juz_number' => ['required', 'numeric', 'min:1', 'max:30'],
            'page_number' => ['required', 'numeric', 'min:1', 'max:20'],
        ];
    }
}
