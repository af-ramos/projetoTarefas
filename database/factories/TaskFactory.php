<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        $status = Status::firstOrCreate(['description' => $this->faker->randomElement(['TO DO', 'DONE'])]);

        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph,
            'status_id' => $status->id,
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
        ];
    }
}
