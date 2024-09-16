<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class PaymentTypePublish extends FormRequest
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
            'agree' => ['required', 'boolean'],
            'replace' => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'agree' => 'pertanyaan yakin untuk melakukan perubahan',
            'replace' => 'pertanyaan sadar tentang data mahasantri terdampak',
        ];
    }
}
