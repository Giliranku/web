<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ManageTicketEdit extends Component
{
    public function render()
    {
        return view('livewire.admin.manage-ticket-edit')->layout('components.layouts.dashboard-admin');
    }
}
