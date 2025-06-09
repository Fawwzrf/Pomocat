<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php', // Pastikan ini sudah ada
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Baris ini mungkin sudah ada jika Anda menjalankan install:api
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        // ===============================================
        // == TAMBAHKAN BARIS INI ==
        // ===============================================
        $middleware->statefulApi();
        // ===============================================

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
