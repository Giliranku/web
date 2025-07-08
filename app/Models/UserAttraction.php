<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAttraction extends Model
{
    protected $table = 'user_restaurants';
    protected $fillable = ['user_id', 'attraction_id', 'created_at'];
    public $timestamp = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->created_at)) {
                $model->created_at = now();
            }
        });
    }
}
