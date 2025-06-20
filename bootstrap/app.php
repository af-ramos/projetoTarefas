<?php

use App\Http\Middleware\LogMiddleware;
use App\Http\Middleware\NotificationMiddleware;
use App\Services\AuthService;
use App\Services\LogService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'register.log' => LogMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $exception, Request $request) {
            if ($request->is('api/*')) {
                $message = 'Something went wrong';
                $status = 500;

                [$message, $status] = match (true) {
                    $exception instanceof QueryException => ['Database error', 500],
                    $exception instanceof NotFoundHttpException => ['Route not found', 404],
                    $exception instanceof ValidationException => [$exception->getMessage(), 422],
                    $exception instanceof AuthenticationException => [$exception->getMessage(), 401],
                    $exception instanceof AccessDeniedHttpException => [$exception->getMessage(), 403],
                    default => [$message, $status]
                };

                [$controller, $action] = explode('@', $request->route()?->getActionName());
                $userId = app(AuthService::class)->getId();

                app(LogService::class)->error(
                    $request->path(), $action, $request->ip(), 
                    $request->all(), $userId, 
                    [$exception->getMessage(), $exception->getTraceAsString()]
                );

                return response()->json([
                    'message' => $message,
                    'error' => config('app.debug') ? [
                        'message' => $exception->getMessage(),
                        'trace' => $exception->getTrace()
                    ] : null
                ], $status);
            } 
        });
    })->create();
