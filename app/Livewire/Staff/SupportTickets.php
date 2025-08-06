<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use App\Models\SupportTicket;
use Livewire\WithPagination;
use App\Traits\StaffLayoutTrait;

class SupportTickets extends Component
{
    use WithPagination, StaffLayoutTrait;

    public $showCreateForm = false;
    public $subject = '';
    public $description = '';
    public $priority = 'medium';
    public $selectedTicket = null;

    protected $rules = [
        'subject' => 'required|string|max:255',
        'description' => 'required|string|min:10',
        'priority' => 'required|in:low,medium,high'
    ];

    protected $messages = [
        'subject.required' => 'Subjek harus diisi',
        'subject.max' => 'Subjek maksimal 255 karakter',
        'description.required' => 'Deskripsi harus diisi',
        'description.min' => 'Deskripsi minimal 10 karakter',
        'priority.required' => 'Prioritas harus dipilih',
        'priority.in' => 'Prioritas tidak valid'
    ];

    public function mount()
    {
        // Pastikan staff sudah login
        if (!session('staff_id')) {
            return redirect('/staff/login');
        }
    }

    public function toggleCreateForm()
    {
        $this->showCreateForm = true;
        $this->resetForm();
    }

    public function hideCreateForm()
    {
        $this->showCreateForm = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->subject = '';
        $this->description = '';
        $this->priority = 'medium';
        $this->resetValidation();
    }

    public function createTicket()
    {
        $this->validate();

        $staffId = session('staff_id');

        SupportTicket::create([
            'ticket_number' => SupportTicket::generateTicketNumber(),
            'staff_id' => $staffId,
            'subject' => $this->subject,
            'description' => $this->description,
            'priority' => $this->priority,
            'status' => 'open'
        ]);

        session()->flash('success', 'Tiket bantuan berhasil dibuat!');
        $this->showCreateForm = false; // Explicitly set to false
        $this->resetForm();
        $this->resetPage();
    }

    public function viewTicket($ticketId)
    {
        $this->selectedTicket = SupportTicket::findOrFail($ticketId);
    }

    public function closeModal()
    {
        $this->selectedTicket = null;
    }

    public function render()
    {
        $staffId = session('staff_id');
        
        $tickets = SupportTicket::where('staff_id', $staffId)
            ->with(['staff', 'respondedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.staff.support-tickets', [
            'tickets' => $tickets
        ])->layout($this->getStaffLayout($staffId));
    }
}
