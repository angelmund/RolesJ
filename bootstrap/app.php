<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
    // then: function () {
    //     Route::middleware('web', 'auth')
    //         ->prefix('modalidades')
    //         ->name('Modalidades.')
    //         ->group(base_path('routes/modalidades.php'));

    //     Route::middleware('web', 'auth')
    //         ->prefix('torneos')
    //         ->name('Torneos.')
    //         ->group(base_path('routes/torneos.php'));

    //     Route::middleware('web', 'auth')
    //         ->prefix('equipos')
    //         ->name('Equipos.')
    //         ->group(base_path('routes/equipos.php'));
    // },

    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
