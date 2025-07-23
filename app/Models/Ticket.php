<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['name', 'logo', 'price', 'price_before', 'terms_and_conditions', 'usage', 'location', 'attraction_id', 'restaurant_id'];

    public function invoices(){
        return $this->belongsToMany(Invoice::class);
    }

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
