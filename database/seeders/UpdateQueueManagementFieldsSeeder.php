<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attraction;
use App\Models\Restaurant;

class UpdateQueueManagementFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing attractions with default queue management values
        Attraction::whereNull('players_per_round')->update([
            'players_per_round' => 4,
            'estimated_time_per_round' => 15,
        ]);

        // Set specific values for different attraction types
        Attraction::where('name', 'like', '%rollercoaster%')->orWhere('name', 'like', '%roller coaster%')
            ->update([
                'players_per_round' => 20,
                'estimated_time_per_round' => 10,
            ]);

        Attraction::where('name', 'like', '%ferris wheel%')->orWhere('name', 'like', '%bianglala%')
            ->update([
                'players_per_round' => 30,
                'estimated_time_per_round' => 15,
            ]);

        Attraction::where('name', 'like', '%bumper car%')->orWhere('name', 'like', '%mobil%')
            ->update([
                'players_per_round' => 12,
                'estimated_time_per_round' => 8,
            ]);

        // Update existing restaurants with default queue management values
        Restaurant::whereNull('players_per_round')->update([
            'players_per_round' => 6,
            'estimated_time_per_round' => 30,
        ]);

        // Set specific values for different restaurant types
        Restaurant::where('name', 'like', '%fast food%')->orWhere('name', 'like', '%cepat saji%')
            ->update([
                'players_per_round' => 10,
                'estimated_time_per_round' => 15,
            ]);

        Restaurant::where('name', 'like', '%fine dining%')->orWhere('name', 'like', '%mewah%')
            ->update([
                'players_per_round' => 4,
                'estimated_time_per_round' => 45,
            ]);

        Restaurant::where('name', 'like', '%coffee%')->orWhere('name', 'like', '%kopi%')
            ->update([
                'players_per_round' => 8,
                'estimated_time_per_round' => 20,
            ]);

        $this->command->info('Updated queue management fields for all attractions and restaurants.');
    }
}
