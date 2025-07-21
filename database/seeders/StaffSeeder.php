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
            'name' => 'Administrator',
            'email' => 'admin@giliranku.com',
            'number' => '089646528017',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
        Staff::create([
            'name' => 'Restaurant Manager 1',
            'email' => 'restaurant1@giliranku.com',
            'number' => '089646528016',
            'password' => bcrypt('password123'),
            'role' => 'staff_restaurant',
        ]);
        Staff::create([
            'name' => 'Restaurant Manager 2',
            'email' => 'restaurant2@giliranku.com',
            'number' => '089646528018',
            'password' => bcrypt('password123'),
            'role' => 'staff_restaurant',
        ]);
        Staff::create([
            'name' => 'Attraction Manager 1',
            'email' => 'attraction1@giliranku.com',
            'number' => '089646528019',
            'password' => bcrypt('password123'),
            'role' => 'staff_attraction',
        ]);
        Staff::create([
            'name' => 'Attraction Manager 2',
            'email' => 'attraction2@giliranku.com',
            'number' => '089646528020',
            'password' => bcrypt('password123'),
            'role' => 'staff_attraction',
        ]);
        Staff::create([
            'name' => 'Admin Assistant',
            'email' => 'admin2@giliranku.com',
            'number' => '089646528021',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
        Staff::create([
            'name' => 'Restaurant Supervisor',
            'email' => 'restaurant3@giliranku.com',
            'number' => '089646528022',
            'password' => bcrypt('password123'),
            'role' => 'staff_restaurant',
        ]);
        Staff::create([
            'name' => 'Attraction Supervisor',
            'email' => 'attraction3@giliranku.com',
            'number' => '089646528023',
            'password' => bcrypt('password123'),
            'role' => 'staff_attraction',
        ]);
    }
}
