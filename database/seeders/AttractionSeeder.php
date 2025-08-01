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
                'players_per_round' => 12, // Bumper car style - 12 pemain per ronde
                'estimated_time_per_round' => 8, // 8 menit per ronde
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
                'players_per_round' => 20, // Roller coaster style - 20 pemain per ronde
                'estimated_time_per_round' => 10, // 10 menit per ronde
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
                'players_per_round' => 30, // Ferris wheel style - 30 pemain per ronde
                'estimated_time_per_round' => 15, // 15 menit per ronde
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
                'players_per_round' => 25, // Water adventure - 25 pemain per ronde
                'estimated_time_per_round' => 20, // 20 menit per ronde
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
                'players_per_round' => 6, // Default - 6 pemain per ronde
                'estimated_time_per_round' => 15, // 15 menit per ronde
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
