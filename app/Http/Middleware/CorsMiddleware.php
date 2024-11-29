<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', '*'); // Allow all origins
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        if ($request->isMethod('OPTIONS')) {
            $response->headers->set('Access-Control-Allow-Origin', $request->header('Origin') ?? '*');
            $response->headers->set('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers') ?? 'Content-Type, Authorization');
        }

        return $next($request);
    }
}
