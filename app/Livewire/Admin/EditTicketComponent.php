<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Ticket;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EditTicketComponent extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $name, $price, $price_before, $terms_and_conditions, $usage, $location;
    public $new_logo, $ticket_type, $fast_pass_price_multiplier;

    protected $messages = [
        'name.required' => 'Nama tiket wajib diisi.',
        'name.string' => 'Nama tiket harus berupa teks.',

        'price.numeric' => 'Harga promo harus berupa angka.',

        'price_before.required' => 'Harga normal wajib diisi.',
        'price_before.numeric' => 'Harga normal harus berupa angka.',

        'location.required' => 'Lokasi wajib dipilih.',
        'location.in' => 'Lokasi yang dipilih tidak valid.',

        'ticket_type.required' => 'Jenis tiket wajib dipilih.',
        'ticket_type.in' => 'Jenis tiket yang dipilih tidak valid.',

        'fast_pass_price_multiplier.required' => 'Pengali harga fast pass wajib diisi.',
        'fast_pass_price_multiplier.numeric' => 'Pengali harga fast pass harus berupa angka.',
        'fast_pass_price_multiplier.min' => 'Pengali harga fast pass minimal 1.00.',

        'terms_and_conditions.required' => 'Syarat dan ketentuan wajib diisi.',
        'terms_and_conditions.string' => 'Syarat dan ketentuan harus berupa teks.',

        'usage.required' => 'Ketentuan penggunaan wajib diisi.',
        'usage.string' => 'Ketentuan penggunaan harus berupa teks.',

        'new_logo.image' => 'Logo harus berupa gambar.',
        'new_logo.max' => 'Ukuran logo maksimal 1MB.',
    ];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;

        $this->name = $ticket->name;
        $this->price = $ticket->price;
        $this->price_before = $ticket->price_before;
        $this->location = $ticket->location;
        $this->ticket_type = $ticket->ticket_type;
        $this->fast_pass_price_multiplier = $ticket->fast_pass_price_multiplier;
        $this->terms_and_conditions = $ticket->terms_and_conditions;
        $this->usage = $ticket->usage;
    }

    public function updatedNewLogo()
    {
        $this->validate([
            'new_logo' => 'nullable|image|max:1024',
        ]);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string',
            'price' => 'nullable|numeric',
            'price_before' => 'required|numeric',
            'location' => [
                'required',
                Rule::in([
                    'Ancol',
                    'Dufan Ancol',
                    'Sea World Ancol',
                    'Atlantis Ancol',
                    'Samudra Ancol',
                    'Putri Duyung Ancol',
                    'Jakarta Bird Land Ancol',
                ]),
            ],
            'ticket_type' => 'required|in:regular,fast_pass',
            'fast_pass_price_multiplier' => 'required|numeric|min:1.00',
            'terms_and_conditions' => 'required|string',
            'usage' => 'required|string',
            'new_logo' => 'nullable|image|max:1024',
        ]);

        $this->price = $this->price === '' ? null : $this->price;

        if ($this->new_logo) {
            Storage::disk('public')->delete($this->ticket->logo);
            $logoPath = $this->new_logo->store('tickets', 'public');
        } else {
            $logoPath = $this->ticket->logo;
        }

        $this->ticket->update([
            'name' => $this->name,
            'price' => $this->price,
            'price_before' => $this->price_before,
            'location' => $this->location,
            'ticket_type' => $this->ticket_type,
            'fast_pass_price_multiplier' => $this->fast_pass_price_multiplier,
            'terms_and_conditions' => $this->terms_and_conditions,
            'usage' => $this->usage,
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.ticket.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.edit-ticket-component', [
            'ticket' => $this->ticket,
        ])->layout('components.layouts.dashboard-admin');
    }
}
