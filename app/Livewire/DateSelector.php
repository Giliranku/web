<?php

namespace App\Livewire;

use Livewire\Component;

class DateSelector extends Component
{
    public $selectedDate;

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.date-selector');
    }
}