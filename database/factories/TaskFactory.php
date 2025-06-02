<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph,
            'status_id' => $this->faker->numberBetween(1, 3),
            'owner_id' => User::factory(),
            'assigned_id' => User::factory(),
            'project_id' => Project::factory(),
        ];
    }
}
