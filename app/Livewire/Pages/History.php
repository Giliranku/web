<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class History extends Component
{
    public $invoices;

    public function mount()
    {
        $this->invoices = Auth::user()->invoices()->with('tickets')->latest()->get();
    }

    public function render()
    {
        return view('livewire.pages.history');
    }
}
