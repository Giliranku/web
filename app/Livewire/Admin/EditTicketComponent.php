<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Ticket;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditTicketComponent extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $name, $price, $price_before, $terms_and_conditions, $usage;
    public $new_logo;

    protected $rules = [
        'name' => 'required|string',
        'price' => 'nullable|numeric',
        'price_before' => 'required|numeric',
        'terms_and_conditions' => 'required|string',
        'usage' => 'required|string',
        'new_logo' => 'nullable|image|max:1024',
    ];

    protected $messages = [
        'name.required' => 'Nama tiket wajib diisi.',
        'name.string' => 'Nama tiket harus berupa teks.',
        'price.numeric' => 'Harga promo harus berupa angka.',
        'price_before.required' => 'Harga sebelum promo wajib diisi.',
        'price_before.numeric' => 'Harga sebelum promo harus berupa angka.',
        'terms_and_conditions.required' => 'Syarat dan ketentuan wajib diisi.',
        'usage.required' => 'Cara penggunaan wajib diisi.',
        'new_logo.image' => 'Logo harus berupa gambar.',
        'new_logo.max' => 'Ukuran logo maksimal 1MB.',
    ];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;

        // Isi nilai default dari data tiket ke input
        $this->name = $ticket->name;
        $this->price = $ticket->price;
        $this->price_before = $ticket->price_before;
        $this->terms_and_conditions = $ticket->terms_and_conditions;
        $this->usage = $ticket->usage;
    }

    public function update()
    {
        $this->validate();
        $this->price = $this->price === '' ? null : $this->price;

        // Update logo jika user upload baru
        if ($this->new_logo) {
            Storage::disk('public')->delete($this->ticket->logo);
            $logoPath = $this->new_logo->store('tickets', 'public');
        } else {
            $logoPath = $this->ticket->logo;
        }

        // Update ke database
        $this->ticket->update([
            'name' => $this->name,
            'price' => $this->price,
            'price_before' => $this->price_before,
            'terms_and_conditions' => $this->terms_and_conditions,
            'usage' => $this->usage,
            'logo' => $logoPath,
        ]);

        return redirect()->route('manage-ticket.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.manage-ticket-edit', [
            'ticket' => $this->ticket,
        ])->layout('components.layouts.dashboard-admin');
    }
}
