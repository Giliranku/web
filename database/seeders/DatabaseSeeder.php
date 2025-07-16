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
            // NewsSeeder::class,
            RestaurantSeeder::class,
            AttractionSeeder::class,
            RestaurantAttractionSeeder::class,
            UserSeeder::class,
            // TicketSeeder::class,
            InvoiceSeeder::class,
        ]);

        // Example: Create 3 users and attach them to restaurant 1
        $users = User::factory()->count(3)->create();
        $restaurant = Restaurant::find(1);
        foreach ($users as $user) {
            $user->restaurants()->attach($restaurant->id, [
                'created_at' => now()->subMinutes(rand(1, 60)),
            ]);
        }

    }
}
