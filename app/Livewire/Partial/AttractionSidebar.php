<?php

namespace App\Livewire\Partial;

use App\Models\Attraction;
use Livewire\Component;

class AttractionSidebar extends Component
{
    public $attraction;
    
    public function mount()
    {
        // Get current staff's attraction
        $staffId = session('staff_id');
        if ($staffId) {
            $this->attraction = Attraction::where('staff_id', $staffId)->first();
        }
    }

    public function render()
    {
        return view('livewire.partial.attraction-sidebar');
    }
}
