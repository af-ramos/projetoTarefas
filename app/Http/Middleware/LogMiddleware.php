<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use App\Services\LogService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogMiddleware
{
    protected LogService $logService;
    protected AuthService $authService;

    public function __construct(LogService $logService, AuthService $authService)
    {
        $this->logService = $logService;
        $this->authService = $authService;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $user = $this->authService->getId();
        [$controller, $action] = explode('@', $request->route()?->getActionName());

        $this->logService->log(
            $request->path(), $action,
            $request->ip(), $request->except(['password', 'token']), $user
        );

        return $response;
    }
}
