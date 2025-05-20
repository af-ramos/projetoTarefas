<?php

namespace App\Services;

use App\Jobs\NotificationJob;
use App\Services\Notification\NotificationService;

class QueueService 
{
    public function sendNotification(string $notificationClass, array $data) {
        NotificationJob::dispatch($notificationClass, $data);
    }
}