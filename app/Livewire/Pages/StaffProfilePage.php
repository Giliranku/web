<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class StaffProfilePage extends Component
{
    public function render()
    {
        return view('livewire.pages.staff-profile-page')->layout('components.layouts.dashboard-admin');
    }
}
