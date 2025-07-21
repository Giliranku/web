<?php

namespace App\Livewire\Admin;

use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginPage extends Component
{
    public $email;
    public $password;
    public $error;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $staff = Staff::where('email', $this->email)->first();

        if (!$staff) {
            $this->reset(['password']);
            $this->error = 'Email tidak ditemukan.';
            return;
        }

        if (Hash::check($this->password, $staff->password)) {
            // Login staff using session and redirect based on role
            session(['staff_id' => $staff->id, 'staff_name' => $staff->name, 'staff_email' => $staff->email, 'staff_role' => $staff->role]);
            
            // Redirect based on role
            switch ($staff->role) {
                case 'admin':
                    return redirect('/admin/dashboard');
                case 'staff_restaurant':
                    return redirect('/staff/restaurant/dashboard');
                case 'staff_attraction':
                    return redirect('/staff/attraction/dashboard');
                default:
                    return redirect('/admin/dashboard');
            }
        }

        $this->reset(['password']);
        $this->error = 'Password salah.';
    }

    public function render()
    {
        return view('livewire.admin.login-page')->layout('components.layouts.full-screen');
    }
}
