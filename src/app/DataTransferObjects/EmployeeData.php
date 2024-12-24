<?php

namespace App\DataTransferObjects;

use App\Enums\PaymentTypes;
use App\Http\Requests\UpsertEmployeeRequest;
use App\Models\Department;

class EmployeeData
{
    public function __construct(
        public readonly string $full_name,
        public readonly string $email,
        public readonly Department $department,
        public readonly string $job_title,
        public readonly string $payment_type,
        public readonly ?int $salary,
        public readonly ?int $hourly_rate
    ) {}

    public static function fromRequest(UpsertEmployeeRequest $request): self
    {
        return new static(
            $request->full_name,
            $request->email,
            $request->getDepartment(),
            $request->job_title,
            $request->payment_type,
            $request->salary,
            $request->hourly_rate,
        );
    }
}
