<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Restaurant;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class EditRestaurant extends Component
{
    use WithFileUploads;

    public Restaurant $restaurant;
    public $name, $location, $capacity, $time_estimation, $description, $category, $staff_id;
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
        'category' => 'required|string',
        'staff_id' => 'nullable|exists:staff,id',
        'new_cover' => 'nullable|image|max:2048',
        'new_img1' => 'nullable|image|max:2048',
        'new_img2' => 'nullable|image|max:2048',
        'new_img3' => 'nullable|image|max:2048',
    ];

    public function mount(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
        $this->name = $restaurant->name;
        $this->location = $restaurant->location;
        $this->capacity = $restaurant->capacity;
        $this->time_estimation = $restaurant->time_estimation;
        $this->players_per_round = $restaurant->players_per_round ?? 1;
        $this->estimated_time_per_round = $restaurant->estimated_time_per_round ?? 30;
        $this->description = $restaurant->description;
        $this->category = $restaurant->category;
        $this->staff_id = $restaurant->staff_id;
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
            'category' => $this->category,
            'staff_id' => $this->staff_id,
        ];

        if ($this->new_cover) {
            if ($this->restaurant->cover) {
                Storage::disk('public')->delete($this->restaurant->cover);
            }
            $data['cover'] = $this->new_cover->store('restaurants', 'public');
        }

        if ($this->new_img1) {
            if ($this->restaurant->img1) {
                Storage::disk('public')->delete($this->restaurant->img1);
            }
            $data['img1'] = $this->new_img1->store('restaurants', 'public');
        }

        if ($this->new_img2) {
            if ($this->restaurant->img2) {
                Storage::disk('public')->delete($this->restaurant->img2);
            }
            $data['img2'] = $this->new_img2->store('restaurants', 'public');
        }

        if ($this->new_img3) {
            if ($this->restaurant->img3) {
                Storage::disk('public')->delete($this->restaurant->img3);
            }
            $data['img3'] = $this->new_img3->store('restaurants', 'public');
        }

        $this->restaurant->update($data);

        return redirect()->route('admin.restaurants.index')->with('success', 'Restoran berhasil diperbarui.');
    }

    public function render()
    {
        $staff = Staff::all();
        
        return view('livewire.admin.edit-restaurant', [
            'staff' => $staff
        ])->layout('components.layouts.dashboard-admin');
    }
}
