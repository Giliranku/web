<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class NewsIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $filterType = 'none'; // default harus sinkron dgn Alpine

    protected $queryString = ['search', 'filterType'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $news = News::findOrFail($id);

        if ($news->news_cover && Storage::disk('public')->exists($news->news_cover)) {
            Storage::disk('public')->delete($news->news_cover);
        }

        $news->delete();

        session()->flash('success', 'Berita berhasil dihapus.');
    }

    public function uploadTrixImage($file)
    {
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/trix_uploads', $filename);
        return asset(str_replace('public/', 'storage/', $path));
    }

    public function render()
    {
        $query = News::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"));

        if ($this->filterType !== 'none') {
            $parts = explode('_', $this->filterType);
            $direction = array_pop($parts);
            $field = implode('_', $parts);
            $query->orderBy($field, $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // ⬇️ PENTING: Pakai paginate di SINI
        $newsList = $query->paginate(10);

        return view('livewire.admin.news-index', [
            'newsList' => $newsList,
        ])->layout('components.layouts.dashboard-admin');
    }

}
