<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Department;
use App\Models\Employee;
use Spatie\QueryBuilder\QueryBuilder;

class DepartmentEmployeeController extends Controller
{
    public function index($departmentUuid)
    {
        $department = Department::where('uuid', $departmentUuid)->firstOrFail();

        $employees = QueryBuilder::for(Employee::class)
            ->allowedFilters(['full_name', 'email', 'job_title'])
            ->whereBelongsTo($department)
            ->paginate(10);

        return EmployeeResource::collection($employees);
    }
}
