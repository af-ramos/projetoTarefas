<?php

namespace App\Services;

use App\Jobs\NotificationJob;
use App\Services\Notification\NotificationService;

class QueueService 
{
    public function dispatchNotification(string $notificationClass, array $data) {
        NotificationJob::dispatch($notificationClass, $data);
    }
}