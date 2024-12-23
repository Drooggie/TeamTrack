<?php

namespace App\Http\Controllers;

use App\Actions\Department\UpsertEmployeeAction;
use App\DataTransferObjects\EmployeeData;
use App\Http\Requests\UpsertEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    public function __construct(
        private readonly UpsertEmployeeAction $upsertEmployee
    ) {}

    public function store(UpsertEmployeeRequest $request)
    {
        $employee = $this->upsert($request, new Employee());

        return EmployeeResource::make($employee)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function upsert(UpsertEmployeeRequest $request, Employee $employee): Employee
    {
        $data = new EmployeeData(...$request->validated());

        return $this->upsertEmployee->execute($employee, $data);
    }
}
