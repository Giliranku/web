<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

class History extends Component
{
    public $invoices = [];

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $this->invoices = Auth::user()->invoices()
            ->with(['tickets' => function($query) {
                $query->withPivot('quantity', 'used_quantity');
            }])
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.history');
    }
}
