<?php

namespace App\Services;

use App\Jobs\NotificationJob;
use App\Services\Notification\NotificationService;

class QueueService 
{
    public function sendNotification(NotificationService $notificatitionService, array $data) {
        NotificationJob::dispatch($notificatitionService, $data);
    }
}