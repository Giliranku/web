<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['staff_id', 'name', 'location', 'capacity', 'time_estimation', 'description', 'cover', 'img1', 'img2', 'img3'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
