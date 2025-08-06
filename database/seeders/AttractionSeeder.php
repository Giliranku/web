<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attraction;
use App\Models\Staff;

class AttractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get attraction staff in order - each will be assigned to exactly one attraction
        $staffAttractions = Staff::where('role', 'staff_attraction')->orderBy('id')->get();
        
        $attractions = [
            [
                'name' => 'DoAndFun',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 30,
                'time_estimation' => 12,
                'description' => 'Wahana hiburan inovatif yang menawarkan petualangan 360 derajat yang mendebarkan.',
                'cover' => 'halilintar.jpg',
                'img1' => 'wahana1.png',
                'img2' => 'wahana/wahana-1.png',
                'img3' => 'dufan.jpeg',
                'players_per_round' => 12,
                'estimated_time_per_round' => 8,
            ],
            [
                'name' => 'SpinReverse',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 20,
                'time_estimation' => 15,
                'description' => 'Wahana berputar cepat dengan efek imersif dan sensasi terbang.',
                'cover' => 'ontang-anting.jpg',
                'img1' => 'wahana2.png',
                'img2' => 'wahana/wahana-2.png',
                'img3' => 'kora-kora.jpg',
                'players_per_round' => 20,
                'estimated_time_per_round' => 10,
            ],
            [
                'name' => 'Mercus Tower',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 40,
                'time_estimation' => 20,
                'description' => 'Menara tinggi dengan pemandangan indah dan wahana jatuh bebas.',
                'cover' => 'bianglala.jpg',
                'img1' => 'wahana3.png',
                'img2' => 'wahana/wahana-3.png',
                'img3' => 'ferrisWheel.png',
                'players_per_round' => 30,
                'estimated_time_per_round' => 15,
            ],
            [
                'name' => 'Atlantis Water Adventure',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 100,
                'time_estimation' => 30,
                'description' => 'Wahana air keluarga dengan berbagai seluncuran dan kolam.',
                'cover' => 'atlantis.jpeg',
                'img1' => 'seaworld.jpeg',
                'img2' => 'aw.png',
                'img3' => 'ice-age.jpg',
                'players_per_round' => 25,
                'estimated_time_per_round' => 20,
            ],
            [
                'name' => 'Arung Jeram',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 25,
                'time_estimation' => 18,
                'description' => 'Petualangan arung jeram seru di sungai buatan.',
                'cover' => 'arung-jeram.jpg',
                'img1' => 'kegiatanseru1.jpg',
                'img2' => 'kegiatanseru2.jpg',
                'img3' => 'kegiatanseru3.jpg',
                'players_per_round' => 6,
                'estimated_time_per_round' => 15,
            ],
            [
                'name' => 'Sky Warrior',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 24,
                'time_estimation' => 15,
                'description' => 'Simulasi terbang dengan teknologi VR dan motion sensor 360 derajat.',
                'cover' => 'ferrisWheel.png',
                'img1' => 'wahana1.png',
                'img2' => 'wahana/wahana-1.png',
                'img3' => 'attractions.png',
                'players_per_round' => 8,
                'estimated_time_per_round' => 15,
            ],
            [
                'name' => 'Thunder Storm',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 32,
                'time_estimation' => 10,
                'description' => 'Roller coaster berkecepatan tinggi dengan loop dan spiral mendebarkan.',
                'cover' => 'kora-kora.jpg',
                'img1' => 'wahana2.png',
                'img2' => 'wahana/wahana-2.png',
                'img3' => 'halilintar.jpg',
                'players_per_round' => 16,
                'estimated_time_per_round' => 8,
            ],
            [
                'name' => 'Magic Carpet',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 60,
                'time_estimation' => 12,
                'description' => 'Wahana keluarga yang mengayun lembut dengan pemandangan taman.',
                'cover' => 'ice-age.jpg',
                'img1' => 'wahana3.png',
                'img2' => 'wahana/wahana-3.png',
                'img3' => 'dufan.jpeg',
                'players_per_round' => 20,
                'estimated_time_per_round' => 10,
            ],
            [
                'name' => 'Bumper Car Arena',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 40,
                'time_estimation' => 8,
                'description' => 'Arena bumper car modern dengan mobil elektrik dan arena yang luas.',
                'cover' => 'aw.png',
                'img1' => 'seaworld.jpeg',
                'img2' => 'wahana1.png',
                'img3' => 'atlantis.jpeg',
                'players_per_round' => 20,
                'estimated_time_per_round' => 6,
            ],
            [
                'name' => 'Haunted Mansion',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 15,
                'time_estimation' => 20,
                'description' => 'Rumah hantu dengan efek special dan aktor profesional yang menakutkan.',
                'cover' => 'ontang-anting.jpg',
                'img1' => 'wahana2.png',
                'img2' => 'bianglala.jpg',
                'img3' => 'ferrisWheel.png',
                'players_per_round' => 8,
                'estimated_time_per_round' => 18,
            ],
        ];
        
        // Assign each attraction to exactly one staff member (one-to-one relationship)
        foreach ($attractions as $i => $data) {
            if (isset($staffAttractions[$i])) {
                $data['staff_id'] = $staffAttractions[$i]->id;
                Attraction::create($data);
            } else {
                // If we run out of staff, create attraction without staff assignment
                // This shouldn't happen with the updated StaffSeeder
                Attraction::create($data);
            }
        }
    }
}
