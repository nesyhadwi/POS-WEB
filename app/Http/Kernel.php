<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // Middleware lain...
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}
