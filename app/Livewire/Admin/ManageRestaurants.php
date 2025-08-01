<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Restaurant;
use App\Models\Staff;

class ManageRestaurants extends Component
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
            $restaurant = Restaurant::find($this->deleteId);
            if ($restaurant) {
                $restaurant->delete();
                session()->flash('success', 'Restoran berhasil dihapus.');
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
        $restaurantsQuery = Restaurant::query();

        if ($this->search) {
            $restaurantsQuery->where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterLocation) {
            $restaurantsQuery->where('location', $this->filterLocation);
        }

        if ($this->filterStaff) {
            if ($this->filterStaff === 'unassigned') {
                $restaurantsQuery->whereNull('staff_id');
            } else {
                $restaurantsQuery->where('staff_id', $this->filterStaff);
            }
        }

        $restaurants = $restaurantsQuery->with('staff')->paginate(10);
        $staff = Staff::all();

        return view('livewire.admin.manage-restaurants', [
            'restaurants' => $restaurants,
            'staff' => $staff
        ])->layout('components.layouts.dashboard-admin');
    }
}
