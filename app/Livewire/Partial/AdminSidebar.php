<?php

namespace App\Livewire\Partial;

use Livewire\Component;

class AdminSidebar extends Component
{
    public $collapsed = false;

    public function mount()
    {
        $this->collapsed = false;
    }
    public function render()
    {
        return view('livewire.partial.admin-sidebar', [
            'collapsed' => $this->collapsed
        ]);
    }
}
