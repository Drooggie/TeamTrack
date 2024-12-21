<?php

namespace App\Actions\Department;

use App\DataTransferObjects\DepartmentData;
use App\Models\Department;

class CreateDepartmentAction
{
    public function create(DepartmentData $data): Department
    {
        return Department::create([
            'name' => $data->name,
            'description' => $data->description
        ]);
    }
}
