<?php

namespace App\Services\Notifications;

class PopupService extends NotificationService {
    public function send(int $targetUser, array $body) {
        $this->logService->notification($targetUser, 'POPUP', $body);
    }
}