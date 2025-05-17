<?php

namespace App\Services\Notifications;

class EmailService extends NotificationService {
    public function send(int $targetUser, array $body) {
        $this->logService->notification($targetUser, 'EMAIL', $body);
    }
}