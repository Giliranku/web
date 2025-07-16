<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\News;

class ManageNewsEdit extends Component
{
    use WithFileUploads;

    public $newsId;
    public $title;
    public $author_name;
    public $keywords;
    public $description;
    public $content;
    public $news_cover;
    public $oldCover;

    public function mount($news)
    {
        $data = News::findOrFail($news);

        $this->newsId = $data->id;
        $this->title = $data->title;
        $this->author_name = $data->author_name;
        $this->keywords = $data->keywords;
        $this->description = $data->description;
        $this->content = $data->content;
        $this->oldCover = $data->news_cover;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'keywords' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'news_cover' => 'nullable|image|max:2048',
        ]);

        $news = News::findOrFail($this->newsId);

        if ($this->news_cover) {
            $path = $this->news_cover->store('public/news_covers');
            $news->news_cover = str_replace('public/', 'storage/', $path);
        }

        $news->title = $this->title;
        $news->author_name = $this->author_name;
        $news->keywords = $this->keywords;
        $news->description = $this->description;
        $news->content = $this->content;
        $news->save();

        session()->flash('success', 'Berita berhasil diperbarui.');
        return redirect()->route('news.index');
    }

    public function render()
    {
        return view('livewire.admin.manage-news-edit')
            ->layout('components.layouts.dashboard-admin');
    }
}
