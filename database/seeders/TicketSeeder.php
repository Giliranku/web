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
        // Use images from public/img directory for tickets
        $tickets = [
            [
                'name' => 'Tiket Masuk Taman Hiburan Ancol',
                'logo' => 'ancol-logo.png',
                'price' => 150_000,
                'price_before' => 175_000,
                'location' => 'Ancol',
                'ticket_type' => 'regular',
                'fast_pass_price_multiplier' => 1.00,
                'terms_and_conditions' => 'Tiket berlaku untuk satu kali masuk. Tidak dapat diuangkan kembali. Berlaku untuk semua wahana dan restoran.',
                'usage' => 'Tunjukkan tiket digital ini di gerbang masuk. Tiket memberikan akses ke semua wahana dan restoran.'
            ],
            [
                'name' => 'Tiket Wahana Premium Ancol',
                'logo' => 'dufan.jpeg',
                'price' => 200_000,
                'price_before' => 250_000,
                'location' => 'Ancol',
                'ticket_type' => 'regular',
                'fast_pass_price_multiplier' => 1.00,
                'terms_and_conditions' => 'Tiket premium dengan akses prioritas. Berlaku satu hari penuh.',
                'usage' => 'Tiket premium memberikan akses cepat ke semua wahana tanpa antrian panjang.'
            ],
            [
                'name' => 'Tiket Keluarga Ancol (4 Orang)',
                'logo' => 'attractions.png',
                'price' => 500_000,
                'price_before' => 600_000,
                'location' => 'Ancol',
                'ticket_type' => 'regular',
                'fast_pass_price_multiplier' => 1.00,
                'terms_and_conditions' => 'Tiket berlaku untuk 4 orang (2 dewasa + 2 anak). Tidak dapat dipecah.',
                'usage' => 'Paket hemat untuk keluarga. Akses ke semua fasilitas selama satu hari.'
            ],
            [
                'name' => 'Tiket Weekend Special',
                'logo' => 'seaworld.jpeg',
                'price' => 180_000,
                'price_before' => 220_000,
                'location' => 'Ancol',
                'ticket_type' => 'regular',
                'fast_pass_price_multiplier' => 1.00,
                'terms_and_conditions' => 'Berlaku khusus akhir pekan (Sabtu-Minggu). Akses penuh ke semua wahana.',
                'usage' => 'Tiket weekend dengan bonus voucher makan di restoran pilihan.'
            ],
            [
                'name' => 'Tiket Student Discount (Pelajar)',
                'logo' => 'info.png',
                'price' => 100_000,
                'price_before' => 150_000,
                'location' => 'Ancol',
                'ticket_type' => 'regular',
                'fast_pass_price_multiplier' => 1.00,
                'terms_and_conditions' => 'Berlaku untuk pelajar dengan kartu pelajar valid. Wajib menunjukkan kartu saat masuk.',
                'usage' => 'Diskon khusus pelajar. Akses ke semua wahana dan area rekreasi.'
            ],
            [
                'name' => 'Tiket Senior Citizen (Lansia)',
                'logo' => 'group.png',
                'price' => 75_000,
                'price_before' => 150_000,
                'location' => 'Ancol',
                'ticket_type' => 'regular',
                'fast_pass_price_multiplier' => 1.00,
                'terms_and_conditions' => 'Berlaku untuk usia 60 tahun ke atas. Wajib menunjukkan KTP saat masuk.',
                'usage' => 'Harga spesial untuk lansia. Akses ke wahana ramah lansia dan area santai.'
            ],
            [
                'name' => 'Tiket Annual Pass (Tahunan)',
                'logo' => 'logo-giliranku.png',
                'price' => 1_500_000,
                'price_before' => 2_000_000,
                'location' => 'Ancol',
                'ticket_type' => 'regular',
                'fast_pass_price_multiplier' => 1.00,
                'terms_and_conditions' => 'Berlaku selama 365 hari dari tanggal pembelian. Tidak dapat dipindahtangankan.',
                'usage' => 'Akses unlimited selama setahun. Termasuk benefit member dan diskon F&B.'
            ],
            [
                'name' => 'Tiket Group 10+ Orang',
                'logo' => 'group.png',
                'price' => 1_200_000,
                'price_before' => 1_500_000,
                'location' => 'Ancol',
                'ticket_type' => 'regular',
                'fast_pass_price_multiplier' => 1.00,
                'terms_and_conditions' => 'Minimal 10 orang per grup. Harus datang bersama-sama.',
                'usage' => 'Paket group dengan guide dan lunch. Cocok untuk gathering dan study tour.'
            ],
            [
                'name' => 'Tiket Birthday Special',
                'logo' => 'calendar.png',
                'price' => 50_000,
                'price_before' => 150_000,
                'location' => 'Ancol',
                'ticket_type' => 'regular',
                'fast_pass_price_multiplier' => 1.00,
                'terms_and_conditions' => 'Berlaku di bulan ulang tahun. Wajib menunjukkan KTP atau akta lahir.',
                'usage' => 'Promo ulang tahun dengan free birthday cake dan foto profesional.'
            ],
            // Fast Pass Tickets
            [
                'name' => 'Fast Pass - Express Access',
                'logo' => 'logo-giliranku.png',
                'price' => 225_000,
                'price_before' => 300_000,
                'location' => 'Ancol',
                'ticket_type' => 'fast_pass',
                'fast_pass_price_multiplier' => 1.50,
                'terms_and_conditions' => 'Tiket Fast Pass memberikan akses prioritas ke semua wahana dan restoran. Berlaku satu hari penuh.',
                'usage' => 'Tunjukkan tiket Fast Pass untuk mendapat antrian prioritas di semua lokasi.'
            ],
            [
                'name' => 'Fast Pass VIP Experience',
                'logo' => 'bgVIP.png',
                'price' => 450_000,
                'price_before' => 600_000,
                'location' => 'Ancol',
                'ticket_type' => 'fast_pass',
                'fast_pass_price_multiplier' => 2.00,
                'terms_and_conditions' => 'VIP access dengan personal guide dan prioritas tertinggi. Termasuk lunch premium.',
                'usage' => 'Pengalaman VIP lengkap dengan dedicated staff dan akses area eksklusif.'
            ],
            [
                'name' => 'Fast Pass Family (4 Orang)',
                'logo' => 'group.png',
                'price' => 800_000,
                'price_before' => 1_200_000,
                'location' => 'Ancol',
                'ticket_type' => 'fast_pass',
                'fast_pass_price_multiplier' => 1.75,
                'terms_and_conditions' => 'Fast pass untuk keluarga 4 orang. Akses prioritas dan area VIP family.',
                'usage' => 'Fast pass keluarga dengan kids priority dan family lounge access.'
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
