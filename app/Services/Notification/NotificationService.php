<?php

namespace App\Services\Notification;

use App\Services\UserService;

abstract class NotificationService
{
    protected UserService $userService;

    public abstract function getSendMethod(string $type);

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    
    public function init(array $data) {
        $userNotifications = $this->setUserNotifications($data['target']);
        $this->sendMessage($userNotifications, $data);
    }

    public function setUserNotifications(int $user) {
        return $this->userService->getUserNotifications($user);
    }

    public function sendMessage(mixed $userNotifications, array $data) {
        foreach ($userNotifications as $notificationType) {
            $sendMethod = 'send' . $this->getSendMethod($data['type']) . ucfirst(strtolower($notificationType->description));

            if (method_exists($this, $sendMethod)) {
                $this->$sendMethod($data);
            }
        }
    }
}
