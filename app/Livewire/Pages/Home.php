<?php

namespace App\Livewire\Pages;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\News;

class Home extends Component
{
    public $searchQuery = '';

    public function search()
    {
        if (trim($this->searchQuery)) {
            return $this->redirect(route('queues.index', ['search' => $this->searchQuery]), navigate: true);
        }
    }

    public function redirectToTickets()
    {
        return $this->redirect(route('tiket-ecommerce'), navigate: true);
    }

    public function redirectToQueues($type = null)
    {
        $params = [];
        if ($type) {
            $params['type'] = $type;
        }
        return $this->redirect(route('queues.index', $params), navigate: true);
    }

    // Removed auto-search to only search on manual trigger (Enter key or button click)
    // public function updatedSearchQuery()
    // {
    //     // Auto-search when user types (optional - can be removed if you want only manual search)
    //     if (strlen(trim($this->searchQuery)) >= 3) {
    //         $this->search();
    //     }
    // }

    public function render()
    {
        // Get latest news by category for homepage
        $infoNews = News::byCategory('info')->orderBy('created_at', 'desc')->take(3)->get();
        $promoNews = News::byCategory('promo')->orderBy('created_at', 'desc')->take(3)->get();
        $kegiatanNews = News::byCategory('kegiatan')->orderBy('created_at', 'desc')->take(1)->get();

        return view('livewire.pages.home', [
            'infoNews' => $infoNews,
            'promoNews' => $promoNews,
            'kegiatanNews' => $kegiatanNews
        ]);
    }
}
