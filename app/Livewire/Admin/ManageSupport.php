<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\SupportTicket;
use Livewire\WithPagination;

class ManageSupport extends Component
{
    use WithPagination;

    public $selectedTicket = null;
    public $adminResponse = '';
    public $statusFilter = 'all';
    public $priorityFilter = 'all';
    public $searchTerm = '';

    protected $rules = [
        'adminResponse' => 'required|string|min:5'
    ];

    protected $messages = [
        'adminResponse.required' => 'Respon harus diisi',
        'adminResponse.min' => 'Respon minimal 5 karakter'
    ];

    protected $queryString = [
        'statusFilter' => ['except' => 'all'],
        'priorityFilter' => ['except' => 'all'],
        'searchTerm' => ['except' => '']
    ];

    public function mount()
    {
        // Pastikan ini adalah admin yang login
        if (!session('staff_id')) {
            return redirect('/admin/login');
        }
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingPriorityFilter()
    {
        $this->resetPage();
    }

    public function viewTicket($ticketId)
    {
        $this->selectedTicket = SupportTicket::with(['staff', 'respondedBy'])->findOrFail($ticketId);
        $this->adminResponse = $this->selectedTicket->admin_response ?? '';
    }

    public function closeModal()
    {
        $this->selectedTicket = null;
        $this->adminResponse = '';
        $this->resetValidation();
    }

    public function updateStatus($ticketId, $status)
    {
        $ticket = SupportTicket::findOrFail($ticketId);
        $ticket->update(['status' => $status]);

        session()->flash('success', 'Status tiket berhasil diupdate!');
    }

    public function respondToTicket()
    {
        $this->validate();

        $this->selectedTicket->update([
            'admin_response' => $this->adminResponse,
            'responded_at' => now(),
            'responded_by' => session('staff_id'),
            'status' => 'resolved'
        ]);

        session()->flash('success', 'Respon berhasil dikirim!');
        $this->closeModal();
    }

    public function render()
    {
        $query = SupportTicket::with(['staff', 'respondedBy']);

        // Filter berdasarkan status
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Filter berdasarkan prioritas
        if ($this->priorityFilter !== 'all') {
            $query->where('priority', $this->priorityFilter);
        }

        // Search
        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('ticket_number', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('subject', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                  ->orWhereHas('staff', function($staffQuery) {
                      $staffQuery->where('name', 'like', '%' . $this->searchTerm . '%');
                  });
            });
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistics
        $stats = [
            'total' => SupportTicket::count(),
            'open' => SupportTicket::whereIn('status', ['open', 'in_progress'])->count(),
            'resolved' => SupportTicket::whereIn('status', ['resolved', 'closed'])->count(),
            'high_priority' => SupportTicket::where('priority', 'high')->whereIn('status', ['open', 'in_progress'])->count()
        ];

        return view('livewire.admin.manage-support', [
            'tickets' => $tickets,
            'stats' => $stats
        ])->layout('components.layouts.dashboard-admin');
    }
}
