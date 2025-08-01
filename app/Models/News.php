<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'description', 'keywords', 'category', 'news_cover', 'staff_id', 'content', 'author_name'];

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    // Scope untuk kategori
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%')
              ->orWhere('keywords', 'like', '%' . $search . '%')
              ->orWhere('content', 'like', '%' . $search . '%');
        });
    }

    // Get category label
    public function getCategoryLabelAttribute()
    {
        return match($this->category) {
            'info' => 'Info Giliranku',
            'promo' => 'Promo Spesial',
            'kegiatan' => 'Kegiatan Seru',
            'wahana' => 'Info Wahana',
            default => 'Info'
        };
    }

    // Helper method untuk mendapatkan URL gambar yang benar
    public function getImageUrlAttribute()
    {
        return $this->getImageUrl($this->news_cover);
    }

    /**
     * Get the correct image URL, handling both seeder images and admin uploads
     */
    public function getImageUrl($imageName)
    {
        if (!$imageName) {
            return asset('img/default-placeholder.svg');
        }

        // Check if it's a storage path (admin uploads)
        $storagePath = public_path('storage/' . $imageName);
        if (file_exists($storagePath)) {
            return asset('storage/' . $imageName);
        }

        // Check if it's in the img directory (seeder images)
        $imgPath = public_path('img/' . $imageName);
        if (file_exists($imgPath)) {
            return asset('img/' . $imageName);
        }

        // Fallback to default if image not found
        return asset('img/default-placeholder.svg');
    }
}
