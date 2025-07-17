<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Attraction;

class AttracionListManageEdit extends Component
{
    use WithFileUploads;

    public Attraction $attraction;

    public $name;
    public $description;
    public $capacity;
    public $duration;    // dalam satuan jam
    public $photo;       // upload file baru
    public $cover;       // path cover lama

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'duration' => 'required|numeric|min:0.1',
            'photo' => 'nullable|image|max:2048',
        ];
    }

    public function mount(Attraction $attraction)
    {
        $this->attraction = $attraction;
        $this->name = $attraction->name;
        $this->description = $attraction->description;
        $this->capacity = $attraction->capacity;
        $this->duration = $attraction->time_estimation / 60; // konversi menit→jam
        $this->cover = $attraction->cover;               // path cover lama
    }


    public function update()
    {
        $this->validate();

        // jika ada upload baru, simpan dan timpa cover
        if ($this->photo) {
            $this->cover = $this->photo->store('attractions', 'public');
        }

        // simpan ke DB, gunakan kolom time_estimation
        $this->attraction->update([
            'name' => $this->name,
            'description' => $this->description,
            'capacity' => $this->capacity,
            'time_estimation' => intval($this->duration * 60),
            'cover' => $this->cover,
        ]);

        session()->flash('success', 'Wahana berhasil diperbarui.');
        return redirect()->route('attractions.manage');
    }

    public function render()
    {
        return view('livewire.admin.attracion-list-manage-edit')
            ->layout('components.layouts.dashboard-admin');
    }
}
