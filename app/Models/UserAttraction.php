<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAttraction extends Pivot
{
    protected $table = 'user_attractions';
    
    // Pivot models should have incrementing set to true if they have auto-incrementing IDs
    public $incrementing = true;
    
    // Pivot models should have timestamps enabled if they use timestamps
    public $timestamps = true;
    
    protected $fillable = [
        'user_id', 
        'attraction_id', 
        'invoice_id',
        'slot_number',
        'queue_position',
        'reservation_date',
        'reservation_time',
        'status',
        'is_fast_pass',
        'priority_level',
        'created_at'
    ];
    
    protected $casts = [
        'reservation_date' => 'date',
        'reservation_time' => 'datetime:H:i',
        'is_fast_pass' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attraction(): BelongsTo
    {
        return $this->belongsTo(Attraction::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    // Scope untuk mendapatkan antrian berdasarkan tanggal
    public function scopeForDate($query, $date)
    {
        return $query->where('reservation_date', $date);
    }

    // Scope untuk mendapatkan antrian yang masih waiting
    public function scopeWaiting($query)
    {
        return $query->where('status', 'waiting');
    }

    // Scope untuk mengurutkan berdasarkan posisi antrian
    public function scopeOrderByQueue($query)
    {
        return $query->orderBy('queue_position');
    }

    // Scope untuk mengurutkan berdasarkan prioritas khusus
    public function scopeOrderByPriority($query)
    {
        return $query->orderByRaw("
            CASE 
                WHEN priority_level = 1 AND status = 'called' THEN 1
                WHEN priority_level = 1 AND status = 'waiting' THEN 2
                WHEN priority_level = 2 AND status = 'waiting' THEN 3
                WHEN priority_level = 2 AND status = 'called' THEN 3
                WHEN priority_level = 1 AND status = 'served' THEN 4
                WHEN priority_level = 2 AND status = 'served' THEN 5
                WHEN status = 'cancelled' THEN 6
                ELSE 7
            END
        ")->orderBy('created_at');
    }

    // Scope untuk fast pass queue
    public function scopeFastPass($query)
    {
        return $query->where('is_fast_pass', true);
    }

    // Scope untuk regular queue
    public function scopeRegular($query)
    {
        return $query->where('is_fast_pass', false);
    }

    /**
     * Get the formatted priority level for display
     */
    public function getFormattedPriorityAttribute()
    {
        return $this->is_fast_pass ? 'Fast Pass' : 'Regular';
    }
}
