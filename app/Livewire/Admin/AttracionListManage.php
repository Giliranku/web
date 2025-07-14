<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attraction;

class AttracionListManage extends Component
{
    use WithPagination;

    public $search = '';
    public $filterType = 'Wahana';

    protected $queryString = ['search', 'filterType'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Attraction::query();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        // Only attractions by default; you can extend to restaurants if you add a type column
        if ($this->filterType === 'Wahana') {
            // no extra clause, or ->where('type','wahana')
        }

        $attractions = $query->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.attracion-list-manage', [
            'attractions' => $attractions,
        ]);
    }
}
