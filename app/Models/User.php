<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'number',
        'location',
        'google_id',
        'avatar'
    ];

    public function accesibilityPreference()
    {
        return $this->hasOne(AccesibilityPreference::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function attractions()
    {
        return $this->belongsToMany(Attraction::class, 'user_attractions')
            ->using(UserAttraction::class)
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

    public function restaurants(){
        return $this->belongsToMany(Restaurant::class, 'user_restaurants')
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the user's avatar URL with fallback to default avatar
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
        
        // Return default avatar
        return asset('img/default-avatar.png');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
