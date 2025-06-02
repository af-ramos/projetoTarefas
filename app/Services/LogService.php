<?php

namespace App\Services;

use App\Repositories\LogRepository;

class LogService
{
    protected LogRepository $mongoRepository;

    public function __construct(LogRepository $mongoRepository) {
        $this->mongoRepository = $mongoRepository;
    }

    public function log(string $route, string $method, string $ip, array $payload, int|null $userId, string|null $date = null, string|null $time = null) {
        return $this->mongoRepository->log([
            'route' => $route, 'ip' => $ip, 'method' => $method,
            'user' => $userId, 'payload' => $payload,
            'date' => $date ?? now()->format('Y-m-d'), 'time' => $time ?? now()->format('H:i:s')
        ]);
    }

    public function error(string $route, string $method, string $ip, array $payload, int|null $userId, array $error, string|null $date = null, string|null $time = null) {
        return $this->mongoRepository->error([
            'route' => $route, 'ip' => $ip, 'method' => $method,
            'user' => $userId, 'payload' => $payload,
            'date' => $date ?? now()->format('Y-m-d'), $time ?? 'time' => now()->format('H:i:s'),
            'error' => $error
        ]);
    }
}
