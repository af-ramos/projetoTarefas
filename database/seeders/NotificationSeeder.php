<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['POP-UP', 'E-MAIL'];	

        foreach ($statuses as $status) {
            Notification::firstOrCreate(['description' => $status]);
        }
    }
}
