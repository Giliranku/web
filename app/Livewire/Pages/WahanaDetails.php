<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class WahanaDetails extends Component
{
    public $images = [];
    public $mainImage;
// Fill in the properties for the details page using passed Model
    public $restaurant;
    public $attraction;
    public $type;

    public function render()
    {
        return view('livewire.pages.wahana-details');
    }
}
