<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Restaurant;
use App\Models\Staff;

class AddRestaurant extends Component
{
    use WithFileUploads;

    public $name, $location, $capacity, $time_estimation, $description, $staff_id;
    public $cover, $img1, $img2, $img3;

    protected $rules = [
        'name' => 'required|string|max:255',
        'location' => 'required|string',
        'capacity' => 'required|integer|min:1',
        'time_estimation' => 'required|integer|min:1',
        'description' => 'required|string',
        'staff_id' => 'nullable|exists:staff,id',
        'cover' => 'required|image|max:2048',
        'img1' => 'nullable|image|max:2048',
        'img2' => 'nullable|image|max:2048',
        'img3' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'name.required' => 'Nama restoran wajib diisi.',
        'location.required' => 'Lokasi wajib diisi.',
        'capacity.required' => 'Kapasitas wajib diisi.',
        'capacity.integer' => 'Kapasitas harus berupa angka.',
        'capacity.min' => 'Kapasitas minimal 1.',
        'time_estimation.required' => 'Estimasi waktu wajib diisi.',
        'time_estimation.integer' => 'Estimasi waktu harus berupa angka.',
        'time_estimation.min' => 'Estimasi waktu minimal 1 menit.',
        'description.required' => 'Deskripsi wajib diisi.',
        'cover.required' => 'Cover image wajib diunggah.',
        'cover.image' => 'Cover harus berupa gambar.',
        'cover.max' => 'Ukuran cover maksimal 2MB.',
        'img1.image' => 'Gambar 1 harus berupa gambar.',
        'img2.image' => 'Gambar 2 harus berupa gambar.',
        'img3.image' => 'Gambar 3 harus berupa gambar.',
        'staff_id.exists' => 'Staff yang dipilih tidak valid.',
    ];

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'location' => $this->location,
            'capacity' => $this->capacity,
            'time_estimation' => $this->time_estimation,
            'description' => $this->description,
            'staff_id' => $this->staff_id ?: null, // Convert empty string to null
            'cover' => $this->cover->store('restaurants', 'public'),
        ];

        if ($this->img1) {
            $data['img1'] = $this->img1->store('restaurants', 'public');
        }
        if ($this->img2) {
            $data['img2'] = $this->img2->store('restaurants', 'public');
        }
        if ($this->img3) {
            $data['img3'] = $this->img3->store('restaurants', 'public');
        }

        Restaurant::create($data);

        return redirect()->route('admin.restaurants.index')->with('success', 'Restoran berhasil ditambahkan.');
    }

    public function render()
    {
        $staff = Staff::all();
        
        return view('livewire.admin.add-restaurant', [
            'staff' => $staff
        ])->layout('components.layouts.dashboard-admin');
    }
}
