<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Restaurant;

class RestaurantManage extends Component
{
    use WithPagination;

    public $search = '';
    public $filterType = 'none';
    public $confirmingDeleteId = null;

    protected $paginationTheme = 'bootstrap';

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete()
    {
        Restaurant::findOrFail($this->confirmingDeleteId)->delete();
        $this->confirmingDeleteId = null;
        session()->flash('message', 'Restoran berhasil dihapus.');
    }

    public function render()
    {
        $query = Restaurant::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        switch ($this->filterType) {
            case 'capacity_asc':
                $query->orderBy('capacity', 'asc');
                break;
            case 'capacity_desc':
                $query->orderBy('capacity', 'desc');
                break;
            case 'time_estimation_asc':
                $query->orderBy('time_estimation', 'asc');
                break;
            case 'time_estimation_desc':
                $query->orderBy('time_estimation', 'desc');
                break;
        }

        $restaurants = $query->paginate(10);

        return view('livewire.admin.restaurant-manage', [
            'restaurants' => $restaurants
        ]);
    }
}
