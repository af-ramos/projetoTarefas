<?php

namespace App\Repositories;

use App\Models\Error;
use App\Models\Log;
use App\Models\NotificationLog;

class LogRepository
{
    protected $log;
    protected $error;
    protected $notification;

    /**
     * Create a new class instance.
     */
    public function __construct() {
        $this->log = new Log();
        $this->error = new Error();
        $this->notification = new NotificationLog();
    }

    public function log(array $data) {
        return $this->log->create($data);
    }

    public function error(array $data) {
        $this->error->create($data);
    }

    public function notification(array $data) {
        $this->notification->create($data);
    }
}
