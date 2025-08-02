<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Model
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
        'staff_id',
        'players_per_round',
        'estimated_time_per_round'
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_restaurants')
            ->using(UserRestaurant::class)
            ->withPivot([
                'id',
                'invoice_id',
                'slot_number',
                'queue_position',
                'reservation_date',
                'reservation_time',
                'status'
            ])
            ->withTimestamps();
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

    // Method untuk menghitung estimated waiting time untuk user
    public function getEstimatedWaitingTime($userPosition)
    {
        if ($userPosition <= 0) {
            return 0;
        }

        // Hitung berapa grup permainan yang harus menunggu
        $roundsToWait = ceil($userPosition / $this->players_per_round);
        
        // Estimasi waktu tunggu = jumlah grup permainan * waktu per grup permainan
        return $roundsToWait * $this->estimated_time_per_round;
    }

    // Method untuk cek apakah user bisa mengantri di wahana lain
    public function canUserQueueElsewhere($userPosition)
    {
        // User bisa mengantri di tempat lain jika masih ada 2 grup permainan atau lebih
        $roundsToWait = ceil($userPosition / $this->players_per_round);
        return $roundsToWait >= 2;
    }

    // Method untuk mendapatkan posisi antrian user
    public function getUserQueuePosition($userId)
    {
        $todayQueue = $this->getTodayQueue();
        $position = 0;
        
        foreach ($todayQueue as $index => $queue) {
            if ($queue->user_id == $userId) {
                $position = $index + 1;
                break;
            }
        }
        
        return $position;
    }

    /**
     * Get the correct image URL, handling both seeder images and admin uploads
     */
    public function getImageUrl($imageName)
    {
        if (!$imageName) {
            return asset('img/default-placeholder.svg');
        }

        // Check if it's a storage path (admin uploads)
        $storagePath = public_path('storage/' . $imageName);
        if (file_exists($storagePath)) {
            return asset('storage/' . $imageName);
        }

        // Check if it's in the img directory (seeder images)
        $imgPath = public_path('img/' . $imageName);
        if (file_exists($imgPath)) {
            return asset('img/' . $imageName);
        }

        // Fallback to default if image not found
        return asset('img/default-placeholder.svg');
    }

    // Helper methods untuk mendapatkan URL gambar
    public function getCoverUrlAttribute()
    {
        return $this->getImageUrl($this->cover);
    }

    public function getImg1UrlAttribute()
    {
        return $this->getImageUrl($this->img1);
    }

    public function getImg2UrlAttribute()
    {
        return $this->getImageUrl($this->img2);
    }

    public function getImg3UrlAttribute()
    {
        return $this->getImageUrl($this->img3);
    }
}
