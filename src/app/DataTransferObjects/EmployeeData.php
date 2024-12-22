<?php

namespace App\DataTransferObjects;

use App\Enums\PaymentTypes;

class EmployeeData
{
    public function __construct(
        public readonly string $full_name,
        public readonly string $email,
        public readonly int $department_id,
        public readonly string $job_title,
        public readonly PaymentTypes $payment_type,
        public readonly int $salary
    ) {}
}
