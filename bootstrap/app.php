<?php

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $exception, Request $request) {
            if ($request->is('api/*')) {
                $message = 'Something went wrong';
                $status = 500;

                if ($exception instanceof QueryException) {
                    $message = 'Database error';
                }

                if ($exception instanceof NotFoundHttpException) {
                    $message = 'Route not found';
                    $status = 404;
                }

                if ($exception instanceof ValidationException) {
                    $message = $exception->getMessage();
                    $status = 422;
                }

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
