<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ManageStaffAccount extends Component
{
    public function render()
    {
        return view('livewire.admin.manage-staff-account')->layout('components.layouts.dashboard-admin');
    }
}
