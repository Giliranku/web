<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuth
{
    /**
     * Handle an incoming request.
     * Check if admin is authenticated via session (role: admin)
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in as staff with admin role
        if (!session('staff_id') || session('staff_role') !== 'admin') {
            return redirect('/admin/login')->with('error', 'Silakan login sebagai admin terlebih dahulu.');
        }
        
        return $next($request);
    }
}
