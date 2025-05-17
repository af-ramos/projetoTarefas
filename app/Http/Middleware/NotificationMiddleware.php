<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use App\Services\ProjectService;
use App\Services\QueueService;
use App\Services\TaskService;
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
        [$controller, $action] = explode('@', $request->route()?->getActionName());

        $user = $this->authService->getUser();
        $user = $this->userService->showUser($user->id);
        
        $targetUsers = [];

        if ($action === 'create') {
            $data = [
                'user' => $user->toArray(),
                'action' => $action
            ];

            array_push($targetUsers, $user);
        }

        if ($action === 'update' && isset($request->user_id)) {
            $assignee = $this->userService->showUser($request->user_id);

            $data = [
                'user' => $user->toArray(),
                'assignee' => $assignee->toArray(),
                'action' => $action
            ];

            array_push($targetUsers, $user, $assignee);
        }
        
        foreach (array_unique($targetUsers) as $target) {
            foreach ($target->notifications as $notification) {
                $this->queueService->pushNotification($notification->description, $data, $target->id);
            }   
        }

        return $response;
    }
}
