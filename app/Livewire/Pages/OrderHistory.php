<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\Attraction;
use Illuminate\Support\Facades\Auth;

class OrderHistory extends Component
{
    public function render()
    {
        return view('livewire.pages.order-history');
    }
}