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

class ReservationBooking extends Component
{
    public $type; // 'attraction' or 'restaurant'
    public $location_id;
    public $location;
    public $user_tickets = [];
    public $selected_ticket_id;
    public $queue_quantity = 1;
    
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
    }
    
    public function loadUserTickets()
    {
        if (!Auth::check()) return;
        
        // Get user's valid tickets with quantities
        $this->user_tickets = Invoice::with(['tickets' => function($query) {
                $query->withPivot('quantity', 'used_quantity');
            }])
            ->where('user_id', Auth::id())
            ->where('status', 'paid')
            ->get()
            ->flatMap(function ($invoice) {
                return $invoice->tickets->map(function ($ticket) use ($invoice) {
                    $availableQuantity = $ticket->pivot->quantity - $ticket->pivot->used_quantity;
                    return [
                        'id' => $ticket->id,
                        'invoice_id' => $invoice->id,
                        'ticket_name' => $ticket->name,
                        'purchased_date' => $invoice->created_at,
                        'total_quantity' => $ticket->pivot->quantity,
                        'used_quantity' => $ticket->pivot->used_quantity,
                        'available_quantity' => $availableQuantity,
                        'can_reserve' => $availableQuantity > 0,
                    ];
                });
            })
            ->filter(function($ticket) {
                return $ticket['can_reserve'];
            })
            ->toArray();
    }
    
    public function updatedSelectedTicketId()
    {
        if ($this->selected_ticket_id) {
            $selected_ticket = collect($this->user_tickets)->firstWhere('id', $this->selected_ticket_id);
            if ($selected_ticket) {
                $this->queue_quantity = min(1, $selected_ticket['available_quantity']);
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
        
        // Validate quantity
        if ($this->queue_quantity > $selected_ticket['available_quantity']) {
            session()->flash('error', 'Jumlah antrian melebihi tiket yang tersedia');
            return;
        }
        
        $today = Carbon::today()->format('Y-m-d');
        $now = Carbon::now()->format('H:i');
        $queue_numbers = [];
        
        // Create multiple queue entries based on quantity
        for ($i = 0; $i < $this->queue_quantity; $i++) {
            // Get next queue position
            if ($this->type === 'attraction') {
                $next_position = UserAttraction::where('attraction_id', $this->location_id)
                    ->where('reservation_date', $today)
                    ->max('queue_position') + 1;
                    
                // Create reservation
                UserAttraction::create([
                    'user_id' => Auth::id(),
                    'attraction_id' => $this->location_id,
                    'invoice_id' => $selected_ticket['invoice_id'],
                    'slot_number' => $next_position,
                    'queue_position' => $next_position,
                    'reservation_date' => $today,
                    'reservation_time' => $now,
                    'status' => 'waiting',
                ]);
            } else {
                $next_position = UserRestaurant::where('restaurant_id', $this->location_id)
                    ->where('reservation_date', $today)
                    ->max('queue_position') + 1;
                    
                // Create reservation
                UserRestaurant::create([
                    'user_id' => Auth::id(),
                    'restaurant_id' => $this->location_id,
                    'invoice_id' => $selected_ticket['invoice_id'],
                    'slot_number' => $next_position,
                    'queue_position' => $next_position,
                    'reservation_date' => $today,
                    'reservation_time' => $now,
                    'status' => 'waiting',
                ]);
            }
            
            $queue_numbers[] = $next_position;
        }
        
        session()->flash('success', 'Berhasil membuat ' . $this->queue_quantity . ' antrian! Nomor antrian Anda: #' . implode(', #', $queue_numbers));
        
        // Reload data
        $this->loadUserTickets();
        
        // Reset form
        $this->reset(['selected_ticket_id', 'queue_quantity']);
        $this->queue_quantity = 1;
    }
    
    public function render()
    {
        return view('livewire.pages.reservation-booking')->layout('components.layouts.app');
    }
}
