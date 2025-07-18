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
            // Login staff using custom guard if needed, or session
            session(['staff_id' => $staff->id, 'staff_name' => $staff->name, 'staff_email' => $staff->email]);
            return redirect('/admin/dashboard');
        }

        $this->reset(['password']);
        $this->error = 'Password salah.';
    }

    public function render()
    {
        return view('livewire.admin.login-page')->layout('components.layouts.full-screen');
    }
}
