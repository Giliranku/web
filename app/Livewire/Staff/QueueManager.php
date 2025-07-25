<?php

namespace App\Livewire\Staff;

use App\Models\UserAttraction;
use App\Models\UserRestaurant;
use App\Models\Attraction;
use App\Models\Restaurant;
use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;

class QueueManager extends Component
{
    public $type; // 'attraction' or 'restaurant'
    public $location_id;
    public $location;
    public $selected_date;
    public $queues = [];
    
    public function mount($restaurant = null, $attraction = null)
    {
        // Check staff authentication
        $staffId = session('staff_id');
        if (!$staffId) {
            return redirect('/admin/login');
        }

        // Determine type and location_id based on route parameters
        if ($restaurant) {
            $this->type = 'restaurant';
            $this->location_id = $restaurant;
        } elseif ($attraction) {
            $this->type = 'attraction';
            $this->location_id = $attraction;
        } else {
            session()->flash('error', 'Parameter lokasi tidak valid.');
            return redirect('/admin/login');
        }

        $this->selected_date = Carbon::today()->format('Y-m-d');
        
        // Load location data and verify staff has access
        if ($this->type === 'attraction') {
            $this->location = Attraction::where('id', $this->location_id)
                ->where('staff_id', $staffId)
                ->first();
        } else {
            $this->location = Restaurant::where('id', $this->location_id)
                ->where('staff_id', $staffId)
                ->first();
        }
        
        // If staff doesn't have access to this location, redirect
        if (!$this->location) {
            session()->flash('error', 'Anda tidak memiliki akses ke lokasi ini.');
            return redirect('/admin/login');
        }
        
        $this->loadQueues();
    }
    
    public function loadQueues()
    {
        if ($this->type === 'attraction') {
            $this->queues = UserAttraction::with('user')
                ->where('attraction_id', $this->location_id)
                ->forDate($this->selected_date)
                ->orderByQueue()
                ->get()
                ->toArray();
        } else {
            $this->queues = UserRestaurant::with('user')
                ->where('restaurant_id', $this->location_id)
                ->forDate($this->selected_date)
                ->orderByQueue()
                ->get()
                ->toArray();
        }
    }
    
    public function updatedSelectedDate()
    {
        $this->loadQueues();
    }
    
    public function updateQueueOrder($orderedIds)
    {
        // Disable drag & drop reordering for now
        // Staff can manage queue through call/serve/cancel buttons only
        $this->dispatch('queue-updated', ['message' => 'Pengurutan otomatis berdasarkan waktu antrian dibuat']);
    }
    
    public function callNext()
    {
        $nextQueue = collect($this->queues)->where('status', 'waiting')->first();
        
        if ($nextQueue) {
            if ($this->type === 'attraction') {
                UserAttraction::where('id', $nextQueue['id'])->update(['status' => 'called']);
            } else {
                UserRestaurant::where('id', $nextQueue['id'])->update(['status' => 'called']);
            }
            
            $this->loadQueues();
            $this->dispatch('queue-updated', ['message' => 'Antrian selanjutnya telah dipanggil']);
        }
    }

    // Method baru untuk memanggil multiple users sesuai players_per_round
    public function callNextBatch()
    {
        $playersPerRound = $this->location->players_per_round ?? 1;
        $waitingQueues = collect($this->queues)->where('status', 'waiting')->take($playersPerRound);
        
        if ($waitingQueues->isNotEmpty()) {
            $queueIds = $waitingQueues->pluck('id')->toArray();
            
            if ($this->type === 'attraction') {
                UserAttraction::whereIn('id', $queueIds)->update(['status' => 'called']);
            } else {
                UserRestaurant::whereIn('id', $queueIds)->update(['status' => 'called']);
            }
            
            $this->loadQueues();
            $calledCount = count($queueIds);
            $this->dispatch('queue-updated', ['message' => "{$calledCount} antrian telah dipanggil untuk grup permainan ini"]);
        }
    }

    // Method baru untuk menyelesaikan grup yang sedang dipanggil
    public function markServedBatch()
    {
        $calledQueues = collect($this->queues)->where('status', 'called');
        
        if ($calledQueues->isNotEmpty()) {
            $queueIds = $calledQueues->pluck('id')->toArray();
            
            if ($this->type === 'attraction') {
                UserAttraction::whereIn('id', $queueIds)->update(['status' => 'served']);
            } else {
                UserRestaurant::whereIn('id', $queueIds)->update(['status' => 'served']);
            }
            
            $this->loadQueues();
            $servedCount = count($queueIds);
            $this->dispatch('queue-updated', ['message' => "{$servedCount} antrian telah diselesaikan untuk grup permainan ini"]);
        }
    }
    
    public function cancelQueue($queueId)
    {
        if ($this->type === 'attraction') {
            UserAttraction::where('id', $queueId)->update(['status' => 'cancelled']);
        } else {
            UserRestaurant::where('id', $queueId)->update(['status' => 'cancelled']);
        }
        
        $this->loadQueues();
        $this->dispatch('queue-updated', ['message' => 'Antrian telah dibatalkan']);
    }
    
    public function render()
    {
        // Determine which layout to use based on type
        $layout = $this->type === 'restaurant' 
            ? 'components.layouts.dashboard-restaurant'
            : 'components.layouts.dashboard-attraction';
            
        return view('livewire.staff.queue-manager')->layout($layout);
    }
}
