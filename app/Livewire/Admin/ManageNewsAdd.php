<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ManageNewsAdd extends Component
{
    public function render()
    {
        return view('livewire.admin.manage-news-add')->layout('components.layouts.dashboard-admin');
    }
}
