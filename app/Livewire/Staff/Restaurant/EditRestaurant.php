<?php

namespace App\Livewire\Staff\Restaurant;

use App\Models\Restaurant;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditRestaurant extends Component
{
    use WithFileUploads;

    public $restaurantId;
    public $restaurant;
    public $name;
    public $location;
    public $capacity;
    public $time_estimation;
    public $players_per_round;
    public $estimated_time_per_round;
    public $description;
    public $category;
    public $cover;
    public $img1;
    public $img2;
    public $img3;
    public $newCover;
    public $newImg1;
    public $newImg2;
    public $newImg3;

    protected $rules = [
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'capacity' => 'nullable|integer|min:1',
        'time_estimation' => 'nullable|integer|min:1',
        'players_per_round' => 'required|integer|min:1',
        'estimated_time_per_round' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'category' => 'nullable|string|max:100',
        'newCover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'newImg1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'newImg2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'newImg3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ];

    public function mount()
    {
        $staffId = session('staff_id');
        if (!$staffId) {
            return redirect('/admin/login');
        }

        $this->restaurant = Restaurant::where('staff_id', $staffId)->first();
        
        if (!$this->restaurant) {
            return redirect('/staff/restaurant/dashboard')->with('error', 'Restaurant not found.');
        }

        $this->restaurantId = $this->restaurant->id;
        $this->name = $this->restaurant->name;
        $this->location = $this->restaurant->location;
        $this->capacity = $this->restaurant->capacity;
        $this->time_estimation = $this->restaurant->time_estimation;
        $this->players_per_round = $this->restaurant->players_per_round ?? 1;
        $this->estimated_time_per_round = $this->restaurant->estimated_time_per_round ?? 30;
        $this->description = $this->restaurant->description;
        $this->category = $this->restaurant->category;
        $this->cover = $this->restaurant->cover;
        $this->img1 = $this->restaurant->img1;
        $this->img2 = $this->restaurant->img2;
        $this->img3 = $this->restaurant->img3;
    }

    public function updateRestaurant()
    {
        $this->validate();

        try {
            $data = [
                'name' => $this->name,
                'location' => $this->location,
                'capacity' => $this->capacity,
                'time_estimation' => $this->time_estimation,
                'players_per_round' => $this->players_per_round,
                'estimated_time_per_round' => $this->estimated_time_per_round,
                'description' => $this->description,
                'category' => $this->category,
            ];

            // Handle cover image upload
            if ($this->newCover) {
                $filename = time() . '_cover_' . $this->newCover->getClientOriginalName();
                $this->newCover->move(public_path('img'), $filename);
                $data['cover'] = $filename;
                
                // Delete old cover if exists
                if ($this->cover && file_exists(public_path('img/' . $this->cover))) {
                    unlink(public_path('img/' . $this->cover));
                }
            }

            // Handle img1 upload
            if ($this->newImg1) {
                $filename = time() . '_img1_' . $this->newImg1->getClientOriginalName();
                $this->newImg1->move(public_path('img'), $filename);
                $data['img1'] = $filename;
                
                if ($this->img1 && file_exists(public_path('img/' . $this->img1))) {
                    unlink(public_path('img/' . $this->img1));
                }
            }

            // Handle img2 upload
            if ($this->newImg2) {
                $filename = time() . '_img2_' . $this->newImg2->getClientOriginalName();
                $this->newImg2->move(public_path('img'), $filename);
                $data['img2'] = $filename;
                
                if ($this->img2 && file_exists(public_path('img/' . $this->img2))) {
                    unlink(public_path('img/' . $this->img2));
                }
            }

            // Handle img3 upload
            if ($this->newImg3) {
                $filename = time() . '_img3_' . $this->newImg3->getClientOriginalName();
                $this->newImg3->move(public_path('img'), $filename);
                $data['img3'] = $filename;
                
                if ($this->img3 && file_exists(public_path('img/' . $this->img3))) {
                    unlink(public_path('img/' . $this->img3));
                }
            }

            $this->restaurant->update($data);

            session()->flash('success', 'Restaurant berhasil diperbarui!');
            return redirect('/staff/restaurant/dashboard');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.staff.restaurant.edit-restaurant')
            ->layout('components.layouts.dashboard-restaurant');
    }
}
