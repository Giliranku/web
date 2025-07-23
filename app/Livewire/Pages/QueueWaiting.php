<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Invoice;
use App\Models\InvoiceTicket;
use App\Models\UserAttraction;
use App\Models\UserRestaurant;
use App\Models\Attraction;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

#[Layout('components.layouts.full-screen')]
class QueueWaiting extends Component
{
    public $invoiceId;
    public $invoice;
    public $queuePosition;
    public $estimatedWaitTime;
    public $currentServingNumber;
    public $isServingNow = false;
    public $ticketDetails = [];

    public function mount($invoiceId)
    {
        $this->invoiceId = $invoiceId;
        $this->loadQueueData();
    }

    public function loadQueueData()
    {
        // Load invoice untuk verifikasi kepemilikan tiket
        $this->invoice = Invoice::with(['tickets' => function($query) {
                $query->withPivot('quantity', 'used_quantity');
            }])
            ->where('id', $this->invoiceId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Cari semua antrian user berdasarkan invoice_id (aktif dan selesai)
        $userAttractions = UserAttraction::with('attraction')
            ->where('user_id', Auth::id())
            ->where('invoice_id', $this->invoiceId)
            ->whereIn('status', ['waiting', 'called', 'served'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $userRestaurants = UserRestaurant::with('restaurant')
            ->where('user_id', Auth::id())
            ->where('invoice_id', $this->invoiceId)
            ->whereIn('status', ['waiting', 'called', 'served'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Gabungkan semua antrian aktif
        $allQueues = collect();
        
        foreach ($userAttractions as $queue) {
            $actualPosition = $this->calculateActualQueuePosition($queue, 'attraction');
            $allQueues->push([
                'type' => 'attraction',
                'venue_type' => 'attraction',
                'venue_name' => $queue->attraction->name ?? 'Unknown Attraction',
                'reservation_date' => $queue->reservation_date,
                'reservation_time' => $queue->reservation_time,
                'queue_position' => $queue->queue_position,
                'slot_number' => $queue->slot_number,
                'status' => $queue->status,
                'venue_id' => $queue->attraction_id,
                'actual_position' => $actualPosition,
                'estimated_wait' => $this->calculateEstimatedWait($actualPosition),
                'created_at' => $queue->created_at,
                'id' => $queue->id
            ]);
        }
        
        foreach ($userRestaurants as $queue) {
            $actualPosition = $this->calculateActualQueuePosition($queue, 'restaurant');
            $allQueues->push([
                'type' => 'restaurant',
                'venue_type' => 'restaurant',
                'venue_name' => $queue->restaurant->name ?? 'Unknown Restaurant',
                'reservation_date' => $queue->reservation_date,
                'reservation_time' => $queue->reservation_time,
                'queue_position' => $queue->queue_position,
                'slot_number' => $queue->slot_number,
                'status' => $queue->status,
                'venue_id' => $queue->restaurant_id,
                'actual_position' => $actualPosition,
                'estimated_wait' => $this->calculateEstimatedWait($actualPosition),
                'created_at' => $queue->created_at,
                'id' => $queue->id
            ]);
        }

        $this->ticketDetails = $allQueues->toArray();

        // Set queue position berdasarkan antrian dengan posisi terdepan
        if ($allQueues->isNotEmpty()) {
            $this->queuePosition = $allQueues->min('actual_position');
        } else {
            $this->queuePosition = 0;
        }

        // Set status dan estimasi waktu
        $this->isServingNow = $this->queuePosition <= 1;
        $this->estimatedWaitTime = $this->calculateEstimatedWait($this->queuePosition);
        $this->currentServingNumber = $this->getCurrentServingNumber();
    }

    private function calculateActualQueuePosition($reservation, $type)
    {
        $today = Carbon::today()->format('Y-m-d');
        
        if ($type === 'attraction') {
            // Hitung berapa orang yang masih mengantri di wahana yang sama sebelum user ini
            $queueAhead = UserAttraction::where('attraction_id', $reservation->attraction_id)
                ->where('reservation_date', $today)
                ->where('status', 'waiting')
                ->where('queue_position', '<', $reservation->queue_position)
                ->count();
                
            return $queueAhead + 1; // +1 untuk posisi user sendiri
            
        } else {
            // Hitung berapa orang yang masih mengantri di restaurant yang sama sebelum user ini  
            $queueAhead = UserRestaurant::where('restaurant_id', $reservation->restaurant_id)
                ->where('reservation_date', $today)
                ->where('status', 'waiting')
                ->where('queue_position', '<', $reservation->queue_position)
                ->count();
                
            return $queueAhead + 1; // +1 untuk posisi user sendiri
        }
    }

    private function calculateEstimatedWait($position)
    {
        if ($position <= 1) return 0;
        
        // Asumsi rata-rata 5 menit per antrian
        return ($position - 1) * 5;
    }

    private function getCurrentServingNumber()
    {
        $today = Carbon::today()->format('Y-m-d');
        
        // Jika ada multiple antrian, ambil yang posisinya paling depan
        if (!empty($this->ticketDetails)) {
            $minServing = null;
            
            foreach ($this->ticketDetails as $queue) {
                if ($queue['type'] === 'attraction') {
                    $currentServing = UserAttraction::where('attraction_id', $queue['venue_id'])
                        ->where('reservation_date', $today)
                        ->where('status', 'serving')
                        ->min('queue_position');
                } else {
                    $currentServing = UserRestaurant::where('restaurant_id', $queue['venue_id'])
                        ->where('reservation_date', $today)
                        ->where('status', 'serving')
                        ->min('queue_position');
                }
                
                if ($currentServing && ($minServing === null || $currentServing < $minServing)) {
                    $minServing = $currentServing;
                }
            }
            
            return $minServing ?? 1;
        }
        
        return 1;
    }

    public function cancelQueue()
    {
        $user = Auth::user();
        if (!$user) {
            session()->flash('error', 'Anda harus login terlebih dahulu.');
            return redirect('/login');
        }

        if (!empty($this->queueDetails)) {
            // Cancel active attraction queue
            UserAttraction::where('user_id', $user->id)
                ->where('status', 'waiting')
                ->update(['status' => 'cancelled']);

            // Cancel active restaurant queue  
            UserRestaurant::where('user_id', $user->id)
                ->where('status', 'waiting')
                ->update(['status' => 'cancelled']);

            // Re-calculate queue positions for other users
            $this->recalculateQueuePositions();

            session()->flash('success', 'Antrian berhasil dibatalkan.');
            return redirect('/');
        }
    }

    private function recalculateQueuePositions()
    {
        // Recalculate attraction queues
        $attractions = Attraction::all();
        foreach ($attractions as $attraction) {
            $waitingUsers = UserAttraction::where('attraction_id', $attraction->id)
                ->where('status', 'waiting')
                ->orderBy('created_at')
                ->get();
            
            foreach ($waitingUsers as $index => $userAttraction) {
                $userAttraction->update(['queue_position' => $index + 1]);
            }
        }

        // Recalculate restaurant queues
        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant) {
            $waitingUsers = UserRestaurant::where('restaurant_id', $restaurant->id)
                ->where('status', 'waiting')
                ->orderBy('created_at')
                ->get();
            
            foreach ($waitingUsers as $index => $userRestaurant) {
                $userRestaurant->update(['queue_position' => $index + 1]);
            }
        }
    }

    public function refreshQueue()
    {
        $this->loadQueueData();
        $this->dispatch('queue-updated');
    }

    public function createNewQueue()
    {
        // Redirect to booking page with the same invoice
        return $this->redirect(route('reservation.booking'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.queue-waiting');
    }
}
