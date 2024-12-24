<?php

namespace App\Http\Resources;

use App\ValueObjects\Money;
use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;
use TiMacDonald\JsonApi\Link;

class EmployeeResource extends JsonApiResource
{

    public function toAttributes(Request $request)
    {

        return [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'department_id' => $this->department_id,
            'job_title' => $this->job_title,
            'payment_type' => [
                'type' => $this->payment_type->type(),
                'amount' => [
                    'cents' => (new Money($this->payment_type->amount()))->toCents(),
                    'dollars' => (new Money($this->payment_type->amount()))->toDollars(),
                ]
            ],
        ];
    }

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
