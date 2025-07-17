<?php

namespace App\Livewire\Admin;
use App\Models\Restaurant;
use App\Models\Staff;
use Livewire\Component;
use Livewire\WithFileUploads;

class RestaurantManageAdd extends Component
{
    use WithFileUploads;

    public $name, $location, $description, $capacity, $time_estimation, $photo;

    public function render()
    {
        return view('livewire.admin.restaurant-manage-add');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'time_estimation' => 'required|integer|min:1',
            'photo' => 'required|image|max:2048',
        ]);

        $coverPath = $this->photo->store('restaurant_covers', 'public');

        Restaurant::create([
            'name' => $this->name,
            'location' => $this->location,
            'description' => $this->description,
            'capacity' => $this->capacity,
            'time_estimation' => $this->time_estimation,
            'cover' => $coverPath,
            'img1' => $coverPath,
            'img2' => $coverPath,
            'img3' => $coverPath,
            'staff_id' => Staff::inRandomOrder()->first()->id,
        ]);

        session()->flash('success', 'Restoran berhasil ditambahkan.');
        return redirect()->route('restaurant.manage');
    }
}
