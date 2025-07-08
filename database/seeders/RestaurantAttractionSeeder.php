<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attraction::create([
            'name' => 'Attraction A',
            'description' => 'Description for Attraction A',
            'location' => 'Location A',
            'price' => 100,
            'staff_id' => 1,
        ]);
        Attraction::create([
            'name' => 'Attraction B',
            'description' => 'Description for Attraction B',
            'location' => 'Location B',
            'price' => 150,
            'staff_id' => 2,
        ]);
        Restaurant::create([
            'name' => 'Restaurant A',
            'description' => 'Description for Restaurant A',
            'location' => 'Location A',
            'capacity' => 50,
            'time_estimation' => 30,
            'staff_id' => 3,
        ]);
        Restaurant::create([
            'name' => 'Restaurant B',
            'description' => 'Description for Restaurant B',
            'location' => 'Location B',
            'capacity' => 100,
            'time_estimation' => 45,
            'staff_id' => 4,
        ]);
    }
}
