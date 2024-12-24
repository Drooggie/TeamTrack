<?php

namespace App\Actions\Department;

use App\DataTransferObjects\EmployeeData;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpsertEmployeeAction
{
    public function execute(Employee $employee, EmployeeData $data): Employee
    {
        $this->validate($data);

        $employee->full_name = $data->full_name;
        $employee->email = $data->email;
        $employee->department_id = $data->department->id;
        $employee->job_title = $data->job_title;
        $employee->payment_type = $data->payment_type;
        $employee->salary = $data->salary;
        $employee->hourly_rate = $data->hourly_rate;
        $employee->save();

        return $employee;
    }

    private function validate(EmployeeData $data)
    {
        $rules = [
            $data->payment_type => [
                'required',
                'numeric',
                Rule::notIn([0]),
            ],
        ];

        $validation = Validator::make([
            'payment_type' => $data->payment_type,
            'salary' => $data->salary,
            'hourly_rate' => $data->hourly_rate,
        ], $rules);

        $validation->validate();
    }
}
