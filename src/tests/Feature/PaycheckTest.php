<?php

use App\Enums\PaymentTypes;
use App\Models\Employee;

it('should create paychecks for salary', function () {
    $employees = Employee::factory()
        ->count(2)
        ->sequence(
            [
                'salary' => 75000 * 100,
                'payment_type' => PaymentTypes::SALARY->value,
            ],
            [
                'salary' => 50000 * 100,
                'payment_type' => PaymentTypes::SALARY->value,
            ]
        )
        ->create();

    $this->postJson(route('payday.store'))->assertNoContent();

    $this->assertDatabaseHas('paycheks', [
        'employee_id' => $employees[1]->id,
        'net_amount' => 583333,
    ]);
    $this->assertDatabaseHas('paycheks', [
        'employee_id' => $employees[0]->id,
        'net_amount' => 416666,
    ]);
});
