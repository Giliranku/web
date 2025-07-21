<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAttraction extends Model
{
    protected $table = 'user_attractions';
    
    protected $fillable = [
        'user_id', 
        'attraction_id', 
        'invoice_id',
        'slot_number',
        'queue_position',
        'reservation_date',
        'reservation_time',
        'status',
        'created_at'
    ];
    
    protected $casts = [
        'reservation_date' => 'date',
        'reservation_time' => 'datetime:H:i',
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
}
