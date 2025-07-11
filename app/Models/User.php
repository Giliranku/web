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
        'location'
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
        return $this->belongsToMany(Attraction::class);
    }

    public function restaurants(){
        return $this->belongsToMany(Restaurant::class, 'user_restaurants')->using(UserRestaurant::class);

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
