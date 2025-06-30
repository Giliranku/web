<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ManageNews extends Component
{
    public function render()
    {
        return view('livewire.admin.manage-news')->layout('components.layouts.dashboard-admin');
    }
}
