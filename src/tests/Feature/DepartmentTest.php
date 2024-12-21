<?php

use App\Models\Department;

it('should create a department', function () {
    $name = "department name";
    $description = "department description";

    $department = $this->postJson(route('departments.store'), [
        "name" => $name,
        "description" => $description,
    ])->json('data');

    expect($department)
        ->attributes->name->toBe($name)
        ->attributes->description->toBe($description);
});

it('should return 422 if name is invalid', function () {
    $name = "Some Department";

    Department::factory([
        'name' => $name
    ])->create();

    $this->postJson(route('departments.store'), [
        'name' => $name,
    ])->assertInvalid('name');
})->with(['', null, "Some Department"]);
