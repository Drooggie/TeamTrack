<?php

namespace App\Actions\Department;

use App\DataTransferObjects\EmployeeData;
use App\Models\Employee;

class UpsertEmployeeAction
{
    public function execute(Employee $employee, EmployeeData $data): Employee
    {


        $employee->full_name = $data->full_name;
        $employee->email = $data->email;
        $employee->department_id = $data->department_id;
        $employee->job_title = $data->job_title;
        $employee->payment_type = $data->payment_type;
        $employee->salary = $data->salary;
        $employee->save();

        return $employee;
    }
}
