<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Attraction;
class AttracionListManageAdd extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $capacity;
    public $duration; // dalam jam
    public $photo;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'capacity' => 'required|integer|min:1',
        'duration' => 'required|numeric|min:0.1',
        'photo' => 'nullable|image|max:2048',
    ];

    public function save()
    {
        $this->validate();

        // 1) simpan foto (cover) jika ada
        $coverPath = $this->photo
            ? $this->photo->store('attractions', 'public')
            : null;

        // 2) persiapkan data untuk insert
        $data = [
            'name' => $this->name,
            'location' => '-',                        // default placeholder
            'capacity' => $this->capacity,
            'time_estimation' => intval($this->duration * 60), // konversi jam→menit
            'description' => $this->description,
            'cover' => $coverPath,

            // karena migrasi kamu menetapkan NOT NULL untuk kolom ini,
            // kita beri default kosong atau angka tetap:
            'img1' => '',
            'img2' => '',
            'img3' => '',
            'staff_id' => 1, // ganti dengan ID admin/staff default-mu
        ];

        // 3) insert
        Attraction::create($data);

        session()->flash('message', 'Wahana berhasil ditambahkan.');
        return redirect()->route('attractions.manage');
    }

    public function render()
    {
        return view('livewire.admin.attracion-list-manage-add')->layout('components.layouts.dashboard-admin');
        ;
    }
}
