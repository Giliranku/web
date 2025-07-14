<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['name', 'logo', 'price', 'price_before', 'terms_and_conditions', 'usage'];

    public function invoices(){
        return $this->belongsToMany(Invoice::class);
    }
}
