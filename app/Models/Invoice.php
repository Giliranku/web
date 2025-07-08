<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['ticket_id', 'invoice_id'];

    public function users(){
        return $this->belongsTo(User::class);
    }
    
    public function tickets(){
        return $this->belongsToMany(Ticket::class);
    }
}
