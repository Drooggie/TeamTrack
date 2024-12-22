<?php

namespace App\Actions\Department;

use App\DataTransferObjects\DepartmentData;
use App\Models\Department;

class UpsertDepartmentAction
{
    public function execute(Department $department, DepartmentData $data)
    {
        $department->name = $data->name;
        $department->description = $data->description;
        $department->save();

        return $department;
    }
}
