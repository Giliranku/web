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
            $this->images[] = asset('img/' . $this->item->cover);
        }
        
        // Add additional images only if they exist and are different from cover
        if ($this->item->img1 && $this->item->img1 !== $this->item->cover) {
            $this->images[] = asset('img/' . $this->item->img1);
        }
        
        if ($this->item->img2 && $this->item->img2 !== $this->item->cover && $this->item->img2 !== $this->item->img1) {
            $this->images[] = asset('img/' . $this->item->img2);
        }
        
        if ($this->item->img3 && $this->item->img3 !== $this->item->cover && $this->item->img3 !== $this->item->img1 && $this->item->img3 !== $this->item->img2) {
            $this->images[] = asset('img/' . $this->item->img3);
        }
        
        // Remove duplicates just in case
        $this->images = array_unique($this->images);
        $this->images = array_values($this->images); // Re-index array
    }

    public function orderQueue()
    {
        // Logic untuk pesan antrian
        if ($this->type === 'attraction') {
            session()->flash('message', 'Antrian untuk ' . $this->item->name . ' berhasil dipesan!');
        } else {
            session()->flash('message', 'Reservasi meja di ' . $this->item->name . ' berhasil dipesan!');
        }
        
        // Redirect ke halaman order atau halangan lain sesuai kebutuhan
        return redirect()->route('history');
    }

    public function getTypeName()
    {
        return $this->type === 'attraction' ? 'Wahana' : 'Restoran';
    }

    public function getButtonText()
    {
        return $this->type === 'attraction' ? '+ Pesan Antrian' : '+ Reservasi Meja';
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

    public function render()
    {
        return view('livewire.pages.wahana-details');
    }
}
