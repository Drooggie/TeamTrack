<?php

use App\Enums\PaymentTypes;
use App\Models\Department;

it('should create an employee', function () {
    $fullName = 'Full Name';
    $email = 'someEmail@mail.com';
    $departmentId = Department::factory()->create()->id;
    $jobTitle = 'Some Job Title';
    $paymentType = PaymentTypes::SALARY;
    $salary = 1000000;

    $response = $this->postJson(route('v1.employees.store'), [
        'full_name' => $fullName,
        'email' => $email,
        'department_id' => $departmentId,
        'job_title' => $jobTitle,
        'payment_type' => $paymentType,
        'salary' => $salary
    ])->json();

    dd($response);

    expect($response)
        ->attributes->full_name->toBe($fullName)
        ->attributes->email->toBe($email)
        ->attributes->job_title->toBe($jobTitle)
        ->attributes->department_id->toBe($departmentId)
        ->attributes->payment_type->toBe($paymentType)
        ->attributes->salary->toBe($salary)
    ;
});
