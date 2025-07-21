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

    public function news(){
        return $this->hasMany(News::class);
    }

    public function restaurant(){
        return $this->hasOne(Restaurant::class);
    }

    public function attraction(){
        return $this->hasOne(Attraction::class);
    }
}
