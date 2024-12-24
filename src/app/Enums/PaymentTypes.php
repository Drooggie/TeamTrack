<?php

namespace App\Enums;

use App\Models\Employee;
use App\Payments\HourlyRate;
use App\Payments\PaymentType;
use App\Payments\Salary;

enum PaymentTypes: string
{
    case SALARY = 'salary';
    case HOURLY_RATE = 'hourly_rate';

    public function makePaymentType(Employee $employee): PaymentType
    {
        return match ($this) {
            self::SALARY => new Salary($employee),
            self::HOURLY_RATE => new HourlyRate($employee),
        };
    }
}
