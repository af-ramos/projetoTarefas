<?php

namespace App\Repositories;

use App\Models\Logs\Error;
use App\Models\Logs\Log;

class LogRepository
{
    protected Log $log;
    protected Error $error;
    
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
