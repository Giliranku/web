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
    public $duration;
    public $photo;

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
        $this->duration = $attraction->duration;
    }

    public function save()
    {
        $this->validate();

        if ($this->photo) {
            $path = $this->photo->store('attractions', 'public');
            $this->attraction->cover = $path;
        }

        $this->attraction->update([
            'name' => $this->name,
            'description' => $this->description,
            'capacity' => $this->capacity,
            'duration' => $this->duration,
        ]);

        session()->flash('success', 'Data wahana berhasil diperbarui.');

        return redirect()->route('admin.attractions.manage');
    }

}
