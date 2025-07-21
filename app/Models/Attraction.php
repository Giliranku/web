<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attraction extends Model
{
    protected $fillable = [
        'name', 
        'location', 
        'capacity', 
        'time_estimation', 
        'description', 
        'category',
        'cover', 
        'img1', 
        'img2', 
        'img3', 
        'staff_id'
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_attractions')->using(UserAttraction::class);
    }

    public function userAttractions(): HasMany
    {
        return $this->hasMany(UserAttraction::class);
    }

    // Method untuk mendapatkan antrian hari ini
    public function getTodayQueue()
    {
        return $this->userAttractions()
            ->forDate(today())
            ->waiting()
            ->orderByQueue()
            ->with('user')
            ->get();
    }

    // Method untuk mendapatkan available slots
    public function getAvailableSlots($date)
    {
        $usedSlots = $this->userAttractions()
            ->forDate($date)
            ->where('status', '!=', 'cancelled')
            ->count();
            
        return max(0, $this->capacity - $usedSlots);
    }
}
