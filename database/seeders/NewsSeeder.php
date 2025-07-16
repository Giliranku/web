<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            'title' => 'Kenapa Harus ke Ancol?',
            'author_name' => 'Jesselyn',
            'description' => 'Jakarta menyimpan permata wisata yang tak lekang oleh waktu.',
            'keywords' => 'Ancol, Pantai Ancol, Jakarta',
            'news_cover' => 'img/info1.jpg',
            'staff_id' => 1,
            'content' => '
                <div>
                    <p><strong>Jakarta, [6 April 2005] –</strong> Jakarta mungkin identik dengan gedung-gedung pencakar langit dan kemacetan, namun siapa sangka ibu kota juga menyimpan permata wisata yang tak lekang oleh waktu: Taman Impian Jaya Ancol. Lebih dari sekadar destinasi rekreasi, Ancol telah menjelma menjadi sebuah resort terintegrasi yang menawarkan pengalaman liburan lengkap untuk semua kalangan. Jadi, kenapa harus ke Ancol? Berikut adalah beberapa alasannya.</p>

                    <h3>Ragam Wahana dan Atraksi Kelas Dunia</h3>
                    <p>Ancol bukan hanya tentang satu atau dua wahana, melainkan sebuah kompleks raksasa yang menyajikan berbagai pilihan hiburan. Mulai dari keseruan di Dunia Fantasi (Dufan) dengan wahana-wahana yang memacu adrenalin hingga petualangan bawah laut di Sea World Ancol yang memukau. Jangan lupakan juga kesegaran di Atlantis Water Adventures yang siap mengusir gerah Jakarta. Bagi pecinta seni dan edukasi, Fauna Land dan Ocean Dream Samudra menawarkan interaksi menarik dengan satwa dan pertunjukan edukatif yang menghibur. Pilihan yang beragam ini memastikan setiap anggota keluarga menemukan hiburan favoritnya.</p>

                    <h3>Fasilitas Lengkap dan Nyaman</h3>
                    <p>Ancol dirancang untuk kenyamanan pengunjung. Selain area parkir yang luas, Anda akan menemukan berbagai fasilitas penunjang seperti restoran dengan pilihan kuliner beragam, toko suvenir, mushola, klinik P3K, hingga area istirahat yang nyaman. Kebersihan dan keamanan juga menjadi prioritas utama, memberikan ketenangan bagi pengunjung selama berlibur.</p>

                    <h3>Akses Mudah dan Lokasi Strategis</h3>
                    <p>Terletak di pesisir utara Jakarta, Ancol sangat mudah diakses dari berbagai penjuru kota. Baik menggunakan kendaraan pribadi, transportasi umum seperti TransJakarta, atau bahkan KRL, Anda dapat mencapai Ancol dengan relatif mudah. Lokasinya yang strategis ini menjadikannya pilihan ideal untuk liburan singkat maupun panjang tanpa perlu bepergian jauh ke luar kota.</p>

                    <h3>Pemandangan Pantai yang Menenangkan</h3>
                    <p>Selain wahana dan atraksi, Ancol juga menawarkan keindahan alam berupa pantai yang menenangkan. Anda bisa menikmati indahnya sunset di bibir pantai, bersantai di tepi laut, atau mencoba berbagai aktivitas air seperti banana boat. Area pantai yang luas juga sering menjadi lokasi favorit untuk piknik keluarga atau sekadar berjalan-jalan santai menikmati semilir angin laut.</p>

                    <p>Ancol tak pernah berhenti berinovasi. Pengelola terus berupaya menghadirkan wahana dan atraksi baru, serta meningkatkan fasilitas yang ada. Hal ini memastikan setiap kunjungan Anda ke Ancol akan selalu menawarkan pengalaman yang segar dan berbeda. Berbagai acara dan festival tematik juga sering diselenggarakan, menambah daya tarik Ancol sebagai pusat hiburan.</p>

                    <p>Dengan semua keunggulan yang ditawarkan, tak heran jika Ancol tetap menjadi primadona destinasi wisata keluarga di Jakarta. Jadi, jika Anda mencari tempat liburan yang lengkap, mudah dijangkau, dan selalu menawarkan keseruan, Ancol adalah jawabannya.</p>
                </div>
            ',
        ]);
        News::create([
            'title' => 'Wahana Arung Jeram diperbaiki',
            'author_name' => 'Jesselyn',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana arung jeram diperbaiki',
            'news_cover' => 'img/arung-jeram.jpg',
            'staff_id' => 2,
            'content' => '
                <div>
                    <p><strong>Perbaikan Wahana B di Ancol</strong></p>
                    <p>Untuk meningkatkan keamanan dan kenyamanan pengunjung, Wahana B sedang menjalani proses perbaikan berkala. Selama proses ini, beberapa bagian wahana akan ditutup sementara.</p>

                    <h3>Kenapa Wahana B Ditutup?</h3>
                    <p>Setiap wahana di Ancol rutin diperiksa oleh tim teknis. Jika ditemukan bagian yang memerlukan pembaruan atau penggantian komponen, maka perbaikan segera dilakukan demi keselamatan bersama.</p>

                    <h3>Kapan Akan Dibuka Kembali?</h3>
                    <p>Manajemen Ancol menargetkan perbaikan selesai dalam waktu 2 minggu. Kami akan memberikan update melalui media sosial resmi Ancol.</p>

                    <p>Terima kasih atas pengertian para pengunjung. Kami selalu berkomitmen memberikan pengalaman terbaik dan aman di setiap wahana.</p>
                </div>
            ',
        ]);
        News::create([
            'title' => 'Wahana Bianglala diperbaiki',
            'author_name' => 'Jesselyn',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana bianglala diperbaiki',
            'news_cover' => 'img/bianglala.jpg',
            'staff_id' => 3,
            'content' => '
                <div>
                    <p><strong>Update Terkini Wahana C</strong></p>
                    <p>Wahana C di Ancol merupakan salah satu wahana favorit keluarga. Saat ini, wahana tersebut sedang dalam tahap perawatan rutin untuk memastikan seluruh fasilitas tetap berfungsi dengan baik.</p>

                    <h3>Perawatan Berkala</h3>
                    <p>Perawatan meliputi pengecekan mesin, pengecatan ulang, dan pengetesan keamanan jalur wahana. Semua proses dilakukan oleh teknisi bersertifikat.</p>

                    <h3>Alternatif Wahana Lain</h3>
                    <p>Selama Wahana C ditutup sementara, pengunjung dapat menikmati berbagai atraksi seru lainnya di Dufan, Sea World, maupun Atlantis.</p>

                    <p>Kami mohon maaf atas ketidaknyamanan ini. Kami berharap Wahana C dapat segera dinikmati kembali dengan kondisi yang lebih baik.</p>
                </div>
            ',
        ]);
        News::create([
            'title' => 'Kenapa harus ke Ancol??',
            'author_name' => 'Jesselyn',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Ancol, Pantai Ancol, Jakarta',
            'news_cover' => 'img/promobanner1.jpg',
            'staff_id' => 4,
            'content' => '
                <div>
                    <p><strong>Jakarta, [6 April 2005] –</strong> Jakarta mungkin identik dengan gedung-gedung pencakar langit dan kemacetan, namun siapa sangka ibu kota juga menyimpan permata wisata yang tak lekang oleh waktu: Taman Impian Jaya Ancol. Lebih dari sekadar destinasi rekreasi, Ancol telah menjelma menjadi sebuah resort terintegrasi yang menawarkan pengalaman liburan lengkap untuk semua kalangan. Jadi, kenapa harus ke Ancol? Berikut adalah beberapa alasannya.</p>

                    <h3>Ragam Wahana dan Atraksi Kelas Dunia</h3>
                    <p>Ancol bukan hanya tentang satu atau dua wahana, melainkan sebuah kompleks raksasa yang menyajikan berbagai pilihan hiburan. Mulai dari keseruan di Dunia Fantasi (Dufan) dengan wahana-wahana yang memacu adrenalin hingga petualangan bawah laut di Sea World Ancol yang memukau. Jangan lupakan juga kesegaran di Atlantis Water Adventures yang siap mengusir gerah Jakarta. Bagi pecinta seni dan edukasi, Fauna Land dan Ocean Dream Samudra menawarkan interaksi menarik dengan satwa dan pertunjukan edukatif yang menghibur. Pilihan yang beragam ini memastikan setiap anggota keluarga menemukan hiburan favoritnya.</p>

                    <h3>Fasilitas Lengkap dan Nyaman</h3>
                    <p>Ancol dirancang untuk kenyamanan pengunjung. Selain area parkir yang luas, Anda akan menemukan berbagai fasilitas penunjang seperti restoran dengan pilihan kuliner beragam, toko suvenir, mushola, klinik P3K, hingga area istirahat yang nyaman. Kebersihan dan keamanan juga menjadi prioritas utama, memberikan ketenangan bagi pengunjung selama berlibur.</p>

                    <h3>Akses Mudah dan Lokasi Strategis</h3>
                    <p>Terletak di pesisir utara Jakarta, Ancol sangat mudah diakses dari berbagai penjuru kota. Baik menggunakan kendaraan pribadi, transportasi umum seperti TransJakarta, atau bahkan KRL, Anda dapat mencapai Ancol dengan relatif mudah. Lokasinya yang strategis ini menjadikannya pilihan ideal untuk liburan singkat maupun panjang tanpa perlu bepergian jauh ke luar kota.</p>

                    <h3>Pemandangan Pantai yang Menenangkan</h3>
                    <p>Selain wahana dan atraksi, Ancol juga menawarkan keindahan alam berupa pantai yang menenangkan. Anda bisa menikmati indahnya sunset di bibir pantai, bersantai di tepi laut, atau mencoba berbagai aktivitas air seperti banana boat. Area pantai yang luas juga sering menjadi lokasi favorit untuk piknik keluarga atau sekadar berjalan-jalan santai menikmati semilir angin laut.</p>

                    <p>Ancol tak pernah berhenti berinovasi. Pengelola terus berupaya menghadirkan wahana dan atraksi baru, serta meningkatkan fasilitas yang ada. Hal ini memastikan setiap kunjungan Anda ke Ancol akan selalu menawarkan pengalaman yang segar dan berbeda. Berbagai acara dan festival tematik juga sering diselenggarakan, menambah daya tarik Ancol sebagai pusat hiburan.</p>

                    <p>Dengan semua keunggulan yang ditawarkan, tak heran jika Ancol tetap menjadi primadona destinasi wisata keluarga di Jakarta. Jadi, jika Anda mencari tempat liburan yang lengkap, mudah dijangkau, dan selalu menawarkan keseruan, Ancol adalah jawabannya.</p>
                </div>
            ',
        ]);
        News::create([
            'title' => 'Wahana Arung Jeram diperbaiki!',
            'author_name' => 'Jesselyn',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana arung jeram diperbaiki',
            'news_cover' => 'img/arung-jeram.jpg',
            'staff_id' => 5,
            'content' => '
                <div>
                    <p><strong>Perbaikan Wahana B di Ancol</strong></p>
                    <p>Untuk meningkatkan keamanan dan kenyamanan pengunjung, Wahana B sedang menjalani proses perbaikan berkala. Selama proses ini, beberapa bagian wahana akan ditutup sementara.</p>

                    <h3>Kenapa Wahana B Ditutup?</h3>
                    <p>Setiap wahana di Ancol rutin diperiksa oleh tim teknis. Jika ditemukan bagian yang memerlukan pembaruan atau penggantian komponen, maka perbaikan segera dilakukan demi keselamatan bersama.</p>

                    <h3>Kapan Akan Dibuka Kembali?</h3>
                    <p>Manajemen Ancol menargetkan perbaikan selesai dalam waktu 2 minggu. Kami akan memberikan update melalui media sosial resmi Ancol.</p>

                    <p>Terima kasih atas pengertian para pengunjung. Kami selalu berkomitmen memberikan pengalaman terbaik dan aman di setiap wahana.</p>
                </div>
            ',
        ]);
        News::create([
            'title' => 'Wahana Bianglala diperbaiki!',
            'author_name' => 'Jesselyn',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana bianglala diperbaiki',
            'news_cover' => 'img/bianglala.jpg',
            'staff_id' => 6,
            'content' => '
                <div>
                    <p><strong>Update Terkini Wahana C</strong></p>
                    <p>Wahana C di Ancol merupakan salah satu wahana favorit keluarga. Saat ini, wahana tersebut sedang dalam tahap perawatan rutin untuk memastikan seluruh fasilitas tetap berfungsi dengan baik.</p>

                    <h3>Perawatan Berkala</h3>
                    <p>Perawatan meliputi pengecekan mesin, pengecatan ulang, dan pengetesan keamanan jalur wahana. Semua proses dilakukan oleh teknisi bersertifikat.</p>

                    <h3>Alternatif Wahana Lain</h3>
                    <p>Selama Wahana C ditutup sementara, pengunjung dapat menikmati berbagai atraksi seru lainnya di Dufan, Sea World, maupun Atlantis.</p>

                    <p>Kami mohon maaf atas ketidaknyamanan ini. Kami berharap Wahana C dapat segera dinikmati kembali dengan kondisi yang lebih baik.</p>
                </div>
            ',
        ]);
        News::create([
            'title' => 'Wahana Arung Jeram diperbaiki?',
            'author_name' => 'Jesselyn',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana arung jeram diperbaiki',
            'news_cover' => 'img/arung-jeram.jpg',
            'staff_id' => 7,
            'content' => '
                <div>
                    <p><strong>Perbaikan Wahana B di Ancol</strong></p>
                    <p>Untuk meningkatkan keamanan dan kenyamanan pengunjung, Wahana B sedang menjalani proses perbaikan berkala. Selama proses ini, beberapa bagian wahana akan ditutup sementara.</p>

                    <h3>Kenapa Wahana B Ditutup?</h3>
                    <p>Setiap wahana di Ancol rutin diperiksa oleh tim teknis. Jika ditemukan bagian yang memerlukan pembaruan atau penggantian komponen, maka perbaikan segera dilakukan demi keselamatan bersama.</p>

                    <h3>Kapan Akan Dibuka Kembali?</h3>
                    <p>Manajemen Ancol menargetkan perbaikan selesai dalam waktu 2 minggu. Kami akan memberikan update melalui media sosial resmi Ancol.</p>

                    <p>Terima kasih atas pengertian para pengunjung. Kami selalu berkomitmen memberikan pengalaman terbaik dan aman di setiap wahana.</p>
                </div>
            ',
        ]);
        News::create([
            'title' => 'Wahana Bianglala diperbaiki?',
            'author_name' => 'Jesselyn',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana bianglala diperbaiki',
            'news_cover' => 'img/bianglala.jpg',
            'staff_id' => 8,
            'content' => '
                <div>
                    <p><strong>Update Terkini Wahana C</strong></p>
                    <p>Wahana C di Ancol merupakan salah satu wahana favorit keluarga. Saat ini, wahana tersebut sedang dalam tahap perawatan rutin untuk memastikan seluruh fasilitas tetap berfungsi dengan baik.</p>

                    <h3>Perawatan Berkala</h3>
                    <p>Perawatan meliputi pengecekan mesin, pengecatan ulang, dan pengetesan keamanan jalur wahana. Semua proses dilakukan oleh teknisi bersertifikat.</p>

                    <h3>Alternatif Wahana Lain</h3>
                    <p>Selama Wahana C ditutup sementara, pengunjung dapat menikmati berbagai atraksi seru lainnya di Dufan, Sea World, maupun Atlantis.</p>

                    <p>Kami mohon maaf atas ketidaknyamanan ini. Kami berharap Wahana C dapat segera dinikmati kembali dengan kondisi yang lebih baik.</p>
                </div>
            ',
        ]);
    }
}
