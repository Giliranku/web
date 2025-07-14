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
    public $duration;
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

        // Simpan foto sebagai cover
        $coverPath = $this->photo
            ? $this->photo->store('attractions', 'public')
            : null;

        // Ambil staff terkait dari user yang sedang login
        $staff = auth()->user()->staff;
        if (!$staff) {
            session()->flash('error', 'Staff tidak ditemukan.');
            return;
        }

        // Buat record baru di tabel attractions
        Attraction::create([
            'name' => $this->name,
            'location' => '–',     // bisa disesuaikan jika menambahkan input location
            'capacity' => $this->capacity,
            'time_estimation' => intval($this->duration * 60), // konversi jam ke menit
            'description' => $this->description,
            'cover' => $coverPath,
            'img1' => '',
            'img2' => '',
            'img3' => '',
            'staff_id' => $staff->id,
        ]);

        session()->flash('message', 'Wahana berhasil ditambahkan.');
        return redirect()->route('attractions.manage');
    }

    public function render()
    {
        return view('livewire.admin.attracion-list-manage-add')->layout('components.layouts.dashboard-admin');
        ;
    }
}
