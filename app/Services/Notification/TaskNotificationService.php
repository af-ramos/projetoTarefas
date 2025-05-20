<?php

namespace App\Services\Notification;

use App\Services\Notification\NotificationService;
use Illuminate\Support\Facades\Log;

class TaskNotificationService extends NotificationService
{
    public function sendEmail(array $data) {
        Log::info('sendEmail');
        Log::info($data);
    }
}
