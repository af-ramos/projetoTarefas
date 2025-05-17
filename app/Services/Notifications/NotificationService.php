<?php

namespace App\Services\Notifications;

use App\Interfaces\NotificationInterface;
use App\Services\LogService;

abstract class NotificationService implements NotificationInterface {
    protected $logService;

    public function __construct(LogService $logService) {
        $this->logService = $logService;
    }

    public function formatMessage(array $data) {
        if ($data['action'] === 'create') {
            return [
                'message' => 'The user ' . $data['user']['name'] . ' created a new task'
            ];
        }

        return [
            'message' => 'The user ' . $data['user']['name'] . ' assigned a task to ' . $data['assignee']['name']
        ];
    }


    public function init(array $data, int $targetId) {
        $this->send($targetId, $this->formatMessage($data));
    }
}