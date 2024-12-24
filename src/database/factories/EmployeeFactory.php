<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Department;
use App\Models\Employee;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'department_id' => Department::factory(),
            'job_title' => fake()->jobTitle(),
            'payment_type' => fake()->randomElement(['salary', 'hourly_rate']),
            'salary' => fake()->numberBetween(4000000, 14000000),
            'hourly_rate' => fake()->numberBetween(5000, 15000),
        ];
    }
}
