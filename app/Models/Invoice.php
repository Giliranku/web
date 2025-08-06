<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['total_price', 'payment_method', 'user_id', 'status', 'invoice_number'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = 'INV-' . date('Ymd') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Lunas',
            'refunded' => 'Dikembalikan',
            'cancelled' => 'Dibatalkan',
            default => 'Tidak Diketahui'
        };
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'pending' => 'bg-warning text-dark',
            'paid' => 'bg-success text-white',
            'refunded' => 'bg-info text-white',
            'cancelled' => 'bg-danger text-white',
            default => 'bg-secondary text-white'
        };
    }

    /**
     * Check if invoice can be refunded
     */
    public function canBeRefunded()
    {
        return $this->status === 'paid';
    }

    /**
     * Process refund
     */
    public function processRefund()
    {
        if (!$this->canBeRefunded()) {
            return false;
        }

        // Update status to refunded
        $this->update(['status' => 'refunded']);

        // Reset all ticket quantities to make them "hangus"
        foreach ($this->invoiceTickets as $invoiceTicket) {
            $invoiceTicket->update([
                'quantity' => 0,
                'used_quantity' => 0
            ]);
        }

        return true;
    }

    /**
     * Get total used tickets
     */
    public function getTotalUsedTicketsAttribute()
    {
        return $this->invoiceTickets->sum('used_quantity');
    }

    /**
     * Get total purchased tickets
     */
    public function getTotalPurchasedTicketsAttribute()
    {
        return $this->invoiceTickets->sum('quantity');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'invoice_tickets')
                    ->withPivot('quantity', 'used_quantity')
                    ->withTimestamps();
    }

    public function invoiceTickets()
    {
        return $this->hasMany(InvoiceTicket::class);
    }
}
