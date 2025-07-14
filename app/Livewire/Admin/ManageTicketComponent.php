<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Ticket;

class ManageTicketComponent extends Component
{
    public $deleteId = null;

    // Fungsi untuk menampilkan modal dan menyimpan ID tiket yang akan dihapus
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    // Fungsi untuk menghapus data tiket berdasarkan ID
    public function delete()
    {
        if ($this->deleteId) {
            $ticket = Ticket::find($this->deleteId);
            if ($ticket) {
                $ticket->delete();
                session()->flash('success', 'Tiket berhasil dihapus.');
            }
        }

        // Reset ID setelah delete
        $this->deleteId = null;
    }

    // Render semua tiket
    public function render()
    {
        return view('livewire.admin.manage-ticket-component', [
            'tickets' => Ticket::latest()->get()
        ])->layout('components.layouts.dashboard-admin');
    }
}
