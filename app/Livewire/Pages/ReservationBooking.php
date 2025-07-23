<?php

namespace App\Livewire\Pages;

use App\Models\UserAttraction;
use App\Models\UserRestaurant;
use App\Models\Attraction;
use App\Models\Restaurant;
use App\Models\Ticket;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationBooking extends Component
{
    public $type; // 'attraction' or 'restaurant'
    public $location_id;
    public $location;
    public $user_tickets = [];
    public $selected_ticket_id;
    public $queue_quantity = 1;
    public $total_available_tickets = 0;
    
    public function mount($restaurant = null, $attraction = null)
    {
        // Determine type and location_id based on route parameters
        if ($restaurant) {
            $this->type = 'restaurant';
            $this->location_id = $restaurant;
        } elseif ($attraction) {
            $this->type = 'attraction';
            $this->location_id = $attraction;
        } else {
            abort(404, 'Parameter lokasi tidak valid.');
        }
        
        // Load location data
        if ($this->type === 'attraction') {
            $this->location = Attraction::find($this->location_id);
        } else {
            $this->location = Restaurant::find($this->location_id);
        }
        
        if (!$this->location) {
            abort(404, 'Lokasi tidak ditemukan.');
        }
        
        $this->loadUserTickets();
        
        // Check if user can make new reservations
        $this->validateCanMakeReservation();
    }
    
    private function validateCanMakeReservation()
    {
        if (!Auth::check()) {
            return;
        }
        
        // Get total tickets user owns
        $totalTickets = collect($this->user_tickets)->sum('total_quantity');
        
        if ($totalTickets == 0) {
            session()->flash('error', 'Anda belum memiliki tiket. Silakan beli tiket terlebih dahulu.');
            return redirect('/tiket-ecommerce');
        }
        
        // Count active queues (waiting or called status)
        $activeQueues = UserAttraction::where('user_id', Auth::id())
            ->whereIn('status', ['waiting', 'called'])
            ->count() +
            UserRestaurant::where('user_id', Auth::id())
            ->whereIn('status', ['waiting', 'called'])
            ->count();
            
        if ($activeQueues >= $totalTickets) {
            session()->flash('error', 'Semua tiket Anda sedang digunakan untuk mengantri. Silakan tunggu hingga antrian selesai.');
            return redirect('/');
        }
    }
    
    public function loadUserTickets()
    {
        if (!Auth::check()) {
            return;
        }
        
        // Get user's valid tickets with quantities
        $invoices = Invoice::with(['tickets' => function($query) {
                $query->withPivot('quantity', 'used_quantity');
            }])
            ->where('user_id', Auth::id())
            ->where('status', 'paid')
            ->get();
        
        $this->user_tickets = $invoices
            ->flatMap(function ($invoice) {
                return $invoice->tickets->map(function ($ticket) use ($invoice) {
                    // For queue reservations, all tickets are always available (universal tickets)
                    // used_quantity is only for tracking park entry, not queue usage
                    
                    return [
                        'id' => $ticket->id,
                        'invoice_id' => $invoice->id,
                        'ticket_name' => $ticket->name,
                        'purchased_date' => $invoice->created_at,
                        'total_quantity' => $ticket->pivot->quantity,
                        'used_quantity' => $ticket->pivot->used_quantity, // For park entry only
                        'available_quantity' => $ticket->pivot->quantity, // Always full quantity for queuing
                        'can_reserve' => true, // Always can reserve as long as ticket exists
                    ];
                });
            })
            ->toArray();
            
        // Calculate total available tickets across all user tickets
        $this->total_available_tickets = collect($this->user_tickets)
            ->sum('available_quantity'); // Now this will always be the full quantity
    }
    
    public function updatedSelectedTicketId()
    {
        if ($this->selected_ticket_id) {
            // Keep current quantity if valid, otherwise reset to 1
            if ($this->queue_quantity > $this->total_available_tickets || $this->queue_quantity < 1) {
                $this->queue_quantity = 1;
            }
        }
    }
    
    public function makeReservation()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Silakan login terlebih dahulu');
            return;
        }
        
        if (!$this->selected_ticket_id || $this->queue_quantity < 1) {
            session()->flash('error', 'Mohon pilih tiket dan jumlah antrian yang valid');
            return;
        }
        
        // Get the selected ticket data from user_tickets array
        $selected_ticket = collect($this->user_tickets)->firstWhere('id', $this->selected_ticket_id);
        
        if (!$selected_ticket) {
            session()->flash('error', 'Tiket tidak valid');
            return;
        }
        
        // Validate quantity against total available tickets
        if ($this->queue_quantity > $this->total_available_tickets) {
            session()->flash('error', 'Jumlah antrian melebihi total tiket yang tersedia');
            return;
        }
        
        $today = Carbon::today()->format('Y-m-d');
        $now = Carbon::now()->format('H:i');
        $queue_numbers = [];
        
        // Prepare ticket usage tracking - use tickets in order of selection priority
        $available_tickets = collect($this->user_tickets)
            ->filter(function($ticket) {
                return $ticket['available_quantity'] > 0;
            })
            ->sortBy(function($ticket) use ($selected_ticket) {
                // Prioritize the selected ticket first, then others
                return $ticket['id'] == $this->selected_ticket_id ? 0 : 1;
            })
            ->values()
            ->toArray(); // Convert to array so we can modify elements
            
        $remaining_quantity = $this->queue_quantity;
        $used_invoices = [];
        
        // Create multiple queue entries based on quantity
        for ($i = 0; $i < $this->queue_quantity; $i++) {
            try {
                // Find the next available ticket to use
                $current_ticket = null;
                foreach ($available_tickets as $index => $ticket) {
                    if ($ticket['available_quantity'] > 0) {
                        $current_ticket = $ticket;
                        // Reduce available quantity for this ticket
                        $available_tickets[$index]['available_quantity']--;
                        break;
                    }
                }
                
                if (!$current_ticket) {
                    session()->flash('error', 'Tidak ada lagi tiket yang tersedia');
                    return;
                }
                
                // Track which invoice is being used
                $used_invoices[] = $current_ticket['invoice_id'];
                // Get next queue position
                if ($this->type === 'attraction') {
                    $next_position = UserAttraction::where('attraction_id', $this->location_id)
                        ->where('reservation_date', $today)
                        ->max('queue_position') ?? 0;
                    $next_position += 1;
                        
                    // Create reservation
                    $reservation = UserAttraction::create([
                        'user_id' => Auth::id(),
                        'attraction_id' => $this->location_id,
                        'invoice_id' => $current_ticket['invoice_id'],
                        'slot_number' => $next_position,
                        'queue_position' => $next_position,
                        'reservation_date' => $today,
                        'reservation_time' => $now,
                        'status' => 'waiting',
                    ]);
                    
                } else {
                    $next_position = UserRestaurant::where('restaurant_id', $this->location_id)
                        ->where('reservation_date', $today)
                        ->max('queue_position') ?? 0;
                    $next_position += 1;
                        
                    // Create reservation
                    $reservation = UserRestaurant::create([
                        'user_id' => Auth::id(),
                        'restaurant_id' => $this->location_id,
                        'invoice_id' => $current_ticket['invoice_id'],
                        'slot_number' => $next_position,
                        'queue_position' => $next_position,
                        'reservation_date' => $today,
                        'reservation_time' => $now,
                        'status' => 'waiting',
                    ]);
                }
                
                $queue_numbers[] = $next_position;
                
                // Note: We don't update used_quantity here because queue reservations 
                // don't consume tickets - used_quantity is only for park entry tracking
                    
            } catch (\Exception $e) {
                session()->flash('error', 'Gagal membuat antrian: ' . $e->getMessage());
                return;
            }
        }
        
        // Refresh user tickets to show updated available quantities
        $this->loadUserTickets();
        
        session()->flash('success', 'Berhasil membuat ' . $this->queue_quantity . ' antrian! Nomor antrian Anda: #' . implode(', #', $queue_numbers));
        
        // Redirect to queue waiting page - use the primary selected ticket's invoice
        return $this->redirect(route('queue.waiting', ['invoiceId' => $selected_ticket['invoice_id']]), navigate: true);
    }
    
    public function render()
    {
        return view('livewire.pages.reservation-booking')->layout('components.layouts.app');
    }
}
