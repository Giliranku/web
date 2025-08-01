<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Attraction;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            StaffSeeder::class,
            NewsSeeder::class,
            RestaurantSeeder::class,
            AttractionSeeder::class,
            UpdateQueueManagementFieldsSeeder::class, // Pastikan queue fields ada sebelum buat antrian
            UserSeeder::class,
            TicketSeeder::class,
            InvoiceSeeder::class,
            QueueSeeder::class, // Queue seeder terakhir karena butuh semua data lain
            UpdateInvoiceTicketsQuantitySeeder::class,
        ]);

    }
}
