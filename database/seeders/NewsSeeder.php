<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Staff;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some staff members for news authors
        $staff = Staff::inRandomOrder()->take(3)->get();
        $defaultStaff = $staff->first() ?? Staff::first();

        // News data dengan kategori yang beragam
        $newsData = [
            // Info Giliranku (kategori 'info')
            [
                'title' => 'Sistem Antrian Digital Terbaru di Giliranku',
                'description' => 'Kini Anda dapat memesan antrian wahana favorit secara digital dan menghindari antrian panjang.',
                'content' => '<p>Giliranku kini hadir dengan sistem antrian digital yang revolusioner! Sistem ini memungkinkan pengunjung untuk:</p>
                            <ul>
                                <li>Memesan antrian wahana favorit dari smartphone</li>
                                <li>Memantau posisi antrian secara real-time</li>
                                <li>Menerima notifikasi saat giliran Anda tiba</li>
                                <li>Menghemat waktu dan tenaga</li>
                            </ul>
                            <p>Dengan teknologi terdepan, pengalaman berkunjung Anda akan semakin menyenangkan dan efisien.</p>',
                'keywords' => 'antrian digital, teknologi, wahana, booking online',
                'category' => 'info',
                'author_name' => 'Tim Giliranku',
                'news_cover' => 'info1.jpg',
                'staff_id' => $defaultStaff->id,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Fasilitas Terbaru: Food Court Modern dengan 20+ Tenant',
                'description' => 'Food court baru dengan lebih dari 20 pilihan kuliner dari berbagai daerah dan internasional.',
                'content' => '<p>Giliranku bangga mempersembahkan food court modern yang baru saja diresmikan! Fasilitas ini menampilkan:</p>
                            <p><strong>Pilihan Kuliner Beragam:</strong></p>
                            <ul>
                                <li>Masakan tradisional Indonesia</li>
                                <li>Fast food internasional</li>
                                <li>Dessert dan minuman segar</li>
                                <li>Makanan sehat dan vegetarian</li>
                            </ul>
                            <p>Desain modern dengan kapasitas 500 pengunjung, dilengkapi AC dan WiFi gratis. Area yang nyaman untuk keluarga beristirahat sambil menikmati makanan lezat.</p>',
                'keywords' => 'food court, kuliner, makanan, restoran, fasilitas baru',
                'category' => 'info',
                'author_name' => 'Manajemen Giliranku',
                'news_cover' => 'info2.jpg',
                'staff_id' => $defaultStaff->id,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Protokol Kesehatan dan Keamanan Terbaru',
                'description' => 'Standar keamanan dan kebersihan tinggi untuk memastikan kenyamanan dan keselamatan pengunjung.',
                'content' => '<p>Komitmen Giliranku terhadap keselamatan pengunjung:</p>
                            <p><strong>Protokol Kesehatan:</strong></p>
                            <ul>
                                <li>Sanitasi rutin setiap 2 jam pada semua wahana</li>
                                <li>Hand sanitizer tersedia di 50+ titik</li>
                                <li>Tim medis standby 24/7</li>
                                <li>Sistem ventilasi udara yang baik</li>
                            </ul>
                            <p><strong>Standar Keamanan:</strong></p>
                            <ul>
                                <li>Inspeksi wahana harian oleh teknisi bersertifikat</li>
                                <li>Pelatihan safety untuk seluruh staff</li>
                                <li>Sistem CCTV 360° di seluruh area</li>
                            </ul>',
                'keywords' => 'keamanan, kesehatan, protokol, kebersihan, safety',
                'category' => 'info',
                'author_name' => 'Divisi Keamanan',
                'news_cover' => 'info3.jpg',
                'staff_id' => $defaultStaff->id,
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7),
            ],

            // Promo Spesial (kategori 'promo')
            [
                'title' => 'Promo Spesial Akhir Tahun - Diskon 40% Tiket Masuk!',
                'description' => 'Nikmati diskon fantastis 40% untuk semua jenis tiket. Promo terbatas hingga 31 Desember!',
                'content' => '<p>🎉 <strong>PROMO SPEKTAKULER AKHIR TAHUN!</strong> 🎉</p>
                            <p>Dapatkan diskon hingga <strong>40%</strong> untuk semua jenis tiket Giliranku!</p>
                            
                            <p><strong>Detail Promo:</strong></p>
                            <ul>
                                <li>Tiket Reguler: <del>Rp 150.000</del> → <strong>Rp 90.000</strong></li>
                                <li>Tiket Premium: <del>Rp 250.000</del> → <strong>Rp 150.000</strong></li>
                                <li>Tiket Keluarga: <del>Rp 600.000</del> → <strong>Rp 360.000</strong></li>
                            </ul>
                            
                            <p><strong>Syarat & Ketentuan:</strong></p>
                            <ul>
                                <li>Berlaku hingga 31 Desember 2025</li>
                                <li>Maksimal 4 tiket per transaksi</li>
                                <li>Tidak dapat digabung dengan promo lain</li>
                                <li>Pembelian online only</li>
                            </ul>
                            
                            <p>Jangan sampai terlewat! Beli sekarang dan nikmati wahana seru dengan harga terbaik! 🎢</p>',
                'keywords' => 'promo, diskon, tiket, akhir tahun, murah',
                'category' => 'promo',
                'author_name' => 'Tim Marketing',
                'news_cover' => 'promobanner1.jpg',
                'staff_id' => $defaultStaff->id,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'title' => 'Flash Sale Weekend - Buy 1 Get 1 Tiket Wahana!',
                'description' => 'Promo flash sale setiap weekend! Beli 1 tiket wahana gratis 1 tiket untuk teman atau keluarga.',
                'content' => '<p>⚡ <strong>FLASH SALE WEEKEND!</strong> ⚡</p>
                            <p>Setiap akhir pekan, nikmati promo <strong>BUY 1 GET 1</strong> untuk tiket wahana pilihan!</p>
                            
                            <p><strong>Wahana yang Tersedia:</strong></p>
                            <ul>
                                <li>🎢 DoAndFun - Wahana roller coaster terpopuler</li>
                                <li>🎠 SpinReverse - Wahana putar dengan efek 360°</li>
                                <li>🎡 Mercus Tower - Bianglala raksasa dengan view terbaik</li>
                                <li>🌊 Atlantis Water Adventure - Wahana air keluarga</li>
                            </ul>
                            
                            <p><strong>Cara Mendapatkan:</strong></p>
                            <ol>
                                <li>Beli tiket wahana di website atau aplikasi</li>
                                <li>Otomatis mendapat 1 tiket gratis</li>
                                <li>Tunjukkan kode QR di lokasi wahana</li>
                                <li>Nikmati wahana berdua!</li>
                            </ol>
                            
                            <p>Berlaku setiap Sabtu-Minggu. Jangan sampai kehabisan! 🎯</p>',
                'keywords' => 'flash sale, buy one get one, weekend, wahana, gratis',
                'category' => 'promo',
                'author_name' => 'Tim Promosi',
                'news_cover' => 'promobanner2.jpg',
                'staff_id' => $defaultStaff->id,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'Promo Member VIP - Akses Unlimited + Benefit Eksklusif',
                'description' => 'Daftar menjadi member VIP dan nikmati akses unlimited ke semua wahana plus benefit menarik lainnya.',
                'content' => '<p>👑 <strong>PROGRAM MEMBER VIP GILIRANKU</strong> 👑</p>
                            <p>Bergabunglah dengan program member eksklusif dan rasakan pengalaman premium!</p>
                            
                            <p><strong>Benefit Member VIP:</strong></p>
                            <ul>
                                <li>🎢 Akses unlimited ke SEMUA wahana</li>
                                <li>⚡ Priority access - tanpa antrian!</li>
                                <li>🍔 Diskon 25% di semua restoran</li>
                                <li>🎁 Birthday surprise dan hadiah eksklusif</li>
                                <li>📱 Aplikasi VIP dengan fitur khusus</li>
                                <li>🏆 Poin reward yang dapat ditukar</li>
                                <li>🎪 Akses early bird untuk event spesial</li>
                            </ul>
                            
                            <p><strong>Paket Membership:</strong></p>
                            <ul>
                                <li>VIP Silver (3 bulan): Rp 999.000</li>
                                <li>VIP Gold (6 bulan): Rp 1.699.000</li>
                                <li>VIP Platinum (1 tahun): Rp 2.999.000</li>
                            </ul>
                            
                            <p>Investasi terbaik untuk hiburan sepanjang tahun! 💎</p>',
                'keywords' => 'member VIP, unlimited, priority access, benefit eksklusif',
                'category' => 'promo',
                'author_name' => 'Customer Relations',
                'news_cover' => 'promobanner3.jpg',
                'staff_id' => $defaultStaff->id,
                'created_at' => Carbon::now()->subDays(6),
                'updated_at' => Carbon::now()->subDays(6),
            ],

            // Kegiatan Seru (kategori 'kegiatan')
            [
                'title' => 'Festival Musik Elektronik "Giliranku EDM Night" - 15 Agustus 2025',
                'description' => 'Festival musik elektronik terbesar dengan DJ internasional dan light show spektakuler!',
                'content' => '<p>🎵 <strong>GILIRANKU EDM NIGHT 2025</strong> 🎵</p>
                            <p>Bersiaplah untuk malam yang tidak akan terlupakan! Festival musik elektronik terbesar tahun ini!</p>
                            
                            <p><strong>Line-up DJ Internasional:</strong></p>
                            <ul>
                                <li>🎧 DJ Marshmello - Headliner utama</li>
                                <li>🎧 DJ Calvin Harris - Special guest</li>
                                <li>🎧 DJ Local Heroes - Supporting acts</li>
                                <li>🎧 Rising Stars Competition - DJ muda berbakat</li>
                            </ul>
                            
                            <p><strong>Fasilitas Khusus:</strong></p>
                            <ul>
                                <li>🌟 Stage utama dengan sound system premium</li>
                                <li>💡 Laser light show 360° spektakuler</li>
                                <li>🍔 Food truck festival dari berbagai daerah</li>
                                <li>📱 Live streaming untuk yang tidak hadir</li>
                                <li>🎁 Merchandise eksklusif terbatas</li>
                            </ul>
                            
                            <p><strong>Detail Event:</strong></p>
                            <ul>
                                <li>📅 Tanggal: 15 Agustus 2025</li>
                                <li>⏰ Waktu: 19:00 - 02:00 WIB</li>
                                <li>📍 Lokasi: Main Stage Giliranku</li>
                                <li>🎫 Tiket: Rp 350.000 (Early Bird Rp 250.000)</li>
                            </ul>
                            
                            <p>Jangan sampai terlewat! Beli tiket sekarang sebelum kehabisan! 🔥</p>',
                'keywords' => 'festival musik, EDM, DJ, live music, malam spektakuler',
                'category' => 'kegiatan',
                'author_name' => 'Event Organizer',
                'news_cover' => 'kegiatanseru1.jpg',
                'staff_id' => $defaultStaff->id,
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(4),
            ],
            [
                'title' => 'Workshop Fotografi "Capture The Moment" bersama Fotografer Profesional',
                'description' => 'Belajar teknik fotografi profesional dengan setting taman hiburan yang menarik.',
                'content' => '<p>📸 <strong>WORKSHOP FOTOGRAFI PROFESIONAL</strong> 📸</p>
                            <p>Tingkatkan skill fotografi Anda bersama fotografer profesional di setting yang menakjubkan!</p>
                            
                            <p><strong>Materi Workshop:</strong></p>
                            <ul>
                                <li>📷 Teknik dasar komposisi dan pencahayaan</li>
                                <li>🌅 Golden hour photography di taman hiburan</li>
                                <li>🎢 Action photography untuk wahana bergerak</li>
                                <li>👨‍👩‍👧‍👦 Portrait dan group photography</li>
                                <li>📱 Mobile photography tips & tricks</li>
                                <li>✨ Editing dasar menggunakan software profesional</li>
                            </ul>
                            
                            <p><strong>Instruktur:</strong></p>
                            <ul>
                                <li>🏆 Bapak Andi Wijaya - Travel Photographer terpublikasi National Geographic</li>
                                <li>🎭 Ibu Sarah Chen - Portrait Photographer pemenang penghargaan internasional</li>
                            </ul>
                            
                            <p><strong>Yang Anda Dapatkan:</strong></p>
                            <ul>
                                <li>📚 Modul lengkap dan e-book fotografi</li>
                                <li>🎁 Merchandise eksklusif</li>
                                <li>☕ Snack dan lunch</li>
                                <li>📸 Foto profesional Anda sebagai peserta</li>
                                <li>🏅 Sertifikat workshop</li>
                                <li>👥 Akses grup eksklusif fotografer</li>
                            </ul>
                            
                            <p><strong>Pendaftaran:</strong></p>
                            <ul>
                                <li>📅 Tanggal: 22 Agustus 2025</li>
                                <li>⏰ Waktu: 08:00 - 17:00 WIB</li>
                                <li>👥 Peserta: Maksimal 20 orang</li>
                                <li>💰 Investasi: Rp 450.000</li>
                            </ul>',
                'keywords' => 'workshop fotografi, profesional, belajar, kamera, skill',
                'category' => 'kegiatan',
                'author_name' => 'Tim Edukasi',
                'news_cover' => 'kegiatanseru2.jpg',
                'staff_id' => $defaultStaff->id,
                'created_at' => Carbon::now()->subDays(8),
                'updated_at' => Carbon::now()->subDays(8),
            ],
            [
                'title' => 'Family Fun Day "Bonding Time" - Aktivitas Seru Untuk Seluruh Keluarga',
                'description' => 'Hari keluarga spesial dengan berbagai aktivitas menarik untuk mempererat hubungan keluarga.',
                'content' => '<p>👨‍👩‍👧‍👦 <strong>FAMILY FUN DAY SPECIAL</strong> 👨‍👩‍👧‍👦</p>
                            <p>Waktunya quality time bersama keluarga! Nikmati hari spesial yang dirancang khusus untuk bonding keluarga.</p>
                            
                            <p><strong>Aktivitas Seru:</strong></p>
                            <ul>
                                <li>🎨 Face painting dan body art untuk anak-anak</li>
                                <li>🎪 Pertunjukan badut dan sulap interaktif</li>
                                <li>🏃‍♂️ Family relay race dengan hadiah menarik</li>
                                <li>🍳 Cooking class keluarga - masak bersama</li>
                                <li>🎵 Karaoke family dengan lagu-lagu hit</li>
                                <li>🎯 Games tradisional dan modern</li>
                                <li>📷 Photo booth keluarga dengan props lucu</li>
                            </ul>
                            
                            <p><strong>Special Program:</strong></p>
                            <ul>
                                <li>👶 Kids zone untuk balita (0-5 tahun)</li>
                                <li>🧩 Puzzle challenge untuk remaja</li>
                                <li>💃 Dance class untuk semua umur</li>
                                <li>🎭 Mini theater dengan cerita dongeng</li>
                            </ul>
                            
                            <p><strong>Hadiah & Doorprize:</strong></p>
                            <ul>
                                <li>🏆 Juara 1 Family Competition: Paket liburan ke Bali</li>
                                <li>🥈 Juara 2: Voucher belanja Rp 2.000.000</li>
                                <li>🥉 Juara 3: Tiket tahunan Giliranku</li>
                                <li>🎁 Doorprize setiap jam: gadget dan merchandise</li>
                            </ul>
                            
                            <p><strong>Informasi:</strong></p>
                            <ul>
                                <li>📅 Tanggal: 29 Agustus 2025</li>
                                <li>⏰ Waktu: 09:00 - 18:00 WIB</li>
                                <li>💰 Tiket: Rp 100.000/keluarga (max 6 orang)</li>
                                <li>🍱 Termasuk lunch dan snack</li>
                            </ul>',
                'keywords' => 'family fun day, keluarga, bonding, aktivitas anak, quality time',
                'category' => 'kegiatan',
                'author_name' => 'Family Program Coordinator',
                'news_cover' => 'kegiatanseru3.jpg',
                'staff_id' => $defaultStaff->id,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],

            // Info Wahana (kategori 'wahana')
            [
                'title' => 'Grand Opening Wahana Terbaru "Sky Warrior" - Pengalaman Terbang Sesungguhnya!',
                'description' => 'Wahana simulasi terbang paling canggih dengan teknologi VR dan motion sensor 360 derajat.',
                'content' => '<p>🚁 <strong>GRAND OPENING: SKY WARRIOR</strong> 🚁</p>
                            <p>Rasakan sensasi terbang sesungguhnya dengan wahana paling canggih di Indonesia!</p>
                            
                            <p><strong>Teknologi Canggih:</strong></p>
                            <ul>
                                <li>🥽 Virtual Reality 8K dengan headset premium</li>
                                <li>🎮 Motion sensor 360° yang responsive</li>
                                <li>💨 Wind simulation untuk efek terbang real</li>
                                <li>🔊 Surround sound 7.1 spatial audio</li>
                                <li>⚡ Hydraulic platform dengan 12 aksis pergerakan</li>
                            </ul>
                            
                            <p><strong>Mode Penerbangan:</strong></p>
                            <ul>
                                <li>✈️ Fighter Jet - Aksi pertempuran udara</li>
                                <li>🦅 Eagle Flight - Terbang bebas di alam</li>
                                <li>🚁 Helicopter Rescue - Misi penyelamatan</li>
                                <li>🌌 Space Explorer - Perjalanan ke luar angkasa</li>
                                <li>🏔️ Mountain Rally - Terbang di pegunungan</li>
                            </ul>
                            
                            <p><strong>Spesifikasi Safety:</strong></p>
                            <ul>
                                <li>🛡️ Safety harness 5 titik premium</li>
                                <li>🚨 Emergency stop button di setiap kursi</li>
                                <li>👨‍⚕️ Medical standby trained staff</li>
                                <li>📊 Heart rate monitoring untuk keamanan</li>
                            </ul>
                            
                            <p><strong>Grand Opening Special:</strong></p>
                            <ul>
                                <li>📅 Tanggal: 10-17 Agustus 2025</li>
                                <li>💰 Harga: Rp 75.000 (normal Rp 100.000)</li>
                                <li>⏰ Duration: 15 menit per sesi</li>
                                <li>👥 Capacity: 8 orang per sesi</li>
                                <li>📏 Min. tinggi: 120cm, max: 190cm</li>
                            </ul>
                            
                            <p>Jangan lewatkan kesempatan menjadi yang pertama merasakan sensasi ini! 🌟</p>',
                'keywords' => 'wahana baru, VR, simulasi terbang, teknologi canggih, grand opening',
                'category' => 'wahana',
                'author_name' => 'Technical Director',
                'news_cover' => 'kegiatanseru4.jpg',
                'staff_id' => $defaultStaff->id,
                'created_at' => Carbon::now()->subDays(9),
                'updated_at' => Carbon::now()->subDays(9),
            ],
        ];

        // Create news entries
        foreach ($newsData as $news) {
            News::create($news);
        }
    }
}