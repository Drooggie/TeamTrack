<?php

namespace App\Http\Controllers;

use App\Actions\Department\UpsertEmployeeAction;
use App\DataTransferObjects\EmployeeData;
use App\Http\Requests\GetEmployeeRequest;
use App\Http\Requests\UpsertEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class EmployeeController extends Controller
{
    public function __construct(
        private readonly UpsertEmployeeAction $upsertEmployee
    ) {}

    public function index()
    {
        $employees = QueryBuilder::for(Employee::class)
            ->allowedFilters(['full_name', 'job_title', 'email', 'department.name'])
            ->allowedIncludes(['department'])
            ->paginate(10);

        return EmployeeResource::collection($employees);
    }

    public function store(UpsertEmployeeRequest $request)
    {
        $employee = $this->upsert($request, new Employee());

        return EmployeeResource::make($employee)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpsertEmployeeRequest $request, $employeeUuid): Response
    {
        $employee = Employee::where('uuid', $employeeUuid)->first();

        $this->upsert($request, $employee);

        return response()->noContent();
    }

    public function upsert(UpsertEmployeeRequest $request, Employee $employee): Employee
    {
        $data = EmployeeData::fromRequest($request);

        return $this->upsertEmployee->execute($employee, $data);
    }
}
