<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceTicket extends Model
{
    protected $fillable = ['ticket_id', 'invoice_id'];
}
