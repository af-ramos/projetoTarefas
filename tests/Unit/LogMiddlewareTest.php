<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\LogMiddleware;
use App\Services\AuthService;
use App\Services\LogService;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LogMiddlewareTest extends TestCase
{
    /** @var LogService&MockObject */
    private $logService;

    /** @var AuthService&MockObject */
    private $authService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->logService = $this->createMock(LogService::class);
        $this->authService = $this->createMock(AuthService::class);
    }

    public function test_log_and_returns()
    {
        $request = Request::create('/test/path', 'POST', ['foo' => 'bar']);

        $route = $this->getMockBuilder(\Illuminate\Routing\Route::class)->disableOriginalConstructor()->onlyMethods(['getActionName'])->getMock();
        $route->method('getActionName')->willReturn('TestController@testMethod');

        $request->setRouteResolver(fn() => $route);

        $this->authService->method('getId')->willReturn(123);
        $this->logService->expects($this->once())->method('log')->with('test/path', 'testMethod', $request->ip(), $request->all(), 123);

        $middleware = new LogMiddleware($this->logService, $this->authService);

        $next = function ($req) {
            return new Response('OK', 200);
        };

        $response = $middleware->handle($request, $next);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getContent());
    }
}
