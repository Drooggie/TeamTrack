<?php

namespace App\Payments;

class Salary extends PaymentType
{
    public function monthlyAmount(): int
    {
        return 5;
    }

    public function amount(): int
    {
        return 5;
    }

    public function type(): string
    {
        return '4';
    }
}
