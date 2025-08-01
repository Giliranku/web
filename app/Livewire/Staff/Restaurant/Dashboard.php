<?php

namespace App\Livewire\Staff\Restaurant;

use App\Models\Restaurant;
use App\Models\UserRestaurant;
use Livewire\Component;

class Dashboard extends Component
{
    public $staffId;
    public $restaurant;
    public $totalBookings;
    public $todayBookings;
    public $weeklyBookings;

    public function mount()
    {
        $this->staffId = session('staff_id');
        
        if (!$this->staffId) {
            return redirect('/admin/login');
        }

        // Get restaurant managed by this staff
        $this->restaurant = Restaurant::where('staff_id', $this->staffId)->first();
        
        if ($this->restaurant) {
            $this->totalBookings = UserRestaurant::where('restaurant_id', $this->restaurant->id)->count();
            $this->todayBookings = UserRestaurant::where('restaurant_id', $this->restaurant->id)
                ->whereDate('created_at', today())->count();
            $this->weeklyBookings = UserRestaurant::where('restaurant_id', $this->restaurant->id)
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        }
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
        return view('livewire.staff.restaurant.dashboard')
            ->layout('components.layouts.dashboard-restaurant');
    }
}
