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
        //
        $user = User::first();
        $tickets = Ticket::take(2)->get(); // ambil 2 tiket pertama (atau random)

        if (!$user || $tickets->isEmpty()) {
            $this->command->warn('User atau Ticket belum ada. Jalankan UserSeeder & TicketSeeder dulu.');
            return;
        }

        // 2. Hitung total harga (misal tanpa quantity khusus)
        $total = $tickets->sum('price');

        // 3. Create invoice
        $invoice = Invoice::create([
            'user_id' => $user->id,
            'total_price' => $total,
            'payment_method' => 'Qris',
            'status' => 'paid',
            'created_at' => Carbon::now()->subDays(5),
        ]);

        // 4. Attach tiket ke invoice lewat pivot invoice_tickets
        //    (Invoice model harus punya belongsToMany Ticket)
        $invoice->tickets()->attach(
            $tickets->pluck('id')->toArray()
        );
    }
}
