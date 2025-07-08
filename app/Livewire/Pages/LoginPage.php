<?php


namespace App\Livewire\Pages;


use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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
        $user = \App\Models\User::where('email', $this->email)->first();

        if (!$user) {
            // Email tidak ditemukan
            $this->reset(['password']);
            $this->error = 'Email tidak ditemukan.';
            return;
        }


        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect('/'); // redirect kalau login sukses
        }
        $this->reset(['email', 'password']);
        $this->error = 'Password anda salah.'; // Gunakan properti, jangan session
    }

    public function render()
    {
        return view('livewire.pages.login-page');
    }
}
