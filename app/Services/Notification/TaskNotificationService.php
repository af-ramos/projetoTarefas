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
        // definir o body do email para task criada
        // realizar envio do email para task criada

        Log::info('sendTaskCreatedEmail');
        Log::info($data);
    }

    private function sendTaskAssignedEmail(array $data) {
        // definir o body do email para task atribuida
        // realizar o envio do email para task atribuida

        Log::info('sendTaskAssignedEmail');
        Log::info($data);
    }
}
