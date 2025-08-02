<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'name', 'logo', 'price', 'price_before', 'terms_and_conditions', 'usage', 
        'location', 'attraction_id', 'restaurant_id', 'ticket_type', 'fast_pass_price_multiplier'
    ];

    protected $casts = [
        'fast_pass_price_multiplier' => 'decimal:2',
    ];

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

    /**
     * Get the correct image URL, handling both seeder images and admin uploads
     */
    public function getImageUrlAttribute()
    {
        if (!$this->logo) {
            return asset('img/default-placeholder.svg');
        }

        // Check if it's a storage path (admin uploads)
        $storagePath = public_path('storage/' . $this->logo);
        if (file_exists($storagePath)) {
            return asset('storage/' . $this->logo);
        }

        // Check if it's in the img directory (seeder images)
        $imgPath = public_path('img/' . $this->logo);
        if (file_exists($imgPath)) {
            return asset('img/' . $this->logo);
        }

        // Fallback to default placeholder image
        return asset('img/default-placeholder.svg');
    }

    /**
     * Helper method to get logo with fallback
     */
    public function getLogoUrl()
    {
        return $this->getImageUrlAttribute();
    }

    /**
     * Check if this is a fast pass ticket
     */
    public function isFastPass()
    {
        return $this->ticket_type === 'fast_pass';
    }

    /**
     * Get the effective price for this ticket (including fast pass multiplier)
     */
    public function getEffectivePriceAttribute()
    {
        if ($this->isFastPass()) {
            return $this->price * $this->fast_pass_price_multiplier;
        }
        return $this->price;
    }

    /**
     * Get formatted ticket type for display
     */
    public function getFormattedTicketTypeAttribute()
    {
        return $this->ticket_type === 'fast_pass' ? 'Fast Pass' : 'Regular';
    }
}
