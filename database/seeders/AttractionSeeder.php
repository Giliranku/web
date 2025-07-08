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
        $staffs = Staff::all();
        $attractions = [
            [
                'name' => 'DoAndFun',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 30,
                'time_estimation' => 12,
                'description' => 'Wahana hiburan inovatif yang menawarkan petualangan 360 derajat yang mendebarkan.',
                'cover' => 'wahana1.png',
                'img1' => 'wahana1.png',
                'img2' => 'wahana1.png',
                'img3' => 'wahana1.png',
            ],
            [
                'name' => 'SpinReverse',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 20,
                'time_estimation' => 15,
                'description' => 'Wahana berputar cepat dengan efek imersif dan sensasi terbang.',
                'cover' => 'wahana2.png',
                'img1' => 'wahana2.png',
                'img2' => 'wahana2.png',
                'img3' => 'wahana2.png',
            ],
            [
                'name' => 'Mercus Tower',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 40,
                'time_estimation' => 20,
                'description' => 'Menara tinggi dengan pemandangan indah dan wahana jatuh bebas.',
                'cover' => 'wahana3.png',
                'img1' => 'wahana3.png',
                'img2' => 'wahana3.png',
                'img3' => 'wahana3.png',
            ],
            [
                'name' => 'Atlantis Water Adventure',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 100,
                'time_estimation' => 30,
                'description' => 'Wahana air keluarga dengan berbagai seluncuran dan kolam.',
                'cover' => 'atlantis.jpeg',
                'img1' => 'atlantis.jpeg',
                'img2' => 'atlantis.jpeg',
                'img3' => 'atlantis.jpeg',
            ],
            [
                'name' => 'Arung Jeram',
                'location' => 'Taman Bermain Ancol',
                'capacity' => 25,
                'time_estimation' => 18,
                'description' => 'Petualangan arung jeram seru di sungai buatan.',
                'cover' => 'arung-jeram.jpg',
                'img1' => 'arung-jeram.jpg',
                'img2' => 'arung-jeram.jpg',
                'img3' => 'arung-jeram.jpg',
            ],
        ];
        foreach ($attractions as $data) {
            $data['staff_id'] = $staffs->random()->id;
            Attraction::create($data);
        }
    }
}
