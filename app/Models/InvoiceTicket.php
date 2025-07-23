<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceTicket extends Model
{
    protected $fillable = ['ticket_id', 'invoice_id', 'quantity', 'used_quantity'];
    
    protected $attributes = [
        'quantity' => 1,
        'used_quantity' => 0
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
