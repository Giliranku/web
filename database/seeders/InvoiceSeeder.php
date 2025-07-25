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
            $selectedTickets = $tickets->random(rand(1, 3)); // 1-3 tickets per invoice
            $total = $selectedTickets->sum('price');

            $invoice = Invoice::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'payment_method' => collect(['Qris', 'Bank Transfer', 'Credit Card'])->random(),
                'status' => collect(['paid', 'pending', 'paid', 'paid'])->random(), // Mostly paid
                'created_at' => Carbon::now()->subDays(rand(1, 30)), // Random days ago
            ]);

            // Attach tickets to invoice with random quantities
            foreach ($selectedTickets as $ticket) {
                $quantity = rand(1, 4); // 1-4 tickets per type
                $invoice->tickets()->attach($ticket->id, [
                    'quantity' => $quantity,
                    'used_quantity' => $invoice->status === 'paid' ? rand(0, $quantity) : 0, // Some used if paid
                ]);
            }
        }

        $this->command->info('Created ' . $users->count() . ' invoices with realistic ticket quantities');
    }
}
