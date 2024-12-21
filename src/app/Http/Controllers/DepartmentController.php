<?php

namespace App\Http\Controllers;

use App\Actions\Department\CreateDepartmentAction;
use App\DataTransferObjects\DepartmentData;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    public function store(DepartmentStoreRequest $request)
    {
        $departmentData = new DepartmentData(...$request->validated());
        $department = (new CreateDepartmentAction)->create($departmentData);

        return DepartmentResource::make($department)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
