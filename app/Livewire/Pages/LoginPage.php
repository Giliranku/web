<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class LoginPage extends Component
{
    public function render()
    {
        return view('livewire.pages.login-page')->layout('components.layouts.full-screen');
    }
}
