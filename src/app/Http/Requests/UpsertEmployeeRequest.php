<?php

namespace App\Http\Requests;

use App\Enums\PaymentTypes;
use App\Models\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpsertEmployeeRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', Rule::unique('employees', 'email')->ignore($this->employee)],
            'department_id' => ['required', Rule::exists(Department::class, 'id')],
            'job_title' => ['required', 'string', 'max:100'],
            'payment_type' => ['required', new Enum(PaymentTypes::class)],
            'salary' => ['nullable', 'sometimes', 'int'],
            'hourly_rate' => ['nullable', 'sometimes', 'int'],
        ];
    }
}
