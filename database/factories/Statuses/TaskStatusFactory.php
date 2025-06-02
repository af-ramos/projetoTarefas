<?php

namespace Database\Factories\Statuses;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskStatusFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description' => $this->faker->randomElement(['TO DO', 'IN PROGRESS', 'DONE']),
        ];
    }
}
