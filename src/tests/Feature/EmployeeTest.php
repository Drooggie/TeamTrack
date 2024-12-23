<?php

use App\Enums\PaymentTypes;
use App\Models\Department;
use App\Models\Employee;

it('should create an employee', function () {
    $fullName = 'Full Name';
    $email = 'someEmail@mail.com';
    $departmentId = Department::factory()->create()->id;
    $jobTitle = 'Some Job Title';
    $paymentType = 'salary';
    $salary = 1000000;

    $response = $this->postJson(route('v1.employees.store'), [
        'full_name' => $fullName,
        'email' => $email,
        'department_id' => $departmentId,
        'job_title' => $jobTitle,
        'payment_type' => $paymentType,
        'salary' => $salary
    ])->json('data');

    expect($response)
        ->attributes->full_name->toBe($fullName)
        ->attributes->email->toBe($email)
        ->attributes->job_title->toBe($jobTitle)
        ->attributes->department_id->toBe($departmentId)
        ->attributes->salary->toBe($salary)
    ;
});

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

it('should return 422 if salary or hourlyRate is missing', function (string $paymentType, ?string $salary, ?string $hourlyRate) {
    $this->postJson(route('v1.employees.store', [
        'full_name' => 'full name',
        'email' => 'email@example.com',
        'department_id' => Department::factory()->create()->uuid,
        'job_title' => 'job title',
        'payment_type' => $paymentType,
        'salary' => $salary,
        'hourly_rate' => $hourlyRate,
    ]))->assertInvalid();
})->with([
    ['paymentType' => 'salary', 'salary' => null, 'hourlyRate' => 10 * 100],
    ['paymentType' => 'salary', 'salary' => 0, 'hourlyRate' => null],
    ['paymentType' => 'hourlyRate', 'salary' => 750000 * 100, 'hourlyRate' => null],
    ['paymentType' => 'hourlyRate', 'salary' => null, 'hourlyRate' => 0],
]);
