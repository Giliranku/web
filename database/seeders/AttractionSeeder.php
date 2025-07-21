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
        $staffAttractions = Staff::where('role', 'staff_attraction')->get();
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
            ],
        ];
        foreach ($attractions as $i => $data) {
            $staff = $staffAttractions[$i % $staffAttractions->count()] ?? null;
            if ($staff) {
                $data['staff_id'] = $staff->id;
            }
            Attraction::create($data);
        }
    }
}
