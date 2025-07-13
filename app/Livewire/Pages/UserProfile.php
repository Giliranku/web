<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class UserProfile extends Component
{
    public $name;
    public $email;
    public $number;
    public $location;
    public function mount()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login'); // jika belum login
        }

        $this->name = $user->name;
        $this->email = $user->email;
        $this->number = $user->number;
        $this->location = $user->location;
    }
    public function updateProfile()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required|digits_between:10,12|regex:/^[0-9]+$/',
            'location' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'number' => $this->number,
            'location' => $this->location   ,
        ]);

        session()->flash('message', 'Profil berhasil diperbarui!');
    }
    public function render()
    {
        return view('livewire.pages.user-profile');
    }
}
