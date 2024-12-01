<?php

use App\Http\Middleware\ValidateShop;
use App\Models\Merchant;
use Illuminate\Foundation\Application;
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
            'ValidateShop' => ValidateShop::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
