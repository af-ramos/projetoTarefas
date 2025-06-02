<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $data;
    protected string $notificationClass;

    public function __construct(string $notificationClass, array $data) {
        $this->onQueue('notifications');

        $this->notificationClass = $notificationClass;
        $this->data = $data;
    }

    public function handle() {
        app($this->notificationClass)->init($this->data);
    }
}
