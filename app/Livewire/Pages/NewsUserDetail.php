<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\News;

class NewsUserDetail extends Component
{
    public $newsId;
    public $news;
    public $otherNews;

    public function mount($id)
    {
        $this->newsId = $id;

        $this->news = News::with('staff')->findOrFail($id);

        $this->otherNews = News::where('id', '!=', $id)->latest()->take(2)->get();
    }

    public function render()
    {
        return view('livewire.pages.news-user-detail');
    }
}
