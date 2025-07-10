<?php

namespace App\Livewire\Pages;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{

    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();


            if (empty($user->location) || empty($user->number) || empty($user->email)) {
                return redirect()->route('userprofile');
            }


        }
    }
    public function render()
    {
        return view('livewire.pages.home');
    }
}
