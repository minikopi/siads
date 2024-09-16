<?php

namespace App\Http\Requests\Master;

use App\Traits\UpdatedBy;
use Illuminate\Foundation\Http\FormRequest;

class PaymentTypeUpdate extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'numeric', 'in:1,2,3'],
            'nominal' => ['required', 'numeric', 'min:1'],
            'academic_year_id' => ['required', 'numeric', 'exists:academic_years,id'],
            'due_date' => ['required', 'date'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nama',
            'type' => 'tipe pembayaran',
            'academic_year_id' => 'tahun ajaran',
            'due_date' => 'jatuh tempo'
        ];
    }
}
