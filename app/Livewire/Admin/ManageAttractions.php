<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attraction;
use App\Models\Staff;

class ManageAttractions extends Component
{
    use WithPagination;

    public $search = '';
    public $filterLocation = '';
    public $filterStaff = '';
    public $deleteId = null;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterLocation()
    {
        $this->resetPage();
    }

    public function updatingFilterStaff()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        if ($this->deleteId) {
            $attraction = Attraction::find($this->deleteId);
            if ($attraction) {
                $attraction->delete();
                session()->flash('success', 'Wahana berhasil dihapus.');
            }
        }
        $this->deleteId = null;
    }

    public function getImageUrl($imagePath)
    {
        if (!$imagePath) {
            return null;
        }

        // Check if it's an external URL
        if (str_starts_with($imagePath, 'http')) {
            return $imagePath;
        }

        // Check if it contains slash (storage path)
        if (str_contains($imagePath, '/')) {
            return asset('storage/' . $imagePath);
        }

        // If no slash, it's probably from seeder in public/img directory
        return asset('img/' . $imagePath);
    }

    public function render()
    {
        $attractionsQuery = Attraction::query();

        if ($this->search) {
            $attractionsQuery->where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterLocation) {
            $attractionsQuery->where('location', $this->filterLocation);
        }

        if ($this->filterStaff) {
            if ($this->filterStaff === 'unassigned') {
                $attractionsQuery->whereNull('staff_id');
            } else {
                $attractionsQuery->where('staff_id', $this->filterStaff);
            }
        }

        $attractions = $attractionsQuery->with('staff')->paginate(10);
        $staff = Staff::all();

        return view('livewire.admin.manage-attractions', [
            'attractions' => $attractions,
            'staff' => $staff
        ])->layout('components.layouts.dashboard-admin');
    }
}
