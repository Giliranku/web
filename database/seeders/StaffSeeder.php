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
        // Admin accounts
        Staff::create([
            'name' => 'Administrator',
            'email' => 'admin@giliranku.com',
            'number' => '089646528017',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
        
        Staff::create([
            'name' => 'Admin Assistant',
            'email' => 'admin2@giliranku.com',
            'number' => '089646528021',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // Restaurant staff - one for each restaurant (6 total)
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
            'name' => 'Restaurant Manager 3',
            'email' => 'restaurant3@giliranku.com',
            'number' => '089646528022',
            'password' => bcrypt('password123'),
            'role' => 'staff_restaurant',
        ]);
        
        Staff::create([
            'name' => 'Restaurant Manager 4',
            'email' => 'restaurant4@giliranku.com',
            'number' => '089646528024',
            'password' => bcrypt('password123'),
            'role' => 'staff_restaurant',
        ]);
        
        Staff::create([
            'name' => 'Restaurant Manager 5',
            'email' => 'restaurant5@giliranku.com',
            'number' => '089646528025',
            'password' => bcrypt('password123'),
            'role' => 'staff_restaurant',
        ]);
        
        Staff::create([
            'name' => 'Restaurant Manager 6',
            'email' => 'restaurant6@giliranku.com',
            'number' => '089646528027',
            'password' => bcrypt('password123'),
            'role' => 'staff_restaurant',
        ]);

        // Attraction staff - one for each attraction (5 total)
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
            'name' => 'Attraction Manager 3',
            'email' => 'attraction3@giliranku.com',
            'number' => '089646528023',
            'password' => bcrypt('password123'),
            'role' => 'staff_attraction',
        ]);
        
        Staff::create([
            'name' => 'Attraction Manager 4',
            'email' => 'attraction4@giliranku.com',
            'number' => '089646528026',
            'password' => bcrypt('password123'),
            'role' => 'staff_attraction',
        ]);
        
        Staff::create([
            'name' => 'Attraction Manager 5',
            'email' => 'attraction5@giliranku.com',
            'number' => '089646528028',
            'password' => bcrypt('password123'),
            'role' => 'staff_attraction',
        ]);
    }
}
