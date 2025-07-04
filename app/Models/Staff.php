<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['name', 'email', 'number'];

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
