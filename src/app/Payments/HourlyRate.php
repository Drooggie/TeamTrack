<?php

namespace App\Payments;

class HourlyRate extends PaymentType
{
    public function monthlyAmount(): int
    {
        return $this->employee->hourly_rate * 160;
    }

    public function amount(): int
    {
        return $this->employee->hourly_rate;
    }

    public function type(): string
    {
        return 'hourly_rate';
    }
}
