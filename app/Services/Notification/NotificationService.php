<?php

namespace App\Services\Notification;

use App\Services\UserService;

abstract class NotificationService
{
    protected $userService;

    protected $userNotifications;
    protected $content;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function setUserNotifications(int $user) {
        $this->userNotifications = $this->userService->getUserNotifications($user);
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
        foreach ($this->userNotifications->notifications as $notificationType) {
            $sendMethod = 'send' . ucfirst(strtolower($notificationType->description));

            if (method_exists($this, $sendMethod)) {
                $this->$sendMethod($this->content);
            }
        }
    }
}
