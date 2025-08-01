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

        // Create realistic users for comprehensive queue simulation - need many users for 30+ queues per location
        // Create users using a systematic approach to avoid duplicates
        $baseNames = [
            'Ahmad', 'Budi', 'Citra', 'Dedi', 'Eka', 'Fajar', 'Gilang', 'Hani', 'Indira', 'Jasmine',
            'Kevin', 'Luna', 'Malik', 'Nadia', 'Oscar', 'Priya', 'Qonita', 'Ryan', 'Sari', 'Taufik',
            'Ulfa', 'Vina', 'Wulan', 'Yoga', 'Zahra', 'Aldi', 'Bella', 'Cakra', 'Diandra', 'Eko',
            'Fita', 'Gilberd', 'Hana', 'Ivan', 'Jessica', 'Kiesha', 'Lestari', 'Maudy', 'Nikita', 'Olla',
            'Paula', 'Queen', 'Raisa', 'Syahrini', 'Titi', 'Uya', 'Vanessa', 'Wendy', 'Yuki', 'Zaskia'
        ];
        
        $suffixes = [
            'Pratama', 'Sari', 'Putri', 'Wijaya', 'Santoso', 'Dewi', 'Firmansyah', 'Lestari', 'Nugroho', 'Astuti',
            'Setiawan', 'Marlina', 'Prabowo', 'Permatasari', 'Susanto', 'Maharani', 'Prasetyo', 'Fadillah', 'Kencana', 'Budiman',
            'Puspita', 'Hidayat', 'Wati', 'Bagus', 'Suardana', 'Wirawan', 'Putra', 'Gunawan', 'Ayu', 'Yoga',
            'Mahendra', 'Eka', 'Artha', 'Indira', 'Adi', 'Anastasia', 'Hutapea', 'Simanjuntak', 'Silalahi', 'Situmorang',
            'Panjaitan', 'Tarigan', 'Marbun', 'Simbolon', 'Siahaan', 'Pakpahan', 'Sinaga', 'Siregar', 'Turnip', 'Simatupang'
        ];

        $userCount = 0;
        
        // Generate unique combinations - create exactly 401 users for comprehensive testing  
        for ($i = 0; $i < count($baseNames); $i++) {
            for ($j = 0; $j < count($suffixes); $j++) { // Use all suffixes for maximum coverage
                $name = $baseNames[$i] . ' ' . $suffixes[$j];
                $emailSlug = strtolower(str_replace(' ', '.', $name));
                
                User::create([
                    'name' => $name,
                    'email' => $emailSlug . '.' . $userCount . '@gmail.com', // Add counter to ensure uniqueness
                    'password' => Hash::make('password123'),
                    'number' => 81234567000 + $userCount,
                ]);
                
                $userCount++;
                
                // Create exactly 400 users (plus 1 test user = 401 total)
                if ($userCount >= 400) break 2;
            }
        }

        // Add additional numeric users if needed to reach exactly 400
        while ($userCount < 400) {
            User::create([
                'name' => 'User ' . ($userCount + 1),
                'email' => 'user.' . ($userCount + 1) . '@gmail.com',
                'password' => Hash::make('password123'),
                'number' => 81234567000 + $userCount,
            ]);
            $userCount++;
        }

        $this->command->info('Created ' . ($userCount + 1) . ' users for comprehensive queue simulation (401 total)');
    }
}
