<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Invoice;
use App\Models\User;

class ManagePayments extends Component
{
    use WithPagination;

    public $selectedInvoice = null;
    public $statusFilter = 'all';
    public $searchTerm = '';
    public $showRefundModal = false;
    public $refundReason = '';

    protected $rules = [
        'refundReason' => 'required|string|min:10|max:255'
    ];

    protected $messages = [
        'refundReason.required' => 'Alasan refund harus diisi',
        'refundReason.min' => 'Alasan refund minimal 10 karakter',
        'refundReason.max' => 'Alasan refund maksimal 255 karakter'
    ];

    protected $queryString = [
        'statusFilter' => ['except' => 'all'],
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

    public function viewInvoice($invoiceId)
    {
        $this->selectedInvoice = Invoice::with(['user', 'invoiceTickets.ticket'])->findOrFail($invoiceId);
    }

    public function closeModal()
    {
        $this->selectedInvoice = null;
        $this->showRefundModal = false;
        $this->refundReason = '';
        $this->resetValidation();
    }

    public function showRefundForm($invoiceId)
    {
        $this->selectedInvoice = Invoice::with(['user', 'invoiceTickets.ticket'])->findOrFail($invoiceId);
        $this->showRefundModal = true;
        $this->refundReason = '';
    }

    public function processRefund()
    {
        $this->validate();

        if (!$this->selectedInvoice->canBeRefunded()) {
            session()->flash('error', 'Invoice tidak dapat di-refund!');
            return;
        }

        $success = $this->selectedInvoice->processRefund();

        if ($success) {
            session()->flash('success', 'Refund berhasil diproses! Tiket telah dibatalkan.');
            
            // Log refund activity (optional - could be stored in a separate table)
            \Log::info('Invoice refunded', [
                'invoice_id' => $this->selectedInvoice->id,
                'user_id' => $this->selectedInvoice->user_id,
                'amount' => $this->selectedInvoice->total_price,
                'reason' => $this->refundReason,
                'admin_id' => session('staff_id')
            ]);
        } else {
            session()->flash('error', 'Gagal memproses refund!');
        }

        $this->closeModal();
    }

    public function updateStatus($invoiceId, $status)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        
        if ($status === 'refunded' && !$invoice->canBeRefunded()) {
            session()->flash('error', 'Invoice tidak dapat di-refund!');
            return;
        }

        if ($status === 'refunded') {
            $invoice->processRefund();
            session()->flash('success', 'Invoice berhasil di-refund dan tiket dibatalkan!');
        } else {
            $invoice->update(['status' => $status]);
            session()->flash('success', 'Status invoice berhasil diupdate!');
        }
    }

    public function render()
    {
        $query = Invoice::with(['user', 'invoiceTickets']);

        // Filter berdasarkan status
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Search
        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('id', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('total_price', 'like', '%' . $this->searchTerm . '%')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('name', 'like', '%' . $this->searchTerm . '%')
                               ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
                  });
            });
        }

        $invoices = $query->orderBy('created_at', 'desc')->paginate(15);

        // Statistics
        $stats = [
            'total' => Invoice::count(),
            'paid' => Invoice::where('status', 'paid')->count(),
            'pending' => Invoice::where('status', 'pending')->count(),
            'refunded' => Invoice::where('status', 'refunded')->count(),
            'total_revenue' => Invoice::where('status', 'paid')->sum('total_price'),
            'refunded_amount' => Invoice::where('status', 'refunded')->sum('total_price')
        ];

        return view('livewire.admin.manage-payments', [
            'invoices' => $invoices,
            'stats' => $stats
        ])->layout('components.layouts.dashboard-admin');
    }
}
