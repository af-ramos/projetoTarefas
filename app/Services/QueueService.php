<?php

namespace App\Services;

use App\Jobs\NotificationJob;

class QueueService 
{
    public function sendNotification(array $data) {
        NotificationJob::dispatch($data);
    }
}