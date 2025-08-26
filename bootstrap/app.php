<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
                $middleware->alias([
            'role.redirect' => \App\Http\Middleware\AuthWithRole::class,
            'auth.with.role' => \App\Http\Middleware\AuthWithRole::class,
            'mahasiswa.syarat' => \App\Http\Middleware\CheckSyaratPl::class,
            'syarat.pengajuanpbb' => \App\Http\Middleware\CheckSyaratPengajuanPbb::class,
            'syarat.pengajuan.sk.pbb' => \App\Http\Middleware\CheckSyaratPengajuanSkPbb::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
