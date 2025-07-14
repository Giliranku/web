<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attraction;
use App\Models\Restaurant;

class RestaurantAttractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create seeder based on it
        Attraction::create([
            'name' => 'Roller Coaster',
            'location' => 'Adventure Zone',
            'capacity' => 20,
            'time_estimation' => 5,
            'description' => 'A thrilling roller coaster ride with sharp turns and steep drops.',
            'cover' => 'roller_coaster_cover.jpg',
            'img1' => 'roller_coaster_img1.jpg',
            'img2' => 'roller_coaster_img2.jpg',
            'img3' => 'roller_coaster_img3.jpg',
            'staff_id' => 1, // Assuming staff with ID 1 exists
        ]);

        Restaurant::create([
            'name' => 'Gourmet Bistro',
            'location' => 'Food Court',
            'capacity' => 50,
            'description' => 'A fine dining experience with a variety of gourmet dishes.',
            'cover' => 'gourmet_bistro_cover.jpg',
            'img1' => 'gourmet_bistro_img1.jpg',
            'img2' => 'gourmet_bistro_img2.jpg',
            'img3' => 'gourmet_bistro_img3.jpg',
            'staff_id' => 1, // Assuming staff with ID 1 exists
        ]);

        // Create seeder based on it
        Restaurant::create([
            'name' => 'Family Diner',
            'location' => 'Main Street',
            'capacity' => 100,
            'time_estimation' => 30,
            'description' => 'A family-friendly diner serving classic American cuisine.',
            'cover' => 'family_diner_cover.jpg',
            'img1' => 'family_diner_img1.jpg',
            'img2' => 'family_diner_img2.jpg',
            'img3' => 'family_diner_img3.jpg',
            'staff_id' => 1, // Assuming staff with ID 1 exists
        ]);
        Restaurant::create([
            'name' => 'Pizza Palace',
            'location' => 'Food Court',
            'capacity' => 80,
            'time_estimation' => 20,
            'description' => 'A popular spot for delicious pizzas and quick bites.',
            'cover' => 'pizza_palace_cover.jpg',
            'img1' => 'pizza_palace_img1.jpg',
            'img2' => 'pizza_palace_img2.jpg',
            'img3' => 'pizza_palace_img3.jpg',
            'staff_id' => 1, // Assuming staff with ID 1 exists
        ]);
    }
}
