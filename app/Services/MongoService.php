<?php

namespace App\Services;

use App\Repositories\MongoRepository;

class MongoService
{
    protected $mongoRepository;

    public function __construct(MongoRepository $mongoRepository) {
        $this->mongoRepository = $mongoRepository;
    }

    public function log(string $route, string $method, string $ip, array $payload, int|null $userId) {
        return $this->mongoRepository->log([
            'route' => $route, 'ip' => $ip, 'method' => $method,
            'user' => $userId, 'payload' => $payload,
            'date' => now()->format('Y-m-d'), 'time' => now()->format('H:i:s')
        ]);
    }

    public function error(string $route, string $method, string $ip, array $payload, int|null $userId, array $error) {
        return $this->mongoRepository->error([
            'route' => $route, 'ip' => $ip, 'method' => $method,
            'user' => $userId, 'payload' => $payload,
            'date' => now()->format('Y-m-d'), 'time' => now()->format('H:i:s'),
            'error' => $error
        ]);
    }
}
