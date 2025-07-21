<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Model
{
    protected $fillable = [
        'staff_id', 
        'name', 
        'location', 
        'capacity', 
        'time_estimation', 
        'description', 
        'category',
        'cover', 
        'img1', 
        'img2', 
        'img3'
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_restaurants')->using(UserRestaurant::class);
    }

    public function userRestaurants(): HasMany
    {
        return $this->hasMany(UserRestaurant::class);
    }

    // Method untuk mendapatkan antrian hari ini
    public function getTodayQueue()
    {
        return $this->userRestaurants()
            ->forDate(today())
            ->waiting()
            ->orderByQueue()
            ->with('user')
            ->get();
    }

    // Method untuk mendapatkan available slots
    public function getAvailableSlots($date)
    {
        $usedSlots = $this->userRestaurants()
            ->forDate($date)
            ->where('status', '!=', 'cancelled')
            ->count();
            
        return max(0, $this->capacity - $usedSlots);
    }
}
