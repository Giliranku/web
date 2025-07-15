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
        // Get all staff members to assign to restaurants
        $staffMembers = Staff::all();

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
                'staff_id' => $staffMembers->random()->id,
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
                'staff_id' => $staffMembers->random()->id,
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
                'staff_id' => $staffMembers->random()->id,
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
                'staff_id' => $staffMembers->random()->id,
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
                'staff_id' => $staffMembers->random()->id,
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
                'staff_id' => $staffMembers->random()->id,
            ],
        ];

        foreach ($restaurants as $restaurantData) {
            Restaurant::create($restaurantData);
        }
    }
}
