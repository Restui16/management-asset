<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
        $employeeId = $this->route('employee');
        return [
            'nik' => ['required'],
            'name' => ['required'],
            'user_id' => ['nullable'],
            'department_id' => ['required'],
            'job_id' => ['required'],
            'gender' => ['required'],
            'email' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required', 'min:11', 'max:13'],
            'photo' => ['nullable','image','file', 'mimes:png,jpg,jpeg,webp', 'max:2024']
        ];
    }
}
