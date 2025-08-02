<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'number', 'location', 'avatar', 'role'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Get the staff's avatar URL with fallback to default avatar
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            // Check if file exists in storage
            if (file_exists(storage_path('app/public/' . $this->avatar))) {
                return asset('storage/' . $this->avatar);
            }
            // Check if file exists in public folder
            if (file_exists(public_path('img/' . $this->avatar))) {
                return asset('img/' . $this->avatar);
            }
        }
        
        // Return default avatar based on role
        return asset('img/default-staff.png');
    }

    public function news(){
        return $this->hasMany(News::class);
    }

    public function restaurant(){
        return $this->hasOne(Restaurant::class);
    }

    public function attraction(){
        return $this->hasOne(Attraction::class);
    }

    public function supportTickets(){
        return $this->hasMany(SupportTicket::class, 'staff_id');
    }

    public function respondedTickets(){
        return $this->hasMany(SupportTicket::class, 'responded_by');
    }
}
