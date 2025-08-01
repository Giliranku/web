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
        // Get test data - use 400 users for comprehensive coverage
        $users = User::limit(400)->get(); // Use 400 users (excluding test user for 401 total)
        $restaurants = Restaurant::with('staff')->get();
        $attractions = Attraction::with('staff')->get();
        $invoices = Invoice::limit(20)->get();

        if ($users->count() < 200) {
            $this->command->warn('Not enough users for comprehensive queue simulation. Please run UserSeeder first.');
            return;
        }

        // Track used users to avoid overlap
        $usedUserCount = 0;

        // Create comprehensive restaurant queues (minimum 30 per restaurant)
        foreach ($restaurants as $index => $restaurant) {
            $this->createAdvancedRestaurantQueues($restaurant, $users->skip($usedUserCount), $invoices, $index);
            // Restaurants use max 50 users each
            $usedUserCount += 50; 
        }

        // Create comprehensive attraction queues (minimum 30 per attraction)
        foreach ($attractions as $index => $attraction) {
            $this->createAdvancedAttractionQueues($attraction, $users->skip($usedUserCount), $invoices, $index);
            // Attractions vary by capacity - use actual needed amount
            $playersPerRound = $attraction->players_per_round ?? 4;
            $maxUsersForAttraction = max(40, $playersPerRound * 5); // More reasonable estimate
            $usedUserCount += $maxUsersForAttraction;
        }

        $this->command->info('Comprehensive queue seeder completed with realistic scenarios!');
    }

    private function createAdvancedRestaurantQueues($restaurant, $availableUsers, $invoices, $restaurantIndex)
    {
        $playersPerRound = $restaurant->players_per_round ?? 6;
        $estimatedTimePerRound = $restaurant->estimated_time_per_round ?? 30;
        
        // Create various queue scenarios based on documentation
        $scenarios = [
            // Scenario 1: Peak hours with many groups waiting (≥2 groups = users can queue elsewhere)
            'peak_hours' => [
                'total_users' => max(35, $playersPerRound * 5), // At least 5 group rounds
                'served_users' => $playersPerRound * 2, // 2 groups already served
                'called_users' => $playersPerRound, // 1 group currently called
                'waiting_users' => max(20, $playersPerRound * 2), // 2+ groups waiting (can queue elsewhere)
            ],
            // Scenario 2: Almost ready (1 group waiting = cannot queue elsewhere)
            'almost_ready' => [
                'total_users' => $playersPerRound + 5, // Just over 1 group
                'served_users' => 0,
                'called_users' => $playersPerRound, // Current group being served
                'waiting_users' => 5, // Less than 1 full group (cannot queue elsewhere)
            ],
            // Scenario 3: Busy but manageable
            'moderate' => [
                'total_users' => $playersPerRound * 3, // 3 groups total
                'served_users' => $playersPerRound, // 1 group done
                'called_users' => 0,
                'waiting_users' => $playersPerRound * 2, // 2 groups waiting
            ]
        ];

        // Select scenario based on restaurant index to have variety
        $scenarioNames = array_keys($scenarios);
        $selectedScenario = $scenarios[$scenarioNames[$restaurantIndex % count($scenarioNames)]];
        
        $totalUsers = $selectedScenario['total_users'];
        $userBatch = $availableUsers->take($totalUsers);
        $queuePosition = 1;
        $baseTime = Carbon::today()->addHours(10); // Start at 10 AM

        // Ensure we have enough users for this restaurant
        if ($userBatch->count() < $totalUsers) {
            $this->command->warn("Not enough users for {$restaurant->name}. Reducing queue size to available users.");
            $totalUsers = $userBatch->count();
            // Adjust scenario to fit available users
            $selectedScenario['served_users'] = min($selectedScenario['served_users'], $totalUsers);
            $selectedScenario['called_users'] = min($selectedScenario['called_users'], $totalUsers - $selectedScenario['served_users']);
            $selectedScenario['waiting_users'] = $totalUsers - $selectedScenario['served_users'] - $selectedScenario['called_users'];
        }

        // Convert to array for easier access
        $userBatchArray = $userBatch->values()->toArray();

        // Create served users (already completed)
        for ($i = 0; $i < $selectedScenario['served_users']; $i++) {
            if ($i >= count($userBatchArray)) break;
            
            $reservationTime = $baseTime->copy()->addMinutes($i * 5);
            
            UserRestaurant::create([
                'user_id' => $userBatchArray[$i]['id'],
                'restaurant_id' => $restaurant->id,
                'queue_position' => $queuePosition++,
                'slot_number' => $queuePosition - 1,
                'status' => 'served',
                'invoice_id' => $invoices->random()->id,
                'reservation_date' => Carbon::today(),
                'reservation_time' => $reservationTime->format('H:i'),
                'created_at' => Carbon::now()->subHours(2)->subMinutes(rand(0, 120)),
                'updated_at' => Carbon::now()->subMinutes(rand(30, 120)),
            ]);
        }

        // Create called users (currently being served)
        $calledStart = $selectedScenario['served_users'];
        for ($i = $calledStart; $i < $calledStart + $selectedScenario['called_users']; $i++) {
            if ($i >= count($userBatchArray)) break;
            
            $reservationTime = $baseTime->copy()->addMinutes($i * 5);
            
            UserRestaurant::create([
                'user_id' => $userBatchArray[$i]['id'],
                'restaurant_id' => $restaurant->id,
                'queue_position' => $queuePosition++,
                'slot_number' => $queuePosition - 1,
                'status' => 'called',
                'invoice_id' => $invoices->random()->id,
                'reservation_date' => Carbon::today(),
                'reservation_time' => $reservationTime->format('H:i'),
                'created_at' => Carbon::now()->subMinutes(rand(30, 90)),
                'updated_at' => Carbon::now()->subMinutes(rand(1, 10)),
            ]);
        }

        // Create waiting users (in queue)
        $waitingStart = $calledStart + $selectedScenario['called_users'];
        for ($i = $waitingStart; $i < $waitingStart + $selectedScenario['waiting_users']; $i++) {
            if ($i >= count($userBatchArray)) break;
            
            $reservationTime = $baseTime->copy()->addMinutes($i * 5);
            
            UserRestaurant::create([
                'user_id' => $userBatchArray[$i]['id'],
                'restaurant_id' => $restaurant->id,
                'queue_position' => $queuePosition++,
                'slot_number' => $queuePosition - 1,
                'status' => 'waiting',
                'invoice_id' => $invoices->random()->id,
                'reservation_date' => Carbon::today(),
                'reservation_time' => $reservationTime->format('H:i'),
                'created_at' => Carbon::now()->subMinutes(rand(0, 30)),
                'updated_at' => Carbon::now()->subMinutes(rand(0, 30)),
            ]);
        }

        // Add some cancelled queues for realism
        for ($i = 0; $i < min(3, $availableUsers->count() - $totalUsers); $i++) {
            if ($totalUsers + $i >= $availableUsers->count()) break;
            
            $cancelledUser = $availableUsers->skip($totalUsers + $i)->first();
            if (!$cancelledUser) break;
            
            $reservationTime = $baseTime->copy()->addMinutes(($totalUsers + $i) * 5);
            
            UserRestaurant::create([
                'user_id' => $cancelledUser->id,
                'restaurant_id' => $restaurant->id,
                'queue_position' => $queuePosition++,
                'slot_number' => $queuePosition - 1,
                'status' => 'cancelled',
                'invoice_id' => $invoices->random()->id,
                'reservation_date' => Carbon::today(),
                'reservation_time' => $reservationTime->format('H:i'),
                'created_at' => Carbon::now()->subHours(1)->subMinutes(rand(0, 60)),
                'updated_at' => Carbon::now()->subMinutes(rand(15, 45)),
            ]);
        }

        $groupsWaiting = ceil($selectedScenario['waiting_users'] / $playersPerRound);
        $scenarioType = array_search($selectedScenario, $scenarios);
        
        $this->command->info("Created {$restaurant->name} queue: {$totalUsers} total users");
        $this->command->info("  - Scenario: {$scenarioType}");
        $this->command->info("  - Groups waiting: {$groupsWaiting} (can queue elsewhere: " . ($groupsWaiting >= 2 ? 'YES' : 'NO') . ")");
        $this->command->info("  - Players per round: {$playersPerRound}, Time per round: {$estimatedTimePerRound} min");
    }

    private function createAdvancedAttractionQueues($attraction, $availableUsers, $invoices, $attractionIndex)
    {
        $playersPerRound = $attraction->players_per_round ?? 4;
        $estimatedTimePerRound = $attraction->estimated_time_per_round ?? 15;
        
        // Create adaptive queue scenarios for attractions based on capacity
        $scenarios = [
            // Heavy load scenario - adapted for high capacity attractions
            'heavy_load' => [
                'total_users' => min(60, max(40, $playersPerRound * 4)), // Cap at 60 users max
                'served_users' => min($playersPerRound * 2, 20), // Max 20 served users
                'called_users' => $playersPerRound, // 1 group playing
                'waiting_users' => min(max(20, $playersPerRound * 2), 40), // Cap waiting at 40
            ],
            // Light load scenario  
            'light_load' => [
                'total_users' => min(30, $playersPerRound + rand(5, 10)), // Reasonable light load
                'served_users' => 0,
                'called_users' => $playersPerRound, // 1 group playing
                'waiting_users' => rand(5, 20), // Few people waiting
            ],
            // Medium load scenario
            'medium_load' => [
                'total_users' => min(45, $playersPerRound * 3), // Cap at 45 users
                'served_users' => min($playersPerRound, 15), // Max 15 served
                'called_users' => $playersPerRound, // 1 group playing
                'waiting_users' => min($playersPerRound * 2, 25), // Cap waiting at 25
            ]
        ];

        // Select scenario based on attraction index
        $scenarioNames = array_keys($scenarios);
        $selectedScenario = $scenarios[$scenarioNames[$attractionIndex % count($scenarioNames)]];
        
        $totalUsers = $selectedScenario['total_users'];
        $userBatch = $availableUsers->take($totalUsers); // Use available users for attractions
        $queuePosition = 1;
        $baseTime = Carbon::today()->addHours(14); // Start at 2 PM

        // Ensure we have enough users for this attraction
        if ($userBatch->count() < $totalUsers) {
            $this->command->warn("Not enough users for {$attraction->name}. Available: {$userBatch->count()}, Needed: {$totalUsers}. Reducing queue size.");
            $totalUsers = $userBatch->count();
            if ($totalUsers < 10) {
                $this->command->warn("Too few users for {$attraction->name}. Skipping attraction queue creation.");
                return;
            }
            // Adjust scenario to fit available users
            $selectedScenario['served_users'] = min($selectedScenario['served_users'], intval($totalUsers * 0.3));
            $selectedScenario['called_users'] = min($selectedScenario['called_users'], intval($totalUsers * 0.2));
            $selectedScenario['waiting_users'] = $totalUsers - $selectedScenario['served_users'] - $selectedScenario['called_users'];
        }

        // Convert to array for easier access
        $userBatchArray = $userBatch->values()->toArray();

        // Create served users
        for ($i = 0; $i < $selectedScenario['served_users']; $i++) {
            if ($i >= count($userBatchArray)) break;
            
            $reservationTime = $baseTime->copy()->addMinutes($i * 3);
            
            UserAttraction::create([
                'user_id' => $userBatchArray[$i]['id'],
                'attraction_id' => $attraction->id,
                'queue_position' => $queuePosition++,
                'slot_number' => $queuePosition - 1,
                'status' => 'served',
                'invoice_id' => $invoices->random()->id,
                'reservation_date' => Carbon::today(),
                'reservation_time' => $reservationTime->format('H:i'),
                'created_at' => Carbon::now()->subHours(3)->subMinutes(rand(0, 180)),
                'updated_at' => Carbon::now()->subHours(1)->subMinutes(rand(0, 60)),
            ]);
        }

        // Create called users (currently playing)
        $calledStart = $selectedScenario['served_users'];
        for ($i = $calledStart; $i < $calledStart + $selectedScenario['called_users']; $i++) {
            if ($i >= count($userBatchArray)) break;
            
            $reservationTime = $baseTime->copy()->addMinutes($i * 3);
            
            UserAttraction::create([
                'user_id' => $userBatchArray[$i]['id'],
                'attraction_id' => $attraction->id,
                'queue_position' => $queuePosition++,
                'slot_number' => $queuePosition - 1,
                'status' => 'called',
                'invoice_id' => $invoices->random()->id,
                'reservation_date' => Carbon::today(),
                'reservation_time' => $reservationTime->format('H:i'),
                'created_at' => Carbon::now()->subMinutes(rand(15, 45)),
                'updated_at' => Carbon::now()->subMinutes(rand(1, 15)),
            ]);
        }

        // Create waiting users
        $waitingStart = $calledStart + $selectedScenario['called_users'];
        for ($i = $waitingStart; $i < $waitingStart + $selectedScenario['waiting_users']; $i++) {
            if ($i >= count($userBatchArray)) break;
            
            $reservationTime = $baseTime->copy()->addMinutes($i * 3);
            
            UserAttraction::create([
                'user_id' => $userBatchArray[$i]['id'],
                'attraction_id' => $attraction->id,
                'queue_position' => $queuePosition++,
                'slot_number' => $queuePosition - 1,
                'status' => 'waiting',
                'invoice_id' => $invoices->random()->id,
                'reservation_date' => Carbon::today(),
                'reservation_time' => $reservationTime->format('H:i'),
                'created_at' => Carbon::now()->subMinutes(rand(0, 30)),
                'updated_at' => Carbon::now()->subMinutes(rand(0, 30)),
            ]);
        }

        // Add cancelled queues
        for ($i = 0; $i < min(2, $availableUsers->count() - $totalUsers); $i++) {
            if ($totalUsers + $i >= $availableUsers->count()) break;
            
            $cancelledUser = $availableUsers->skip($totalUsers + $i)->first();
            if (!$cancelledUser) break;
            
            $reservationTime = $baseTime->copy()->addMinutes(($totalUsers + $i) * 3);
            
            UserAttraction::create([
                'user_id' => $cancelledUser->id,
                'attraction_id' => $attraction->id,
                'queue_position' => $queuePosition++,
                'slot_number' => $queuePosition - 1,
                'status' => 'cancelled',
                'invoice_id' => $invoices->random()->id,
                'reservation_date' => Carbon::today(),
                'reservation_time' => $reservationTime->format('H:i'),
                'created_at' => Carbon::now()->subHours(1)->subMinutes(rand(0, 60)),
                'updated_at' => Carbon::now()->subMinutes(rand(10, 30)),
            ]);
        }

        $groupsWaiting = ceil($selectedScenario['waiting_users'] / $playersPerRound);
        $scenarioType = array_search($selectedScenario, $scenarios);
        
        $this->command->info("Created {$attraction->name} queue: {$totalUsers} total users");
        $this->command->info("  - Scenario: {$scenarioType}");
        $this->command->info("  - Groups waiting: {$groupsWaiting} (can queue elsewhere: " . ($groupsWaiting >= 2 ? 'YES' : 'NO') . ")");
        $this->command->info("  - Players per round: {$playersPerRound}, Time per round: {$estimatedTimePerRound} min");
    }
}

