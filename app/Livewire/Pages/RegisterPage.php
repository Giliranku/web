<?php

namespace App\Livewire\Pages;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;
    public $number;

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'number' => 'required|digits_between:10,12|regex:/^[0-9]+$/',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'number' => $this->number,
        ]);


        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.pages.register-page')->layout('components.layouts.full-screen');
    }
}
