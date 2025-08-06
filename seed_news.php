<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\News;

// Promo News
News::create([
    'title' => 'Promo Diskon 50% untuk Tiket Masuk!',
    'author_name' => 'Marketing Team', 
    'description' => 'Dapatkan diskon fantastis hingga 50% untuk tiket masuk Giliranku.',
    'keywords' => 'Promo, Diskon, Tiket',
    'category' => 'promo',
    'news_cover' => 'news_covers/promo1.jpg',
    'staff_id' => 1,
    'content' => '<p>Jangan lewatkan kesempatan emas ini! Dapatkan diskon hingga 50% untuk tiket masuk Giliranku. Promo berlaku terbatas hanya untuk 100 pengunjung pertama setiap harinya.</p>'
]);

News::create([
    'title' => 'Buy 2 Get 1 Free - Promo Spesial Akhir Pekan',
    'author_name' => 'Marketing Team',
    'description' => 'Ajak keluarga dan teman-teman dengan promo buy 2 get 1 free.',
    'keywords' => 'Buy 2 Get 1, Weekend, Keluarga',
    'category' => 'promo',
    'news_cover' => 'news_covers/promo2.jpg',
    'staff_id' => 1,
    'content' => '<p>Promo spesial akhir pekan! Beli 2 tiket dan dapatkan 1 tiket gratis. Sempurna untuk liburan bersama keluarga dan teman-teman.</p>'
]);

// Kegiatan News
News::create([
    'title' => 'Festival Musik Pantai 2025',
    'author_name' => 'Event Organizer',
    'description' => 'Festival musik terbesar tahun ini dengan pemandangan pantai yang menakjubkan.',
    'keywords' => 'Festival, Musik, Pantai, Konser',
    'category' => 'kegiatan',
    'news_cover' => 'news_covers/kegiatan1.jpg',
    'staff_id' => 1,
    'content' => '<p>Bergabunglah dengan Festival Musik Pantai 2025! Nikmati penampilan dari artis-artis terbaik Indonesia dengan latar belakang pantai yang indah. Acara berlangsung selama 3 hari dengan berbagai genre musik.</p>'
]);

// Info News
News::create([
    'title' => 'Kenapa Harus ke Ancol?',
    'author_name' => 'Jesselyn',
    'description' => 'Jakarta menyimpan permata wisata yang tak lekang oleh waktu.',
    'keywords' => 'Ancol, Pantai Ancol, Jakarta',
    'category' => 'info',
    'news_cover' => 'news_covers/info1.jpg',
    'staff_id' => 1,
    'content' => '<p>Jakarta mungkin identik dengan gedung-gedung pencakar langit dan kemacetan, namun siapa sangka ibu kota juga menyimpan permata wisata yang tak lekang oleh waktu: Taman Impian Jaya Ancol.</p>'
]);

echo "News seeded successfully!";
