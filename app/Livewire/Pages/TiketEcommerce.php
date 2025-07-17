<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Ticket;

class TiketEcommerce extends Component
{
    public $products = [];
    public $search;

    public function mount()
    {
        
    }

    public function render()
    {
        // This component now ONLY loads the products.
        $this->products = Ticket::all();

        if (isset($this->search) && $this->search !== '') {
            // search products based on the search term
            $this->products = Ticket::where('name', 'like', '%'.$this->search.'%')
                ->get();
        }

        return view('livewire.pages.tiket-ecommerce');
    }
}