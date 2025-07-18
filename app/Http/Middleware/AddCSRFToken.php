<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddCSRFToken
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Add CSRF token to all responses
        if (method_exists($response, 'header')) {
            $response->header('X-CSRF-Token', csrf_token());
        }
        
        return $response;
    }
}
