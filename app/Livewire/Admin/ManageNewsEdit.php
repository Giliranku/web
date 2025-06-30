<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ManageNewsEdit extends Component
{
    public function render()
    {
        return view('livewire.admin.manage-news-edit')->layout('components.layouts.dashboard-admin');
    }
}
