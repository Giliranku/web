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
        // Get test data
        $users = User::limit(20)->get(); // Ambil lebih banyak users
        $restaurants = Restaurant::with('staff')->get();
        $attractions = Attraction::with('staff')->get();
        $invoices = Invoice::limit(10)->get();

        if ($users->count() < 10) {
            $this->command->warn('Not enough users for realistic queue simulation. Please run UserSeeder first.');
            return;
        }

        // Create restaurant queues with grup permainan logic
        foreach ($restaurants->take(3) as $restaurant) {
            $this->createRestaurantQueues($restaurant, $users, $invoices);
        }

        // Create attraction queues with grup permainan logic  
        foreach ($attractions->take(3) as $attraction) {
            $this->createAttractionQueues($attraction, $users, $invoices);
        }

        $this->command->info('Queue seeder completed with grup permainan logic!');
    }

    private function createRestaurantQueues($restaurant, $users, $invoices)
    {
        $playersPerRound = $restaurant->players_per_round ?? 6;
        $estimatedTimePerRound = $restaurant->estimated_time_per_round ?? 30;
        
        // Create 3 grup permainan (18 people total if 6 per grup)
        $totalQueues = $playersPerRound * 3;
        $queuePosition = 1;
        
        for ($grup = 1; $grup <= 3; $grup++) {
            $statusForGrup = match($grup) {
                1 => 'served', // Grup 1 sudah selesai
                2 => 'called', // Grup 2 sedang dipanggil
                3 => 'waiting' // Grup 3 masih menunggu
            };
            
            // Create queue for each player in this grup
            for ($player = 1; $player <= $playersPerRound; $player++) {
                $user = $users->random();
                $reservationTime = Carbon::today()
                    ->addHours(10) // Mulai jam 10 pagi
                    ->addMinutes(($grup - 1) * $estimatedTimePerRound); // Tambah waktu per grup
                
                UserRestaurant::create([
                    'user_id' => $user->id,
                    'restaurant_id' => $restaurant->id,
                    'invoice_id' => $invoices->random()->id ?? null,
                    'slot_number' => $queuePosition,
                    'queue_position' => $queuePosition,
                    'reservation_date' => Carbon::today(),
                    'reservation_time' => $reservationTime->format('H:i'),
                    'status' => $statusForGrup,
                    'created_at' => Carbon::now()->subMinutes(rand(30, 180)),
                ]);
                
                $queuePosition++;
            }
        }
        
        // Add some individual stragglers waiting
        for ($i = 1; $i <= 3; $i++) {
            $user = $users->random();
            $reservationTime = Carbon::today()
                ->addHours(10)
                ->addMinutes(3 * $estimatedTimePerRound + ($i * 5)); // Setelah 3 grup
            
            UserRestaurant::create([
                'user_id' => $user->id,
                'restaurant_id' => $restaurant->id,
                'invoice_id' => $invoices->random()->id ?? null,
                'slot_number' => $queuePosition,
                'queue_position' => $queuePosition,
                'reservation_date' => Carbon::today(),
                'reservation_time' => $reservationTime->format('H:i'),
                'status' => 'waiting',
                'created_at' => Carbon::now()->subMinutes(rand(10, 60)),
            ]);
            
            $queuePosition++;
        }
        
        $this->command->info("Created queue for {$restaurant->name}: 3 grup permainan + 3 individual waiting");
    }

    private function createAttractionQueues($attraction, $users, $invoices)
    {
        $playersPerRound = $attraction->players_per_round ?? 4;
        $estimatedTimePerRound = $attraction->estimated_time_per_round ?? 15;
        
        // Create 4 grup permainan untuk variasi
        $queuePosition = 1;
        
        for ($grup = 1; $grup <= 4; $grup++) {
            $statusForGrup = match($grup) {
                1 => 'served',   // Grup 1 sudah selesai
                2 => 'served',   // Grup 2 juga sudah selesai  
                3 => 'called',   // Grup 3 sedang bermain
                4 => 'waiting'   // Grup 4 menunggu
            };
            
            // Create queue for each player in this grup
            for ($player = 1; $player <= $playersPerRound; $player++) {
                $user = $users->random();
                $reservationTime = Carbon::today()
                    ->addHours(14) // Mulai jam 2 siang
                    ->addMinutes(($grup - 1) * $estimatedTimePerRound);
                
                UserAttraction::create([
                    'user_id' => $user->id,
                    'attraction_id' => $attraction->id,
                    'invoice_id' => $invoices->random()->id ?? null,
                    'slot_number' => $queuePosition,
                    'queue_position' => $queuePosition,
                    'reservation_date' => Carbon::today(),
                    'reservation_time' => $reservationTime->format('H:i'),
                    'status' => $statusForGrup,
                    'created_at' => Carbon::now()->subMinutes(rand(60, 240)),
                ]);
                
                $queuePosition++;
            }
        }
        
        // Add more individual waiting queues untuk simulasi antrian panjang
        for ($i = 1; $i <= 6; $i++) {
            $user = $users->random();
            $reservationTime = Carbon::today()
                ->addHours(14)
                ->addMinutes(4 * $estimatedTimePerRound + ($i * 3));
            
            UserAttraction::create([
                'user_id' => $user->id,
                'attraction_id' => $attraction->id,
                'invoice_id' => $invoices->random()->id ?? null,
                'slot_number' => $queuePosition,
                'queue_position' => $queuePosition,
                'reservation_date' => Carbon::today(),
                'reservation_time' => $reservationTime->format('H:i'),
                'status' => 'waiting',
                'created_at' => Carbon::now()->subMinutes(rand(30, 120)),
            ]);
            
            $queuePosition++;
        }
        
        $this->command->info("Created queue for {$attraction->name}: 4 grup permainan + 6 individual waiting");
    }
}

