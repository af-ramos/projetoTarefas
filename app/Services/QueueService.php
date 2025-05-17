<?php

namespace App\Services;

use App\Jobs\NotificationJob;

class QueueService 
{
    public function pushNotification(string $service, array $data, int $targetId) {
        NotificationJob::dispatch("App\\Services\\Notifications\\" . ucfirst(strtolower($service)) . "Service", $data, $targetId);
    }
}