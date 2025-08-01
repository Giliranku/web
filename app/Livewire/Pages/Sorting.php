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