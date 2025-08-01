<?php

namespace App\Livewire\Partial;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\UserAttraction;
use App\Models\UserRestaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QueueFloatingWidget extends Component
{
    public $activeQueues = [];
    public $totalActiveQueues = 0;
    public $isOpen = false;
    public $hasTickets = false;

    public function mount()
    {
        $this->loadQueueData();
    }

    #[On('queueUpdated')]
    #[On('ticketPurchased')]
    #[On('cartUpdated')]
    public function refreshQueues()
    {
        $this->loadQueueData();
    }

    public function loadQueueData()
    {
        if (!Auth::check()) {
            $this->activeQueues = [];
            $this->totalActiveQueues = 0;
            $this->hasTickets = false;
            return;
        }

        $userId = Auth::id();
        
        // Debug: Check what tickets user has
        $tickets = DB::table('invoice_tickets')
            ->join('invoices', 'invoice_tickets.invoice_id', '=', 'invoices.id')
            ->join('tickets', 'invoice_tickets.ticket_id', '=', 'tickets.id')
            ->where('invoices.user_id', $userId)
            ->select('tickets.name', 'invoice_tickets.quantity', 'invoice_tickets.used_quantity')
            ->get();
        
        // Cek apakah user memiliki tiket yang valid
        $this->hasTickets = DB::table('invoice_tickets')
            ->join('invoices', 'invoice_tickets.invoice_id', '=', 'invoices.id')
            ->where('invoices.user_id', $userId)
            ->whereRaw('invoice_tickets.used_quantity < invoice_tickets.quantity')
            ->exists();

        // Jika tidak punya tiket, tidak perlu load queue data
        if (!$this->hasTickets) {
            $this->activeQueues = [];
            $this->totalActiveQueues = 0;
            return;
        }
        
        // Ambil antrian wahana yang aktif
        $attractionQueues = UserAttraction::with(['attraction'])
            ->where('user_id', $userId)
            ->whereIn('status', ['waiting', 'called'])
            ->orderBy('queue_position')
            ->get()
            ->map(function ($queue) {
                return [
                    'id' => $queue->id,
                    'type' => 'attraction',
                    'name' => $queue->attraction->name,
                    'status' => $queue->status,
                    'queue_position' => $queue->queue_position,
                    'estimated_time' => $this->calculateEstimatedTime($queue),
                    'status_text' => $this->getStatusText($queue->status),
                    'status_class' => $this->getStatusClass($queue->status)
                ];
            });

        // Ambil antrian restoran yang aktif
        $restaurantQueues = UserRestaurant::with(['restaurant'])
            ->where('user_id', $userId)
            ->whereIn('status', ['waiting', 'called'])
            ->orderBy('queue_position')
            ->get()
            ->map(function ($queue) {
                return [
                    'id' => $queue->id,
                    'type' => 'restaurant',
                    'name' => $queue->restaurant->name,
                    'status' => $queue->status,
                    'queue_position' => $queue->queue_position,
                    'estimated_time' => $this->calculateEstimatedTime($queue),
                    'status_text' => $this->getStatusText($queue->status),
                    'status_class' => $this->getStatusClass($queue->status)
                ];
            });

        // Gabungkan dan urutkan berdasarkan status (called pertama, lalu waiting)
        $this->activeQueues = $attractionQueues->concat($restaurantQueues)
            ->sortBy(function ($queue) {
                return $queue['status'] === 'called' ? 0 : 1;
            })
            ->values()
            ->toArray();

        $this->totalActiveQueues = count($this->activeQueues);
    }

    private function calculateEstimatedTime($queue)
    {
        if ($queue->status === 'called') {
            return '0 menit';
        }

        $queueAhead = $queue->queue_position - 1;
        if ($queueAhead <= 0) {
            return '< 5 menit';
        }

        $timePerPerson = $queue instanceof UserAttraction 
            ? $queue->attraction->time_estimation ?? 10 
            : $queue->restaurant->time_estimation ?? 15;

        $estimatedMinutes = $queueAhead * ($timePerPerson / 60); // Convert to minutes
        
        if ($estimatedMinutes < 1) {
            return '< 1 menit';
        } elseif ($estimatedMinutes < 60) {
            return ceil($estimatedMinutes) . ' menit';
        } else {
            $hours = floor($estimatedMinutes / 60);
            $minutes = ceil($estimatedMinutes % 60);
            return $hours . 'j ' . ($minutes > 0 ? $minutes . 'm' : '');
        }
    }

    private function getStatusText($status)
    {
        return match($status) {
            'waiting' => 'Menunggu',
            'called' => 'Dipanggil',
            default => 'Tidak dikenal'
        };
    }

    private function getStatusClass($status)
    {
        return match($status) {
            'waiting' => 'text-warning',
            'called' => 'text-success fw-bold',
            default => 'text-muted'
        };
    }

    public function cancelQueue($queueId, $type)
    {
        if ($type === 'attraction') {
            $queue = UserAttraction::find($queueId);
        } else {
            $queue = UserRestaurant::find($queueId);
        }

        if ($queue && $queue->user_id === Auth::id()) {
            $queue->update(['status' => 'cancelled']);
            $this->loadQueueData();
            $this->dispatch('queueCancelled');
            
            session()->flash('message', 'Antrian berhasil dibatalkan.');
        }
    }

    public function render()
    {
        return view('livewire.partial.queue-floating-widget');
    }
}
