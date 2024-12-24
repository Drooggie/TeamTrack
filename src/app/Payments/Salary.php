<?php

namespace App\Payments;

class Salary extends PaymentType
{
    public function monthlyAmount(): int
    {
        return $this->employee->salary / 12;
    }

    public function amount(): int
    {
        return $this->employee->salary;
    }

    public function type(): string
    {
        return 'salary';
    }
}
