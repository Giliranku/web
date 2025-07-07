<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\News;

class NewsUser extends Component
{
    public $news;

    public function mount()
    {
        $this->news = News::all();
    }

    public function render()
    {
        return view('livewire.pages.news-user');
    }
}
