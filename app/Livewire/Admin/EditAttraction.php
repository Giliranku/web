<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Attraction;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class EditAttraction extends Component
{
    use WithFileUploads;

    public Attraction $attraction;
    public $name, $location, $capacity, $time_estimation, $description, $staff_id;
    public $players_per_round, $estimated_time_per_round;
    public $new_cover, $new_img1, $new_img2, $new_img3;

    protected $rules = [
        'name' => 'required|string|max:255',
        'location' => 'required|string',
        'capacity' => 'required|integer|min:1',
        'time_estimation' => 'required|integer|min:1',
        'players_per_round' => 'required|integer|min:1',
        'estimated_time_per_round' => 'required|integer|min:1',
        'description' => 'required|string',
        'staff_id' => 'nullable|exists:staff,id',
        'new_cover' => 'nullable|image|max:2048',
        'new_img1' => 'nullable|image|max:2048',
        'new_img2' => 'nullable|image|max:2048',
        'new_img3' => 'nullable|image|max:2048',
    ];

    public function mount(Attraction $attraction)
    {
        $this->attraction = $attraction;
        $this->name = $attraction->name;
        $this->location = $attraction->location;
        $this->capacity = $attraction->capacity;
        $this->time_estimation = $attraction->time_estimation;
        $this->players_per_round = $attraction->players_per_round ?? 1;
        $this->estimated_time_per_round = $attraction->estimated_time_per_round ?? 10;
        $this->description = $attraction->description;
        $this->staff_id = $attraction->staff_id;
    }

    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'location' => $this->location,
            'capacity' => $this->capacity,
            'time_estimation' => $this->time_estimation,
            'players_per_round' => $this->players_per_round,
            'estimated_time_per_round' => $this->estimated_time_per_round,
            'description' => $this->description,
            'staff_id' => $this->staff_id ?: null, // Convert empty string to null
        ];

        if ($this->new_cover) {
            if ($this->attraction->cover) {
                Storage::disk('public')->delete($this->attraction->cover);
            }
            $data['cover'] = $this->new_cover->store('attractions', 'public');
        }

        if ($this->new_img1) {
            if ($this->attraction->img1) {
                Storage::disk('public')->delete($this->attraction->img1);
            }
            $data['img1'] = $this->new_img1->store('attractions', 'public');
        }

        if ($this->new_img2) {
            if ($this->attraction->img2) {
                Storage::disk('public')->delete($this->attraction->img2);
            }
            $data['img2'] = $this->new_img2->store('attractions', 'public');
        }

        if ($this->new_img3) {
            if ($this->attraction->img3) {
                Storage::disk('public')->delete($this->attraction->img3);
            }
            $data['img3'] = $this->new_img3->store('attractions', 'public');
        }

        $this->attraction->update($data);

        return redirect()->route('admin.attractions.index')->with('success', 'Wahana berhasil diperbarui.');
    }

    public function getImageUrl($imagePath)
    {
        if (!$imagePath) {
            return null;
        }

        // Check if it's an external URL
        if (str_starts_with($imagePath, 'http')) {
            return $imagePath;
        }

        // Check if it contains slash (storage path)
        if (str_contains($imagePath, '/')) {
            return asset('storage/' . $imagePath);
        }

        // If no slash, it's probably from seeder in public/img directory
        return asset('img/' . $imagePath);
    }

    public function render()
    {
        $staff = Staff::all();
        
        return view('livewire.admin.edit-attraction', [
            'staff' => $staff
        ])->layout('components.layouts.dashboard-admin');
    }
}
