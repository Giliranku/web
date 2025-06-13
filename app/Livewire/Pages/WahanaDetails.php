<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class WahanaDetails extends Component
{
    public $images = [];
    public $mainImage;

    public function mount()
    {
        $this->images = [
            asset('img/wahana/wahana-1.png'),
            asset('img/wahana/wahana-2.png'),
            asset('img/wahana/wahana-3.png'),
        ];

        $this->mainImage = $this->images[0];
    }

    public function render()
    {
        return view('livewire.pages.wahana-details');
    }
}
