<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ManageTicket extends Component
{
    public function render()
    {
        return view('livewire.admin.manage-ticket')->layout('components.layouts.dashboard-admin');
    }
}
