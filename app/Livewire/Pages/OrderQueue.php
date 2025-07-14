<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\Attraction;
use Illuminate\Support\Facades\Auth;

class OrderQueue extends Component
{
    public $type = 'restaurant';

    public function updatedType($value)
    {
        $this->type = $value;
    }

    public function render()
    {
        $userId = Auth::id();
        $restaurants = collect();
        $attractions = collect();

        if ($this->type === 'restaurant') {
            $restaurants = Restaurant::with(['users' => function($q) {
                $q->orderBy('user_restaurants.created_at');
            }])->withCount('users')->get();
            foreach ($restaurants as $restaurant) {
                $userIds = $restaurant->users->pluck('id')->toArray();
                $restaurant->user_queue_position = $userId ? array_search($userId, $userIds) : null;
            }
        } else {
            $attractions = Attraction::with(['users' => function($q) {
                $q->orderBy('user_attractions.created_at');
            }])->withCount('users')->get();
            foreach ($attractions as $attraction) {
                $userIds = $attraction->users->pluck('id')->toArray();
                $attraction->user_queue_position = $userId ? array_search($userId, $userIds) : null;
            }
        }

        return view('livewire.pages.order-queue', [
            'restaurants' => $restaurants,
            'attractions' => $attractions,
            'type' => $this->type,
        ]);
    }
}