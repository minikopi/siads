<?php

namespace App\Http\Requests\Bendahara;

use App\Traits\CreatedBy;
use Illuminate\Foundation\Http\FormRequest;

class MasterPaymentStore extends FormRequest
{
    use CreatedBy;
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
            'payment_type_id' => ['required', 'numeric', 'exists:payment_types,id'],
            'semester' => ['required', 'numeric', 'min:0'],
            'installment' => ['required', 'boolean'],
            'total' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['required', 'date'],
            'note' => ['nullable', 'string']
        ];
    }

    public function attributes(): array
    {
        return [
            'payment_type_id' => 'nama pembayaran',
            'installment' => 'cicilan',
            'discount' => 'potongan',
            'total' => 'nominal',
            'due_date' => 'jatuh tempo',
            'note' => 'catatan'
        ];
    }
}
