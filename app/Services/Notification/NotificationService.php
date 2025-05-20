<?php

namespace App\Services\Notification;

use Illuminate\Support\Facades\Log;

abstract class NotificationService
{
    public function init(array $data) {
        Log::info($data);

        // $this->getUserNotifications($data['user_id']);
        // $this->formatMessage($data);
        // $this->sendMessage($data);
    }

    public function getUserNotifications(int $userId) {
        //
    }
}
