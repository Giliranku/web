<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::create([
            'name' => 'A',
            'email' => 'lorem1@gmail.com',
            'number' => '089646528017',
        ]);
        Staff::create([
            'name' => 'B',
            'email' => 'lorem2@gmail.com',
            'number' => '089646528016',
        ]);
        Staff::create([
            'name' => 'C',
            'email' => 'lorem3@gmail.com',
            'number' => '089646528018',
        ]);
        Staff::create([
            'name' => 'D',
            'email' => 'lorem4@gmail.com',
            'number' => '089646528019',
        ]);
        Staff::create([
            'name' => 'E',
            'email' => 'lorem5@gmail.com',
            'number' => '089646528020',
        ]);
        Staff::create([
            'name' => 'F',
            'email' => 'lorem6@gmail.com',
            'number' => '089646528021',
        ]);
        Staff::create([
            'name' => 'G',
            'email' => 'lorem7@gmail.com',
            'number' => '089646528022',
        ]);
        Staff::create([
            'name' => 'H',
            'email' => 'lorem8@gmail.com',
            'number' => '089646528023',
        ]);
    }
}
