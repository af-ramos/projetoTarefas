<?php

namespace Tests\Unit;

use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function test_create_user()
    {
        $data = [
            'name' => 'john doe',
            'email' => 'john@example.com',
            'password' => 'secret',
            'notifications' => ['email']
        ];

        Hash::shouldReceive('make')->with('secret')->once()->andReturn('hashed-secret');

        $mockRepo = Mockery::mock(UserRepository::class);
        $mockRepo->shouldReceive('create')->once()->with([
            'name' => 'JOHN DOE',
            'email' => 'john@example.com',
            'password' => 'hashed-secret',
            'notifications' => ['email']
        ])->andReturn(['id' => 1]);

        $service = new UserService($mockRepo);
        $result = $service->createUser($data);

        $this->assertEquals(['id' => 1], $result);
    }

    public function test_show_user()
    {
        $mockRepo = Mockery::mock(UserRepository::class);
        $mockRepo->shouldReceive('show')->once()->with(10)->andReturn(['id' => 10]);

        $service = new UserService($mockRepo);
        $this->assertEquals(['id' => 10], $service->showUser(10));
    }
}
