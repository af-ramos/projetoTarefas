<?php

namespace Database\Factories\Statuses;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectStatusFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description' => $this->faker->randomElement(['BACKLOG', 'DEVELOPMENT', 'CODE REVIEW', 'TEST', 'PRE-RELEASE']),
        ];
    }
}
