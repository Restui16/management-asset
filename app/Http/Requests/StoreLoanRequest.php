<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'loan_code' => ['required'],
            'asset_id' => ['required', 'array'],
            'asset_id.*' => 'exists:assets,id',
            'employee_id' => ['required'],
            'loan_date' => ['required'],
            'return_date' => ['nullable'],
            'photo_receipt' => ['nullable', 'image', 'file', 'mimes:png,jpg,jpeg,webp', 'max:1048'],
            'signature_employee' => ['required'],
            'signature_admin' => ['required'],
            'notes' => ['nullable']
        ];
    }
}
