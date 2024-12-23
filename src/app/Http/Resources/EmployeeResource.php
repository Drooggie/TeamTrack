<?php

namespace App\Http\Resources;

use App\Models\Employee;
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
                    'cent' => $this->payment_type->amount(),
                    'montly' => $this->payment_type->monthlyAmount()
                ]
            ],
            'salary' => $this->salary,
            'hourly_rate' => $this->hourly_rate
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
