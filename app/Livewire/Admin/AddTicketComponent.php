<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Ticket;
use Illuminate\Validation\Rule;

class AddTicketComponent extends Component
{
    use WithFileUploads;

    public $name, $price, $price_before, $terms_and_conditions, $usage;
    public $location, $logo, $ticket_type = 'regular', $fast_pass_price_multiplier = 1.00;

    protected $messages = [
        'name.required' => 'Nama tiket wajib diisi.',
        'name.string' => 'Nama tiket harus berupa teks.',
        'name.unique' => 'Nama tiket sudah digunakan.',

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

        'logo.required' => 'Logo wajib diunggah.',
        'logo.image' => 'Logo harus berupa gambar.',
        'logo.max' => 'Ukuran logo maksimal 1MB.',
    ];

    public function save()
    {
        $this->validate([
            'name' => 'required|string|unique:tickets,name',
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
            'logo' => 'required|image|max:1024'
        ]);

        $logoName = $this->logo->store('tickets', 'public');

        Ticket::create([
            'name' => $this->name,
            'logo' => $logoName,
            'price' => $this->price,
            'price_before' => $this->price_before,
            'location' => $this->location,
            'ticket_type' => $this->ticket_type,
            'fast_pass_price_multiplier' => $this->fast_pass_price_multiplier,
            'terms_and_conditions' => $this->terms_and_conditions . "\n" . $this->usage,
            'usage' => $this->usage,
        ]);

        return redirect()->route('admin.ticket.index')->with('success', 'Tiket berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.add-ticket-component')
            ->layout('components.layouts.dashboard-admin');
    }
}
