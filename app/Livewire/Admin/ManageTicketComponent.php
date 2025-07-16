<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Ticket;

class ManageTicketComponent extends Component
{
    public $deleteId = null;

    // Tampilkan modal konfirmasi delete
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    // Hapus tiket
    public function delete()
    {
        if ($this->deleteId) {
            $ticket = Ticket::find($this->deleteId);
            if ($ticket) {
                $ticket->delete();
                session()->flash('success', 'Tiket berhasil dihapus.');
            }
        }

        $this->deleteId = null;
    }

    // Query tiket, filter lokasi kalau ada
    public $filterLocation = 'Semua';

    public function render()
    {
        $tickets = Ticket::query();

        if ($this->filterLocation && $this->filterLocation !== 'Semua') {
            $tickets->where('location', $this->filterLocation);
        }

        return view('livewire.admin.manage-ticket-component', [
            'tickets' => $tickets->latest()->get(),
        ])->layout('components.layouts.dashboard-admin');
    }

}
