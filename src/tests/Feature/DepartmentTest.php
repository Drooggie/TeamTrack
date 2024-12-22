<?php

use App\Models\Department;

it('should create a department', function () {
    $name = "department name";
    $description = "department description";

    $department = $this->postJson(route('v1.departments.store'), [
        "name" => $name,
        "description" => $description,
    ])->json('data');

    expect($department)
        ->attributes->name->toBe($name)
        ->attributes->description->toBe($description);
});

it('should return 422 if name is invalid', function (?string $name) {
    Department::factory([
        'name' => "Some Department"
    ])->create();

    $this->postJson(route('v1.departments.store'), [
        'name' => $name,
        'description' => "some Description"
    ])->assertInvalid(['name']);
})->with(['', null, "Some Department"]);

it('should store identical information for name and description', function () {
    $identical = 'identical';

    $response = $this->postJson(route('v1.departments.store'), [
        'name' => $identical,
        'description' => $identical
    ]);

    $response->assertStatus(201);
});


it('should update a department', function () {
    $department = Department::factory([
        'name' => 'some name',
    ])->create();

    $name = 'some updated name';
    $description = 'updated description';

    $this->patchJson(route('v1.departments.update', $department->uuid), [
        'name' => $name,
        'description' => $description,
    ])->assertStatus(204);

    expect(Department::find($department->id))
        ->name->toBe($name)
        ->description->toBe($description);
});
