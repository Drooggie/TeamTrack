<?php

use App\Enums\PaymentTypes;
use App\Models\Department;
use App\Models\Employee;

it('should return 422 if email is invalid', function (?string $email) {
    Employee::factory([
        'email' => 'emailtotest@example.com'
    ])->create();

    $this->postJson(route('v1.employees.store'), [
        'full_name' => 'full name',
        'email' => $email,
        'department_id' => Department::factory()->create()->id,
        'job_title' => 'test job title',
        'payment_type' => 'salary',
        'salary' => 75000 * 100
    ])->assertInvalid('email');
})->with([
    'emailtotest@example.com',
    'invalid',
    null,
    '',
]);

it('should return 422 if payment_type is invalid', function () {
    $this->postJson(route('v1.employees.store'), [
        'full_name' => 'full name',
        'email' => 'email@example.com',
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'job title',
        'payment_type' => 'invalid',
        'salary' => 75000 * 100
    ])->assertInvalid('payment_type');
});

it('should return 422 if salary or hourly_rate is missing', function (string $paymentType, ?int $salary, ?int $hourly_rate) {
    $this->postJson(route('v1.employees.store', [
        'full_name' => 'full name',
        'email' => 'email@example.com',
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'job title',
        'payment_type' => $paymentType,
        'salary' => $salary,
        'hourly_rate' => $hourly_rate,
    ]))->assertInvalid($paymentType);
})->with([
    ['paymentType' => 'salary', 'salary' => null, 'hourly_rate' => 10 * 100],
    ['paymentType' => 'salary', 'salary' => 0, 'hourly_rate' => null],
    ['paymentType' => 'hourly_rate', 'salary' => 750000 * 100, 'hourly_rate' => null],
    ['paymentType' => 'hourly_rate', 'salary' => null, 'hourly_rate' => 0],
]);

it('should create employee with salary payment_type', function () {
    $department = Department::factory()->create();

    $response = $this->postJson(route('v1.employees.store'), [
        'full_name' => 'full name',
        'email' => 'testSalary@example.com',
        'department_id' => $department->uuid,
        'job_title' => 'job title',
        'payment_type' => 'salary',
        'salary' => 75000 * 100,
    ])->json('data');

    expect($response)
        ->attributes->full_name->toBe('full name')
        ->attributes->email->toBe('testSalary@example.com')
        ->attributes->department_id->toBe($department->id)
        ->attributes->job_title->toBe('job title')
        ->attributes->payment_type->type->toBe('salary')
        ->attributes->payment_type->amount->cents->toBe(75000 * 100)
        ->attributes->payment_type->amount->dollars->toBe('$75,000.00')
    ;
});

it('should create employee with hourly rate payment_type', function () {
    $department = Department::factory()->create();

    $response = $this->postJson(route('v1.employees.store'), [
        'full_name' => 'full name',
        'email' => 'testhourly_rate@example.com',
        'department_id' => $department->uuid,
        'job_title' => 'job title',
        'payment_type' => 'hourly_rate',
        'hourly_rate' => 12 * 100,
    ])->json('data');

    expect($response)
        ->attributes->full_name->toBe('full name')
        ->attributes->email->toBe('testhourly_rate@example.com')
        ->attributes->department_id->toBe($department->id)
        ->attributes->job_title->toBe('job title')
        ->attributes->payment_type->type->toBe('hourly_rate')
        ->attributes->payment_type->amount->cents->toBe(12 * 100)
        ->attributes->payment_type->amount->dollars->toBe('$12.00')
    ;
});
