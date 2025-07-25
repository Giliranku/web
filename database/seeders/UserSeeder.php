<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'number' => 29292929229,
        ]);

        // Create additional realistic users for queue simulation
        $users = [
            [
                'name' => 'Ahmad Santoso',
                'email' => 'ahmad.santoso@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567890,
            ],
            [
                'name' => 'Sari Dewi',
                'email' => 'sari.dewi@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567891,
            ],
            [
                'name' => 'Budi Pratama',
                'email' => 'budi.pratama@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567892,
            ],
            [
                'name' => 'Indira Putri',
                'email' => 'indira.putri@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567893,
            ],
            [
                'name' => 'Rizki Firmansyah',
                'email' => 'rizki.firmansyah@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567894,
            ],
            [
                'name' => 'Maya Salsabila',
                'email' => 'maya.salsabila@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567895,
            ],
            [
                'name' => 'Dedi Kurniawan',
                'email' => 'dedi.kurniawan@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567896,
            ],
            [
                'name' => 'Lia Wulandari',
                'email' => 'lia.wulandari@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567897,
            ],
            [
                'name' => 'Fajar Nugroho',
                'email' => 'fajar.nugroho@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567898,
            ],
            [
                'name' => 'Rini Astuti',
                'email' => 'rini.astuti@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567899,
            ],
            [
                'name' => 'Wahyu Setiawan',
                'email' => 'wahyu.setiawan@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567800,
            ],
            [
                'name' => 'Dina Marlina',
                'email' => 'dina.marlina@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567801,
            ],
            [
                'name' => 'Eko Prabowo',
                'email' => 'eko.prabowo@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567802,
            ],
            [
                'name' => 'Novi Permatasari',
                'email' => 'novi.permatasari@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567803,
            ],
            [
                'name' => 'Agus Susanto',
                'email' => 'agus.susanto@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567804,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        $this->command->info('Created ' . (count($users) + 1) . ' users for queue simulation');
    }
}
