<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'description', 'keywords', 'news_cover', 'staff_id', 'content'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }
}
