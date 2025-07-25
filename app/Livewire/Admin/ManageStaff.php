<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Staff;

class ManageStaff extends Component
{
    use WithPagination;

    public $search = '';
    public $filterRole = '';
    public $deleteId = null;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterRole()
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
            $staff = Staff::find($this->deleteId);
            if ($staff) {
                // Check if staff has associated attractions or restaurants
                if ($staff->attraction || $staff->restaurant) {
                    session()->flash('error', 'Tidak dapat menghapus staff yang masih mengelola wahana atau restoran.');
                } else {
                    $staff->delete();
                    session()->flash('success', 'Staff berhasil dihapus.');
                }
            }
        }
        $this->deleteId = null;
    }

    public function render()
    {
        $staffQuery = Staff::query();

        if ($this->search) {
            $staffQuery->where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterRole) {
            $staffQuery->where('role', $this->filterRole);
        }

        $staff = $staffQuery->with(['attraction', 'restaurant'])->paginate(10);

        return view('livewire.admin.manage-staff', [
            'staff' => $staff
        ])->layout('components.layouts.dashboard-admin');
    }
}
