<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tickets = [
            [
                'name' => 'Konser Musim Panas',
                'logo' => 'summer_concert.png',
                'price' => 150_000,
                'price_before' => 175_000,
                'terms_and_conditions' => 'Tiket tidak dapat diuangkan kembali.',
            ],
            [
                'name' => 'Pentas Teater Klasik',
                'logo' => 'classical_play.png',
                'price' => 100_000,
                'price_before' => 120_000,
                'terms_and_conditions' => 'Tiket berlaku satu kali masuk.',
            ],

        ];

        foreach ($tickets as $data) {
            Ticket::create($data);
        }
    }
}
