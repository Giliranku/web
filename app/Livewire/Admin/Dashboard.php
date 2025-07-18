<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Staff;
use App\Models\Attraction;
use App\Models\Restaurant;
use App\Models\News;
use App\Models\Ticket;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalUsers;
    public $totalStaff;
    public $totalAttractions;
    public $totalRestaurants;
    public $totalNews;
    public $totalTickets;
    public $latestNews;
    public $userGrowth;
    public $staffGrowth;

    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalStaff = Staff::count();
        $this->totalAttractions = Attraction::count();
        $this->totalRestaurants = Restaurant::count();
        $this->totalNews = News::count();
        $this->totalTickets = Ticket::count();
        
        $this->latestNews = News::with('staff')
            ->latest()
            ->take(3)
            ->get();
        
        // Calculate growth (last 30 days vs previous 30 days)
        $this->userGrowth = $this->calculateGrowth(User::class);
        $this->staffGrowth = $this->calculateGrowth(Staff::class);
    }

    private function calculateGrowth($model)
    {
        $currentMonth = $model::whereBetween('created_at', [
            now()->subMonth(),
            now()
        ])->count();
        
        $previousMonth = $model::whereBetween('created_at', [
            now()->subMonths(2),
            now()->subMonth()
        ])->count();
        
        if ($previousMonth == 0) {
            return $currentMonth > 0 ? 100 : 0;
        }
        
        return round((($currentMonth - $previousMonth) / $previousMonth) * 100, 1);
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('components.layouts.dashboard-admin');
    }
}
