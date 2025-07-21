<?php

namespace App\Livewire\Staff\Attraction;

use App\Models\Attraction;
use App\Models\UserAttraction;
use Livewire\Component;

class Dashboard extends Component
{
    public $staffId;
    public $attraction;
    public $totalBookings;
    public $todayBookings;
    public $weeklyBookings;

    public function mount()
    {
        $this->staffId = session('staff_id');
        
        if (!$this->staffId) {
            return redirect('/admin/login');
        }

        // Get attraction managed by this staff
        $this->attraction = Attraction::where('staff_id', $this->staffId)->first();
        
        if ($this->attraction) {
            $this->totalBookings = UserAttraction::where('attraction_id', $this->attraction->id)->count();
            $this->todayBookings = UserAttraction::where('attraction_id', $this->attraction->id)
                ->whereDate('created_at', today())->count();
            $this->weeklyBookings = UserAttraction::where('attraction_id', $this->attraction->id)
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        }
    }

    public function render()
    {
        return view('livewire.staff.attraction.dashboard')
            ->layout('components.layouts.dashboard-attraction');
    }
}
