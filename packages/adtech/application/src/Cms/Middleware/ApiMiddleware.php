<?php

namespace Adtech\Application\Cms\Middleware;

use Closure;
use Illuminate\Http\Response;

class ApiMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        return $response;
    }
}