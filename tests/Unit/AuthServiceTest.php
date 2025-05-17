<?php

namespace Tests\Unit;

use App\Services\AuthService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    public function test_login()
    {
        Auth::shouldReceive('attempt')->once()->with(['email' => 'user@example.com', 'password' => 'secret'])->andReturn(true);

        $service = new AuthService();
        $this->assertTrue($service->login(['email' => 'user@example.com', 'password' => 'secret']));
    }

    public function test_register()
    {
        $user = Mockery::mock(Authenticatable::class);
        Auth::shouldReceive('login')->once()->with($user)->andReturn(true);

        $service = new AuthService();
        $this->assertTrue($service->register($user));
    }

    public function test_logout()
    {
        Auth::shouldReceive('logout')->once();

        $service = new AuthService();
        $service->logout();

        $this->assertTrue(true);
    }

    public function test_get_user()
    {
        $user = new \stdClass();
        Auth::shouldReceive('user')->once()->andReturn($user);

        $service = new AuthService();
        $this->assertSame($user, $service->getUser());
    }

    public function test_get_id()
    {
        Auth::shouldReceive('id')->once()->andReturn(42);
        $service = new AuthService();
        
        $this->assertEquals(42, $service->getId());
    }

    public function test_get_ttl()
    {
        $mockFactory = Mockery::mock();
        $mockFactory->shouldReceive('getTTL')->once()->andReturn(30);

        Auth::shouldReceive('factory')->once()->andReturn($mockFactory);

        $service = new AuthService();
        $this->assertEquals(1800, $service->getTTL());
    }
}
