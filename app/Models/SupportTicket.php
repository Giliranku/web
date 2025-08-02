<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SupportTicket extends Model
{
    protected $fillable = [
        'ticket_number',
        'staff_id',
        'subject',
        'description',
        'priority',
        'status',
        'admin_response',
        'responded_at',
        'responded_by'
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    /**
     * Generate nomor tiket unik
     */
    public static function generateTicketNumber()
    {
        do {
            $ticketNumber = 'TKT-' . strtoupper(Str::random(8));
        } while (self::where('ticket_number', $ticketNumber)->exists());

        return $ticketNumber;
    }

    /**
     * Relasi dengan staff yang membuat tiket
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    /**
     * Relasi dengan admin yang merespon
     */
    public function respondedBy()
    {
        return $this->belongsTo(Staff::class, 'responded_by');
    }

    /**
     * Scope untuk tiket yang masih terbuka
     */
    public function scopeOpen($query)
    {
        return $query->whereIn('status', ['open', 'in_progress']);
    }

    /**
     * Scope untuk tiket yang sudah selesai
     */
    public function scopeResolved($query)
    {
        return $query->whereIn('status', ['resolved', 'closed']);
    }

    /**
     * Scope berdasarkan prioritas
     */
    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'open' => 'Terbuka',
            'in_progress' => 'Dalam Proses',
            'resolved' => 'Selesai',
            'closed' => 'Ditutup',
            default => 'Tidak Diketahui'
        };
    }

    /**
     * Get priority label
     */
    public function getPriorityLabelAttribute()
    {
        return match($this->priority) {
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi',
            default => 'Sedang'
        };
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'open' => 'bg-warning text-dark',
            'in_progress' => 'bg-info text-white',
            'resolved' => 'bg-success text-white',
            'closed' => 'bg-secondary text-white',
            default => 'bg-secondary text-white'
        };
    }

    /**
     * Get priority badge class
     */
    public function getPriorityBadgeClassAttribute()
    {
        return match($this->priority) {
            'low' => 'bg-success text-white',
            'medium' => 'bg-warning text-dark',
            'high' => 'bg-danger text-white',
            default => 'bg-warning text-dark'
        };
    }
}
