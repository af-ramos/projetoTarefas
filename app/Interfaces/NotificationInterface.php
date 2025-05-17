<?php

namespace App\Interfaces;

interface NotificationInterface
{
    public function send(int $targetUser, array $body);
    public function formatMessage(array $data);
}