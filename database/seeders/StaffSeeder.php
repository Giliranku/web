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

        // Restaurant staff - one for each restaurant (now we have 13 restaurants)
        $restaurantStaff = [
            ['name' => 'KFC Manager', 'email' => 'kfc@giliranku.com'],
            ['name' => 'McDonald\'s Manager', 'email' => 'mcdonalds@giliranku.com'],
            ['name' => 'Pizza Hut Manager', 'email' => 'pizzahut@giliranku.com'],
            ['name' => 'Chatime Manager', 'email' => 'chatime@giliranku.com'],
            ['name' => 'Roti O Manager', 'email' => 'rotio@giliranku.com'],
            ['name' => 'Raa Cha Manager', 'email' => 'raacha@giliranku.com'],
            ['name' => 'Starbucks Manager', 'email' => 'starbucks@giliranku.com'],
            ['name' => 'Solaria Manager', 'email' => 'solaria@giliranku.com'],
            ['name' => 'Burger King Manager', 'email' => 'burgerking@giliranku.com'],
            ['name' => 'Sushi Tei Manager', 'email' => 'sushitei@giliranku.com'],
            ['name' => 'Padang Manager', 'email' => 'padang@giliranku.com'],
            ['name' => 'Bakso Malang Manager', 'email' => 'bakso@giliranku.com'],
            ['name' => 'Es Teler Manager', 'email' => 'esteler@giliranku.com'],
        ];

        foreach ($restaurantStaff as $index => $staff) {
            Staff::create([
                'name' => $staff['name'],
                'email' => $staff['email'],
                'number' => '089647' . str_pad(528001 + $index, 6, '0', STR_PAD_LEFT),
                'password' => bcrypt('password123'),
                'role' => 'staff_restaurant',
            ]);
        }

        // Attraction staff - one for each attraction (now we have 10 attractions)
        $attractionStaff = [
            ['name' => 'DoAndFun Manager', 'email' => 'doandfun@giliranku.com'],
            ['name' => 'SpinReverse Manager', 'email' => 'spinreverse@giliranku.com'],
            ['name' => 'Mercus Tower Manager', 'email' => 'mercustower@giliranku.com'],
            ['name' => 'Atlantis Manager', 'email' => 'atlantis@giliranku.com'],
            ['name' => 'Arung Jeram Manager', 'email' => 'arungjeram@giliranku.com'],
            ['name' => 'Sky Warrior Manager', 'email' => 'skywarrior@giliranku.com'],
            ['name' => 'Thunder Storm Manager', 'email' => 'thunderstorm@giliranku.com'],
            ['name' => 'Magic Carpet Manager', 'email' => 'magiccarpet@giliranku.com'],
            ['name' => 'Bumper Car Manager', 'email' => 'bumpercar@giliranku.com'],
            ['name' => 'Haunted Mansion Manager', 'email' => 'haunted@giliranku.com'],
        ];

        foreach ($attractionStaff as $index => $staff) {
            Staff::create([
                'name' => $staff['name'],
                'email' => $staff['email'],
                'number' => '089648' . str_pad(528001 + $index, 6, '0', STR_PAD_LEFT),
                'password' => bcrypt('password123'),
                'role' => 'staff_attraction',
            ]);
        }
    }
}
