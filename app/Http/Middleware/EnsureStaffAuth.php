<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStaffAuth
{
    /**
     * Handle an incoming request.
     * Check if staff is authenticated via session (role: staff_restaurant or staff_attraction)
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in as staff (not admin)
        if (!session('staff_id') || !in_array(session('staff_role'), ['staff_restaurant', 'staff_attraction'])) {
            return redirect('/admin/login')->with('error', 'Silakan login sebagai staff terlebih dahulu.');
        }
        
        return $next($request);
    }
}
