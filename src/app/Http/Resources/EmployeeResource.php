<?php

namespace App\Http\Resources;

use App\Models\Employee;
use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;
use TiMacDonald\JsonApi\Link;

class EmployeeResource extends JsonApiResource
{
    public array $attributes = [
        'full_name',
        'email',
        'department_id',
        'job_title',
        'payment_type',
        'salary'
    ];

    public function toRelationships(Request $request)
    {
        return [
            'department' => DepartmentResource::make($this->department),
        ];
    }

    public function toLinks(Request $request)
    {
        return [
            Link::self(route('v1.employees.show', $this->uuid))
        ];
    }
}
