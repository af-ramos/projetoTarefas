<?php

namespace App\Services\Notification;

use App\Services\Notification\NotificationService;
use Illuminate\Support\Facades\Log;

class TaskNotificationService extends NotificationService
{
    public function getSendMethod(string $type) {
        return match ($type) {
            'task_created' => 'TaskCreated',
            'task_assigned' => 'TaskAssigned'
        };
    }

    private function sendTaskCreatedEmail(array $data) {
        Log::info('sendTaskCreatedEmail');
        Log::info($data);
    }

    private function sendTaskAssignedEmail(array $data) {
        Log::info('sendTaskAssignedEmail');
        Log::info($data);
    }
}
