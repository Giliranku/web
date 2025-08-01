<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use images from public directory for tickets
        $tickets = [
            [
                'name' => 'Tiket Masuk Taman Hiburan Ancol',
                'logo' => 'gambar1.png', // Using existing public image
                'price' => 150_000,
                'price_before' => 175_000,
                'location' => 'Ancol',
                'terms_and_conditions' => 'Tiket berlaku untuk satu kali masuk. Tidak dapat diuangkan kembali. Berlaku untuk semua wahana dan restoran.',
                'usage' => 'Tunjukkan tiket digital ini di gerbang masuk. Tiket memberikan akses ke semua wahana dan restoran.'
            ],
            [
                'name' => 'Tiket Wahana Premium Ancol',
                'logo' => 'gambar2.png', // Using existing public image
                'price' => 200_000,
                'price_before' => 250_000,
                'location' => 'Ancol',
                'terms_and_conditions' => 'Tiket premium dengan akses prioritas. Berlaku satu hari penuh.',
                'usage' => 'Tiket premium memberikan akses cepat ke semua wahana tanpa antrian panjang.'
            ],
            [
                'name' => 'Tiket Keluarga Ancol (4 Orang)',
                'logo' => 'gambar3.jpg', // Using existing public image
                'price' => 500_000,
                'price_before' => 600_000,
                'location' => 'Ancol',
                'terms_and_conditions' => 'Tiket berlaku untuk 4 orang (2 dewasa + 2 anak). Tidak dapat dipecah.',
                'usage' => 'Paket hemat untuk keluarga. Akses ke semua fasilitas selama satu hari.'
            ],
            [
                'name' => 'Tiket Weekend Special',
                'logo' => 'gambar_hebat.png', // Using existing public image
                'price' => 180_000,
                'price_before' => 220_000,
                'location' => 'Ancol',
                'terms_and_conditions' => 'Berlaku khusus akhir pekan (Sabtu-Minggu). Akses penuh ke semua wahana.',
                'usage' => 'Tiket weekend dengan bonus voucher makan di restoran pilihan.'
            ],
        ];

        foreach ($tickets as $data) {
            Ticket::create($data);
        }
    }
    
    /**
     * Get the correct image URL, handling both seeder images and admin uploads
     */
    private function getImageUrl($imageName)
    {
        if (!$imageName) {
            return asset('img/default-placeholder.jpg');
        }

        // Check if it's a storage path (admin uploads)
        $storagePath = public_path('storage/' . $imageName);
        if (file_exists($storagePath)) {
            return asset('storage/' . $imageName);
        }

        // Check if it's in the img directory (seeder images)
        $imgPath = public_path('img/' . $imageName);
        if (file_exists($imgPath)) {
            return asset('img/' . $imageName);
        }

        // Fallback to default if image not found
        return asset('img/default-placeholder.jpg');
    }
}
