<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class RegisterPage extends Component
{
    public function render()
    {
        return view('livewire.pages.register-page')->layout('components.layouts.full-screen');
    }
}
