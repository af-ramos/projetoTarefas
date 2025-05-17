<?php

namespace App\Services\Notifications;

use App\Interfaces\NotificationInterface;

abstract class NotificationService implements NotificationInterface {
    public function init(array $data) {
        info($data);
        $this->send($data);
    }
}