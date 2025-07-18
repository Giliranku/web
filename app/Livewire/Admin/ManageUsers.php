<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $selectedUser = null;
    public $showModal = false;
    public $deleteUserId = null;

    protected $queryString = ['search', 'sortBy', 'sortDirection'];

    public function updatingSearch()
    {
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
    }

    public function showUserDetail($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedUser = null;
    }

    public function confirmDelete($userId)
    {
        $this->deleteUserId = $userId;
    }

    public function deleteUser()
    {
        if ($this->deleteUserId) {
            $user = User::find($this->deleteUserId);
            if ($user) {
                $user->delete();
                session()->flash('success', 'User berhasil dihapus.');
            }
        }
        $this->deleteUserId = null;
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('number', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.manage-users', compact('users'))
            ->layout('components.layouts.dashboard-admin');
    }
}
