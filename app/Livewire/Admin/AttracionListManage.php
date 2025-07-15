<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attraction;

class AttracionListManage extends Component
{
    use WithPagination;

    public $search = '';
    public $filterType = 'none';
    public $deleteId;   // untuk menampung ID yang akan dihapus

    protected $queryString = ['search', 'filterType'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    // dipanggil saat user klik ikon trash
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    // dipanggil saat user klik “Hapus” di modal
    public function delete()
    {
        Attraction::destroy($this->deleteId);

        session()->flash('message', 'Wahana berhasil dihapus.');

        // gak perlu emit atau redirect, kita tetap di halaman daftar
    }

    public function render()
    {

        $query = Attraction::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"));

        if ($this->filterType !== 'none') {
            // pecah string by underscore
            $parts = explode('_', $this->filterType);
            // ambil elemen terakhir sebagai direction (asc|desc)
            $direction = array_pop($parts);
            // gabung sisanya jadi nama kolom: "time_estimation"
            $field = implode('_', $parts);

            // sekarang orderBy dengan benar
            $query->orderBy($field, $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return view('livewire.admin.attracion-list-manage', [
            'attractions' => $query->paginate(10),
        ]);
    }
}
