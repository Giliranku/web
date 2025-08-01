<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\News;

class ManageNews extends Component
{
    public $search = '';
    public $selectedCategory = 'Semua Kategori';

    public function render()
    {
        // For testing purposes, we'll use sample data
        // In production, this should come from the News model
        $news = collect([
            (object)[
                'id' => 1,
                'title' => 'Kenapa Harus ke Ancol?',
                'category' => 'Event',
                'image' => 'info3.jpg',
                'description' => 'Berita terbaru tentang Ancol',
                'created_at' => now()->subDays(2)
            ],
            (object)[
                'id' => 2,
                'title' => 'Restoran Baru di Dufan',
                'category' => 'Restoran',
                'image' => 'restaurant1.jpg',
                'description' => 'Restoran terbaru dengan menu spesial',
                'created_at' => now()->subDays(1)
            ],
            (object)[
                'id' => 3,
                'title' => 'Wahana Baru Tornado',
                'category' => 'Wahana',
                'image' => 'tornado.jpg',
                'description' => 'Wahana terbaru yang menantang',
                'created_at' => now()
            ]
        ]);

        // Filter by search
        if ($this->search) {
            $news = $news->filter(function ($item) {
                return stripos($item->title, $this->search) !== false;
            });
        }

        // Filter by category
        if ($this->selectedCategory !== 'Semua Kategori') {
            $news = $news->filter(function ($item) {
                return $item->category === $this->selectedCategory;
            });
        }

        return view('livewire.admin.manage-news', [
            'newsList' => $news,
            'totalNews' => $news->count()
        ])->layout('components.layouts.dashboard-admin');
    }
}
