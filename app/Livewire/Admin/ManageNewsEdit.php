<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ManageNewsEdit extends Component
{
    use WithFileUploads;

    public $newsId;
    public $title;
    public $author_name;
    public $keywords;
    public $description;
    public $content;
    public $category;
    public $news_cover;
    public $oldCover;
    public $newsData; // Tambah property untuk menyimpan data news

    public function mount($news)
    {
        $data = News::findOrFail($news);
        $this->newsData = $data; // Simpan data news untuk template

        $this->newsId = $data->id;
        $this->title = $data->title;
        $this->author_name = $data->author_name;
        $this->keywords = $data->keywords;
        $this->description = $data->description;
        $this->content = $data->content;
        $this->category = $data->category;
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
            'category' => 'required|in:info,promo,kegiatan,wahana',
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
        $news->category = $this->category;
        $news->save();

        session()->flash('success', 'Berita berhasil diperbarui.');
        return redirect()->route('admin.manage-news');
    }

    public function uploadTrixImage($file)
    {
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('trix_uploads', $filename, 'public');
        return asset('storage/' . $path);
    }

    public function render()
    {
        return view('livewire.admin.manage-news-edit')
            ->layout('components.layouts.dashboard-admin');
    }
}
