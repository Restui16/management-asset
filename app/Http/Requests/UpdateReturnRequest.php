<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReturnRequest extends FormRequest
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
            'return_code' => ['required'],
            'loan_id' => ['required'],
            'return_date' => ['required'],
            'condition' => ['required'],
            'notes' => ['nullable'],
            'photo_receipt' => ['nullable', 'image', 'file', 'mimes:png,jpg,jpeg,webp', 'max:1048'],
        ];
    }
}
