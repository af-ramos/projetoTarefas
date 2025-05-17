<?php

namespace App\Repositories;

use App\Models\Error;
use App\Models\Log;

class LogRepository
{
    protected $log;
    protected $error;

    /**
     * Create a new class instance.
     */
    public function __construct() {
        $this->log = new Log();
        $this->error = new Error();
    }

    public function log(array $data) {
        return $this->log->create($data);
    }

    public function error(array $data) {
        $this->error->create($data);
    }
}
