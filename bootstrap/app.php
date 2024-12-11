<?php

use App\Models\Merchant;
use App\Http\Middleware\ValidateShop;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CustomerMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'merchant' => Merchant::class,
            'ValidateShop' => ValidateShop::class,
            'customer' => CustomerMiddleware::class
        ])->validateCsrfTokens(except: [
            '/pay','/pay-via-ajax', '/success','/cancel','/fail','/ipn'
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
