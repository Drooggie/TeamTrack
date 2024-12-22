<?php

namespace App\Payments;

use App\Models\Employee;

abstract class PaymentType
{
    public function __construct(
        private readonly Employee $employee
    ) {}

    abstract public function monthlyAmount(): int;
    abstract public function amount(): int;
    abstract public function type(): string;
}
