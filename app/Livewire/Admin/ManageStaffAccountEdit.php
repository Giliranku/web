<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ManageStaffAccountEdit extends Component
{
    public function render()
    {
        return view('livewire.admin.manage-staff-account-edit')->layout('components.layouts.dashboard-admin');
    }
}
