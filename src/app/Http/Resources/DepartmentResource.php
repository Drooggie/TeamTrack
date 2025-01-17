<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;
use TiMacDonald\JsonApi\Link;

class DepartmentResource extends JsonApiResource
{
    public array $attributes = [
        'name',
        'description',
    ];

    public function toRelationships(Request $request)
    {
        return [
            'employees' => fn() => EmployeeResource::collection($this->employees)
        ];
    }

    public function toLinks(Request $request)
    {
        return [
            Link::self(route('v1.departments.show', $this->uuid)),
        ];
    }
}
