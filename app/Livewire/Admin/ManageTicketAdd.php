<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ManageTicketAdd extends Component
{
    public function render()
    {
        return view('livewire.admin.manage-ticket-add')->layout('components.layouts.dashboard-admin');
    }
}
