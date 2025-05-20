<?php

namespace App\Services\Notification;

use App\Models\Notification;
use App\Services\UserService;

abstract class NotificationService
{
    protected UserService $userService;

    protected Notification $userNotifications;
    protected array $content;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function setUserNotifications(int $user) {
        $this->userNotifications = $this->userService->getUserNotifications($user)->notifications;
    }

    public function setContent(array $data) {
        $this->content = $data;
    }

    public function init(array $data) {
        $this->setUserNotifications($data['target']);
        $this->setContent($data);

        $this->sendMessage();
    }

    public function sendMessage() {
        foreach ($this->userNotifications as $notificationType) {
            $sendMethod = 'send' . ucfirst(strtolower($notificationType->description));

            if (method_exists($this, $sendMethod)) {
                $this->$sendMethod($this->content);
            }
        }
    }
}
