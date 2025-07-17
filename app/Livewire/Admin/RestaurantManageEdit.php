<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Attraction;
use Illuminate\Support\Facades\Storage;

class RestaurantManageEdit extends Component
{
    use WithFileUploads;

    public $attractionId;
    public $name, $description, $capacity, $duration;
    public $photo;
    public $img1, $img2, $img3;
    public $existingPhoto;
    public $existingImg1, $existingImg2, $existingImg3;

    public function mount($id)
    {
        $attraction = Attraction::findOrFail($id);
        $this->attractionId = $attraction->id;
        $this->name = $attraction->name;
        $this->description = $attraction->description;
        $this->capacity = $attraction->capacity;
        $this->duration = $attraction->duration;
        $this->existingPhoto = $attraction->cover_image;
        $this->existingImg1 = $attraction->image_1;
        $this->existingImg2 = $attraction->image_2;
        $this->existingImg3 = $attraction->image_3;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'duration' => 'required|numeric|min:0.1',
            'photo' => 'nullable|image|max:2048',
            'img1' => 'nullable|image|max:2048',
            'img2' => 'nullable|image|max:2048',
            'img3' => 'nullable|image|max:2048',
        ]);

        $attraction = Attraction::findOrFail($this->attractionId);

        // Handle cover image
        if ($this->photo) {
            if ($this->existingPhoto) {
                Storage::disk('public')->delete($this->existingPhoto);
            }
            $this->existingPhoto = $this->photo->store('attractions', 'public');
        }

        // Handle thumbnails
        foreach ([1, 2, 3] as $i) {
            $prop = 'img' . $i;
            $existingProp = 'existingImg' . $i;
            if ($this->$prop) {
                if ($this->$existingProp) {
                    Storage::disk('public')->delete($this->$existingProp);
                }
                $this->$existingProp = $this->$prop->store('attractions', 'public');
            }
        }

        $attraction->update([
            'name' => $this->name,
            'description' => $this->description,
            'capacity' => $this->capacity,
            'duration' => $this->duration,
            'cover_image' => $this->existingPhoto,
            'image_1' => $this->existingImg1,
            'image_2' => $this->existingImg2,
            'image_3' => $this->existingImg3,
        ]);

        session()->flash('success', 'Data wahana berhasil diperbarui.');
        return redirect()->route('admin.attractions');
    }

    public function render()
    {
        return view('livewire.admin.restaurant-manage-edit');
    }
}
