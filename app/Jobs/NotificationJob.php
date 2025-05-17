<?php

namespace App\Jobs;

use App\Services\Notifications\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $data;
    protected NotificationService $service;

    public function __construct(string $serviceClass, array $data) {
        $this->onQueue('notifications');

        $this->data = $data;
        $this->service = app($serviceClass);
    }

    public function handle() {
        $this->service->init($this->data);
    }
}
