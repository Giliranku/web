<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Attraction;
use App\Models\Restaurant;

class WahanaDetails extends Component
{
    public $images = [];
    public $mainImage;
    public $restaurant;
    public $attraction;
    public $type;
    public $item;
    public $currentCapacity = 0;

    public function mount($restaurant = null, $attraction = null)
    {
        if ($restaurant) {
            $this->restaurant = Restaurant::findOrFail($restaurant);
            $this->item = $this->restaurant;
            $this->type = 'restaurant';
        } elseif ($attraction) {
            $this->attraction = Attraction::findOrFail($attraction);
            $this->item = $this->attraction;
            $this->type = 'attraction';
        } else {
            abort(404, 'Item not found');
        }

        // Setup images array
        $this->setupImages();
        
        // Set main image to cover by default
        $this->mainImage = $this->images[0] ?? asset('img/default-placeholder.jpg');
        
        // Get current capacity (simulated for now - in real app, this would come from queue data)
        $this->currentCapacity = rand(1, min(10, $this->item->capacity));
    }

    private function setupImages()
    {
        $this->images = [];
        
        // Always add cover image first if exists
        if ($this->item->cover) {
            $this->images[] = $this->getImageUrl($this->item->cover);
        }
        
        // Add additional images only if they exist and are different from cover
        if ($this->item->img1 && $this->item->img1 !== $this->item->cover) {
            $this->images[] = $this->getImageUrl($this->item->img1);
        }
        
        if ($this->item->img2 && $this->item->img2 !== $this->item->cover && $this->item->img2 !== $this->item->img1) {
            $this->images[] = $this->getImageUrl($this->item->img2);
        }
        
        if ($this->item->img3 && $this->item->img3 !== $this->item->cover && $this->item->img3 !== $this->item->img1 && $this->item->img3 !== $this->item->img2) {
            $this->images[] = $this->getImageUrl($this->item->img3);
        }
        
        // Remove duplicates just in case
        $this->images = array_unique($this->images);
        $this->images = array_values($this->images); // Re-index array
    }

    public function orderQueue()
    {
        // Redirect to reservation page
        if ($this->type === 'attraction') {
            return redirect()->route('attraction.reserve', ['attraction' => $this->item->id]);
        } else {
            return redirect()->route('restaurant.reserve', ['restaurant' => $this->item->id]);
        }
    }

    public function getTypeName()
    {
        return $this->type === 'attraction' ? 'Wahana' : 'Restoran';
    }

    public function getButtonText()
    {
        return $this->type === 'attraction' ? '⚡ Antri Sekarang' : '⚡ Antri Sekarang';
    }

    public function getButtonClass()
    {
        return $this->type === 'attraction' ? 'btn-primary' : 'btn-success';
    }

    public function getStaffInfo()
    {
        if ($this->item && $this->item->staff) {
            return $this->item->staff->name;
        }
        return 'Tidak ada info staff';
    }

    public function getImageCount()
    {
        return count($this->images);
    }

    /**
     * Get the correct image URL, handling both seeder images and admin uploads
     */
    private function getImageUrl($imageName)
    {
        if (!$imageName) {
            return asset('img/default-placeholder.jpg');
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
        return asset('img/default-placeholder.jpg');
    }

    public function render()
    {
        return view('livewire.pages.wahana-details');
    }
}
