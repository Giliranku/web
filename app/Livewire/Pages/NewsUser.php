<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\News;

class NewsUser extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'sortBy' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc']
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->sortBy = 'created_at';
        $this->sortDirection = 'desc';
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
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
        if (!empty($this->category)) {
            $query->byCategory($this->category);
        }

        // Apply sorting
        $query->orderBy($this->sortBy, $this->sortDirection);

        $news = $query->paginate(9);

        return view('livewire.pages.news-user', [
            'news' => $news,
            'categories' => [
                'info' => 'Info Giliranku',
                'promo' => 'Promo Spesial', 
                'kegiatan' => 'Kegiatan Seru',
                'wahana' => 'Info Wahana'
            ]
        ]);
    }
}
