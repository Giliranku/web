<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\News;

class ManageNews extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategoryFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = News::with('staff');

        // Apply search
        if (!empty($this->search)) {
            $query->search($this->search);
        }

        // Apply category filter
        if (!empty($this->categoryFilter)) {
            $query->byCategory($this->categoryFilter);
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(10);

        $categories = [
            'info' => 'Info Giliranku',
            'promo' => 'Promo Spesial', 
            'kegiatan' => 'Kegiatan Seru',
            'wahana' => 'Info Wahana'
        ];

        return view('livewire.admin.manage-news', [
            'news' => $news,
            'categories' => $categories,
            'totalNews' => $news->total()
        ])->layout('components.layouts.dashboard-admin');
    }

    public function deleteNews($id)
    {
        $news = News::findOrFail($id);
        
        // Delete the news cover file if it exists
        if ($news->news_cover && file_exists(storage_path('app/public/' . $news->news_cover))) {
            unlink(storage_path('app/public/' . $news->news_cover));
        }

        $news->delete();
        
        session()->flash('success', 'Berita berhasil dihapus.');
    }
}
