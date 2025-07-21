<?php

namespace Database\Seeders;

use App\Models\UserRestaurant;
use App\Models\UserAttraction;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Attraction;
use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QueueSeeder extends Seeder
{
    public function run(): void
    {
        // Get some test data
        $users = User::limit(5)->get();
        $restaurants = Restaurant::limit(2)->get();
        $attractions = Attraction::limit(2)->get();
        $invoices = Invoice::limit(5)->get();

        // Create some restaurant queues for today
        if ($restaurants->count() > 0 && $users->count() > 0) {
            $restaurant = $restaurants->first();
            
            for ($i = 1; $i <= 3; $i++) {
                UserRestaurant::create([
                    'user_id' => $users->random()->id,
                    'restaurant_id' => $restaurant->id,
                    'invoice_id' => $invoices->random()->id ?? null,
                    'slot_number' => $i,
                    'queue_position' => $i,
                    'reservation_date' => Carbon::today(),
                    'reservation_time' => sprintf('%02d:00', 9 + $i),
                    'status' => $i == 1 ? 'called' : 'waiting',
                ]);
            }
        }

        // Create some attraction queues for today
        if ($attractions->count() > 0 && $users->count() > 0) {
            $attraction = $attractions->first();
            
            for ($i = 1; $i <= 4; $i++) {
                UserAttraction::create([
                    'user_id' => $users->random()->id,
                    'attraction_id' => $attraction->id,
                    'invoice_id' => $invoices->random()->id ?? null,
                    'slot_number' => $i,
                    'queue_position' => $i,
                    'reservation_date' => Carbon::today(),
                    'reservation_time' => sprintf('%02d:00', 10 + $i),
                    'status' => $i == 1 ? 'called' : ($i == 2 ? 'served' : 'waiting'),
                ]);
            }
        }

        // Create some queues for tomorrow
        if ($restaurants->count() > 1 && $users->count() > 0) {
            $restaurant = $restaurants->skip(1)->first();
            
            UserRestaurant::create([
                'user_id' => $users->random()->id,
                'restaurant_id' => $restaurant->id,
                'invoice_id' => $invoices->random()->id ?? null,
                'slot_number' => 1,
                'queue_position' => 1,
                'reservation_date' => Carbon::tomorrow(),
                'reservation_time' => '12:00',
                'status' => 'waiting',
            ]);
        }
    }
}
