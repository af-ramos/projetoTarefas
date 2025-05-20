<?php

namespace App\Jobs;

use App\Services\Notification\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $data;
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService, array $data) {
        $this->onQueue('notifications');

        $this->notificationService = $notificationService;
        $this->data = $data;
    }

    public function handle() {
        $this->notificationService->init($this->data);
    }
}
