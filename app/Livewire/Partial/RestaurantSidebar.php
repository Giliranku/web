<?php

namespace App\Livewire\Partial;

use App\Models\Restaurant;
use Livewire\Component;

class RestaurantSidebar extends Component
{
    public $restaurant;
    
    public function mount()
    {
        // Get current staff's restaurant
        $staffId = session('staff_id');
        if ($staffId) {
            $this->restaurant = Restaurant::where('staff_id', $staffId)->first();
        }
    }

    public function render()
    {
        return view('livewire.partial.restaurant-sidebar');
    }
}
