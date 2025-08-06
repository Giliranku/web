<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::limit(10)->get();
        $tickets = Ticket::all();

        if ($users->isEmpty() || $tickets->isEmpty()) {
            $this->command->warn('User atau Ticket belum ada. Jalankan UserSeeder & TicketSeeder dulu.');
            return;
        }

        // Create multiple invoices for different users
        foreach ($users->take(8) as $index => $user) {
            // Safely get random tickets based on available count
            $maxTickets = min(3, $tickets->count()); // Don't exceed available tickets
            $ticketCount = rand(1, $maxTickets);
            $selectedTickets = $tickets->random($ticketCount);
            
            // Calculate total correctly for selected tickets with quantities
            $total = 0;
            $invoiceData = [];
            
            foreach ($selectedTickets as $ticket) {
                $quantity = rand(1, 4);
                $total += $ticket->price * $quantity;
                $invoiceData[] = [
                    'ticket' => $ticket,
                    'quantity' => $quantity
                ];
            }

            $invoice = Invoice::create([
                'user_id' => $user->id,
                'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad($index + 1, 6, '0', STR_PAD_LEFT),
                'total_price' => $total,
                'payment_method' => collect(['Qris', 'Bank Transfer', 'Credit Card'])->random(),
                'status' => collect(['paid', 'pending', 'paid', 'paid'])->random(), // Mostly paid
                'created_at' => Carbon::now()->subDays(rand(1, 30)), // Random days ago
            ]);

            // Attach tickets to invoice with predefined quantities
            foreach ($invoiceData as $item) {
                $invoice->tickets()->attach($item['ticket']->id, [
                    'quantity' => $item['quantity'],
                    'used_quantity' => $invoice->status === 'paid' ? rand(0, $item['quantity']) : 0, // Some used if paid
                ]);
            }
        }

        $this->command->info('Created ' . $users->count() . ' invoices with realistic ticket quantities');
    }
}
