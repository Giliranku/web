<?php

namespace App\Livewire\Pages;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\News;

class Home extends Component
{
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
