<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\Attraction;
use Illuminate\Support\Collection;

class Sorting extends Component
{
    public $sortBy = 'Kapasitas Terbesar';
    public $category = 'Semua'; // Default: tampilkan semua
    public $search = '';

    protected $updatesQueryString = ['sortBy', 'category', 'search'];

    // Tombol cari memanggil ini saja, biar Livewire update properti search
    public function doSearch()
    {
        // Tidak perlu isi apa-apa, Livewire akan merender ulang otomatis
    }

    public function render()
    {
        $restaurants = collect();
        $attractions = collect();

        // Query berdasarkan kategori
        if ($this->category === 'Restoran') {
            $restaurants = $this->getRestaurants();
            $items = $restaurants;
        } elseif ($this->category === 'Attraction') {
            $attractions = $this->getAttractions();
            $items = $attractions;
        } else {
            $restaurants = $this->getRestaurants();
            $attractions = $this->getAttractions();
            $items = $restaurants->merge($attractions);
            // Sorting manual jika "Semua"
            $items = $this->sortCombined($items, $this->sortBy);
        }

        return view('livewire.pages.sorting', [
            'items' => $items,
        ]);
    }

    private function getRestaurants()
    {
        $query = Restaurant::query();
        if ($this->search) {
            $query->where('name', 'like', '%'.$this->search.'%');
        }
        switch ($this->sortBy) {
            case 'Kapasitas Terbesar': $query->orderBy('capacity', 'desc'); break;
            case 'Kapasitas Terkecil': $query->orderBy('capacity', 'asc'); break;
        }
        return $query->get()->map(function($item) {
            $item->type = 'Restoran';
            return $item;
        });
    }

    private function getAttractions()
    {
        $query = Attraction::query();
        if ($this->search) {
            $query->where('name', 'like', '%'.$this->search.'%');
        }
        switch ($this->sortBy) {
            case 'Kapasitas Terbesar': $query->orderBy('capacity', 'desc'); break;
            case 'Kapasitas Terkecil': $query->orderBy('capacity', 'asc'); break;
        }
        return $query->get()->map(function($item) {
            $item->type = 'Attraction';
            return $item;
        });
    }

    // Sorting jika kategori Semua (gabungan)
    private function sortCombined(Collection $items, $sortBy)
    {
        switch ($sortBy) {
            case 'Kapasitas Terbesar':
                return $items->sortByDesc('capacity')->values();
            case 'Kapasitas Terkecil':
                return $items->sortBy('capacity')->values();
            default:
                return $items;
        }
    }
}