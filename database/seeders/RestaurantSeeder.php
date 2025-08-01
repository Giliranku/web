<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get restaurant staff in order - each will be assigned to exactly one restaurant
        $staffRestaurants = Staff::where('role', 'staff_restaurant')->orderBy('id')->get();
        
        $restaurants = [
            [
                'name' => 'KFC Ancol',
                'location' => 'Area Food Court Ancol',
                'capacity' => 150,
                'time_estimation' => 15,
                'description' => 'Restoran cepat saji terkenal dengan ayam goreng crispy dan berbagai menu favorit keluarga.',
                'cover' => 'kfc.webp',
                'img1' => 'gambar1.png',
                'img2' => 'fastfood.png',
                'img3' => 'gambar2.png',
                'players_per_round' => 10, // Fast food - 10 tamu per giliran
                'estimated_time_per_round' => 15, // 15 menit per giliran
            ],
            [
                'name' => 'McDonald\'s Ancol',
                'location' => 'Area Food Court Ancol',
                'capacity' => 200,
                'time_estimation' => 12,
                'description' => 'Restoran cepat saji global dengan menu burger, ayam, dan berbagai pilihan makanan cepat.',
                'cover' => 'mcd.png',
                'img1' => 'mekdi.png',
                'img2' => 'fastfood.png',
                'img3' => 'gambar3.jpg',
                'players_per_round' => 10, // Fast food - 10 tamu per giliran  
                'estimated_time_per_round' => 15, // 15 menit per giliran
            ],
            [
                'name' => 'Pizza Hut Ancol',
                'location' => 'Area Food Court Ancol',
                'capacity' => 120,
                'time_estimation' => 20,
                'description' => 'Restoran pizza terkenal dengan berbagai pilihan pizza, pasta, dan menu Italia lainnya.',
                'cover' => 'pizza-hut.png',
                'img1' => 'fastfood.png',
                'img2' => 'gambar1.png',
                'img3' => 'solaria.png',
                'players_per_round' => 4, // Fine dining - 4 tamu per giliran
                'estimated_time_per_round' => 45, // 45 menit per giliran
            ],
            [
                'name' => 'Chatime Ancol',
                'location' => 'Area Food Court Ancol',
                'capacity' => 80,
                'time_estimation' => 8,
                'description' => 'Kedai minuman bubble tea dengan berbagai pilihan teh dan topping yang menyegarkan.',
                'cover' => 'chatime.png',
                'img1' => 'fastfood.png',
                'img2' => 'gambar2.png',
                'img3' => 'gambar3.jpg',
                'players_per_round' => 8, // Coffee shop - 8 tamu per giliran
                'estimated_time_per_round' => 20, // 20 menit per giliran
            ],
            [
                'name' => 'Roti O Ancol',
                'location' => 'Area Food Court Ancol',
                'capacity' => 60,
                'time_estimation' => 10,
                'description' => 'Toko roti dengan berbagai pilihan roti, kue, dan pastry yang lezat dan segar.',
                'cover' => 'roti-o.png',
                'img1' => 'fastfood.png',
                'img2' => 'gambar1.png',
                'img3' => 'gambar_hebat.png',
                'players_per_round' => 8, // Coffee shop - 8 tamu per giliran  
                'estimated_time_per_round' => 20, // 20 menit per giliran
            ],
            [
                'name' => 'Raa Cha Ancol',
                'location' => 'Area Food Court Ancol',
                'capacity' => 100,
                'time_estimation' => 18,
                'description' => 'Restoran dengan menu fusion yang menggabungkan cita rasa lokal dan internasional.',
                'cover' => 'raa-cha.webp',
                'img1' => 'solaria.png',
                'img2' => 'fastfood.png',
                'img3' => 'gambar2.png',
                'players_per_round' => 6, // Default - 6 tamu per giliran
                'estimated_time_per_round' => 30, // 30 menit per giliran
            ],
        ];

        // Assign each restaurant to exactly one staff member (one-to-one relationship)
        foreach ($restaurants as $i => $restaurantData) {
            if (isset($staffRestaurants[$i])) {
                $restaurantData['staff_id'] = $staffRestaurants[$i]->id;
                Restaurant::create($restaurantData);
            } else {
                // If we run out of staff, create restaurant without staff assignment
                Restaurant::create($restaurantData);
            }
        }
    }
}
