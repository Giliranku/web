<?php

namespace App\Livewire\Pages;
use App\Models\Invoice;
use Livewire\Component;

class InvoicePage extends Component
{
    public $invoice;
    public function mount($id)
    {
        // Ambil invoice beserta relasinya
        $this->invoice = Invoice::with('tickets')->findOrFail($id);
    }
    public function render()
    {
        return view('livewire.pages.invoice-page');
    }
}
