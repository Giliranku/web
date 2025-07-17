<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Ticket;

class TiketEcommerce extends Component
{
    public $products = [];

    public function mount()
    {
        // This component now ONLY loads the products.
        $this->products = Ticket::all();
    }

    public function render()
    {
        return view('livewire.pages.tiket-ecommerce');
    }
}