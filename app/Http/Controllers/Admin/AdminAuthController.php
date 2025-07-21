<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    /**
     * Handle admin/staff logout
     */
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_name']);
        $request->session()->forget(['staff_id', 'staff_name', 'staff_type']);
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login')->with('message', 'Berhasil logout');
    }
}
