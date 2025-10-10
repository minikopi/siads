<?php

namespace App\Http\Requests\Takhrij;

use Illuminate\Foundation\Http\FormRequest;

class TrialPointStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('panitia_takhrij');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'code' => 'required|max:30|unique:trial_points',
            'sequence' => 'required|numeric|gt:0',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'poin',
            'code' => 'kode',
            'sequence' => 'urutan'
        ];
    }
}
