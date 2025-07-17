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
    public $location, $logo;

    protected $messages = [
        'name.required' => 'Nama tiket wajib diisi.',
        'name.string' => 'Nama tiket harus berupa teks.',
        'name.unique' => 'Nama tiket sudah digunakan.',

        'price.numeric' => 'Harga promo harus berupa angka.',

        'price_before.required' => 'Harga normal wajib diisi.',
        'price_before.numeric' => 'Harga normal harus berupa angka.',

        'location.required' => 'Lokasi wajib dipilih.',
        'location.in' => 'Lokasi yang dipilih tidak valid.',

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
            'terms_and_conditions' => $this->terms_and_conditions . "\n" . $this->usage,
            'usage' => $this->usage,
        ]);

        return redirect('/manage-ticket')->with('success', 'Tiket berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.add-ticket-component')
            ->layout('components.layouts.dashboard-admin');
    }
}
