<?php

namespace App\Http\Controllers;

use App\Actions\Department\UpsertDepartmentAction;
use App\DataTransferObjects\DepartmentData;
use App\Http\Requests\UpsertDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    public function __construct(
        private readonly UpsertDepartmentAction $upsertDepartment,
    ) {}

    public function index()
    {
        return DepartmentResource::collection(Department::all());
    }

    public function show($departmentUuid)
    {
        $department = Department::where('uuid', $departmentUuid)->first();

        return DepartmentResource::make($department);
    }

    public function store(UpsertDepartmentRequest $request)
    {
        $department = $this->upsert($request, new Department());

        return DepartmentResource::make($department)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpsertDepartmentRequest $request, $departmentUuid)
    {
        $department = Department::where('uuid', $departmentUuid)->first();

        $this->upsert($request, $department);

        return response()->noContent();
    }

    private function upsert(
        UpsertDepartmentRequest $request,
        Department $department,
    ): Department {
        $data = new DepartmentData(...$request->validated());

        return $this->upsertDepartment->execute($department, $data);
    }
}
