<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    protected $fillable = ['name', 'location', 'capacity', 'time_estimation', 'description', 'cover', 'img1', 'img2', 'img3'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_attractions')->using(UserAttraction::class);
    }
}
