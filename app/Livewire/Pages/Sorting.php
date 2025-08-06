<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\Attraction;
use Illuminate\Support\Collection;

class Sorting extends Component
{
    public $sortBy = 'Terpopuler';
    public $category = 'Semua'; // Default: tampilkan semua
    public $search = '';
    public $searchQuery = ''; // Property untuk search input

    protected $queryString = [
        'sortBy' => ['except' => 'Terpopuler'],
        'category' => ['except' => 'Semua'],
        'searchQuery' => ['except' => '', 'as' => 'search'],
    ];

    public function mount()
    {
        // Mounting logic can be simplified as query string is handled automatically
    }

    // This is now redundant because of wire:model.live
    // public function updatedSearchQuery()
    // {
    //     $this->search = $this->searchQuery;
    // }

    // Tombol cari memanggil ini saja, biar Livewire update properti search
    public function doSearch()
    {
        // This method is now only for the explicit search button click.
        // The live search is handled by wire:model.live on the input.
        // We can force a re-render if needed, but it's usually automatic.
        $this->render();
    }

    public function render()
    {
        $restaurants = collect();
        $attractions = collect();

        // Query berdasarkan kategori
        if ($this->category === 'Restaurant') {
            $items = $this->getRestaurants();
        } elseif ($this->category === 'Attraction') {
            $items = $this->getAttractions();
        } else {
            $restaurants = $this->getRestaurants();
            $attractions = $this->getAttractions();
            $items = $restaurants->merge($attractions);
            $items = $this->sortCombined($items, $this->sortBy);
        }

        return view('livewire.pages.sorting', [
            'items' => $items,
        ]);
    }

    private function getRestaurants()
    {
        $query = Restaurant::query();
        if ($this->searchQuery) {
            $query->where('name', 'like', '%'.$this->searchQuery.'%');
        }
        switch ($this->sortBy) {
            case 'Nama A-Z': $query->orderBy('name', 'asc'); break;
            case 'Nama Z-A': $query->orderBy('name', 'desc'); break;
            case 'Kapasitas Terbesar': $query->orderBy('capacity', 'desc'); break;
            case 'Kapasitas Terkecil': $query->orderBy('capacity', 'asc'); break;
            case 'Terpopuler': 
            default: 
                $query->orderBy('capacity', 'desc'); 
                break;
        }
        return $query->get()->map(function($item) {
            $item->type = 'Restaurant';
            return $item;
        });
    }

    private function getAttractions()
    {
        $query = Attraction::query();
        if ($this->searchQuery) {
            $query->where('name', 'like', '%'.$this->searchQuery.'%');
        }
        switch ($this->sortBy) {
            case 'Nama A-Z': $query->orderBy('name', 'asc'); break;
            case 'Nama Z-A': $query->orderBy('name', 'desc'); break;
            case 'Kapasitas Terbesar': $query->orderBy('capacity', 'desc'); break;
            case 'Kapasitas Terkecil': $query->orderBy('capacity', 'asc'); break;
            case 'Terpopuler': 
            default: 
                $query->orderBy('capacity', 'desc'); 
                break;
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
            case 'Nama A-Z':
                return $items->sortBy('name')->values();
            case 'Nama Z-A':
                return $items->sortByDesc('name')->values();
            case 'Kapasitas Terbesar':
                return $items->sortByDesc('capacity')->values();
            case 'Kapasitas Terkecil':
                return $items->sortBy('capacity')->values();
            case 'Terpopuler':
            default:
                return $items->sortByDesc('capacity')->values();
        }
    }

    // Helper method untuk menangani path gambar
    public function getImageUrl($imagePath)
    {
        if (!$imagePath) {
            return asset('img/default-image.jpg'); // fallback image
        }

        // Jika gambar dari seeder (tanpa slash di depan dan tidak mengandung path storage)
        if (!str_starts_with($imagePath, '/') && !str_contains($imagePath, 'storage/')) {
            // Cek apakah file ada di public/img/
            if (file_exists(public_path('img/' . $imagePath))) {
                return asset('img/' . $imagePath);
            }
        }

        // Jika gambar dari upload (mengandung storage/ atau dimulai dengan /)
        if (str_contains($imagePath, 'storage/') || str_starts_with($imagePath, '/')) {
            $cleanPath = str_replace(['storage/', '/storage/', 'public/'], '', $imagePath);
            return asset('storage/' . $cleanPath);
        }

        // Jika path sudah lengkap dengan storage
        if (str_starts_with($imagePath, 'storage/')) {
            return asset($imagePath);
        }

        // Default: coba di storage terlebih dahulu
        $storagePath = 'storage/' . $imagePath;
        if (file_exists(public_path($storagePath))) {
            return asset($storagePath);
        }

        // Fallback: coba di img
        return asset('img/' . $imagePath);
    }
}