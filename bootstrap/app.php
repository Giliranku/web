<?php

use App\Http\Middleware\EnsureLogin;
use App\Http\Middleware\EnsureAdminAuth;
use App\Http\Middleware\EnsureStaffAuth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'login' => EnsureLogin::class,
            'admin' => EnsureAdminAuth::class,
            'staff' => EnsureStaffAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
