<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use App\Services\QueueService;
use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationMiddleware
{
    protected $queueService;
    protected $authService;
    protected $userService;

    public function __construct(QueueService $queueService, AuthService $authService, UserService $userService) {
        $this->queueService = $queueService;
        $this->authService = $authService;
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $user = $this->authService->getUser();
        $user = $this->userService->showUser($user->id);

        foreach ($user->notifications as $notification) {
            $this->queueService->pushNotification($notification->description, $request->all());
        }

        return $response;
    }
}
