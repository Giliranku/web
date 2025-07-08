<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Ticket;
use App\Models\User;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ticket1 = Ticket::create([
            'name' => 'Wahana Kura Kura',
            'price' => 100000,
            'price_before' => 120000,
            'logo' => 'logo-kura.png',
            'terms_and_conditions' => 'Satu tiket hanya untuk satu orang.',
        ]);

        $ticket2 = Ticket::create([
            'name' => 'Wahana Ayam Ayam',
            'price' => 100000,
            'price_before' => 120000,
            'logo' => 'logo-kura.png', // tambahkan ini
            'terms_and_conditions' => 'Satu tiket hanya untuk satu orang.',
        ]);
        $user = User::first();
        $invoice = Invoice::create([
            'total_price' => $ticket1->price + ($ticket2->price * 2),
            'payment_method' => 'Qris',

            'user_id' => $user->id,
        ]);

        // Hubungkan ke tiket
        $invoice->tickets()->attach([
            $ticket1->id,
            $ticket2->id,
        ]);
    }
}
