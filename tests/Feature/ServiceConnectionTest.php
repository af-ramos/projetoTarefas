<?php

namespace Tests\Feature;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ServiceConnectionTest extends TestCase
{
    public function test_mongo_connection(): void {
        try {
            DB::connection('mongodb')->getMongoClient()->listDatabases();
            $this->assertTrue(true);
        } catch (Exception $e) {
            $this->fail('Fail on MongoDB connection: ' . $e->getMessage());
        }
    }

    public function test_rabbitmq_connection(): void {
        try {
            Queue::connection('rabbitmq')->size(env('RABBITMQ_QUEUE'));
            $this->assertTrue(true);
        } catch (Exception $e) {
            $this->fail('Fail on RabbitMQ connection: ' . $e->getMessage());
        }
    }
}
