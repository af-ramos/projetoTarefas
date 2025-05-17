<?php

namespace Database\Seeders;

use App\Models\Statuses\ProjectStatus;
use App\Models\Statuses\TaskStatus;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectStatuses = ['BACKLOG', 'DEVELOPMENT', 'CODE REVIEW', 'TEST', 'PRE-RELEASE'];
        $taskStatuses = ['TO DO', 'IN PROGRESS', 'DONE'];

        foreach ($projectStatuses as $status) {
            ProjectStatus::firstOrCreate(['description' => $status]);
        }

        foreach ($taskStatuses as $status) {
            TaskStatus::firstOrCreate(['description' => $status]);
        }
    }
}
