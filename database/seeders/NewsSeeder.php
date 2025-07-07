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
            'title' => 'Wahana A diperbaiki',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana A diperbaiki',
            'news_cover' => 'img/promobanner1.jpg',
            'staff_id' => 1,
            'content' => '<div>Ini <strong>contoh konten</strong> dari Trix Editor.<br><p>Dengan paragraf dan format HTML.</p></div>',
        ]);
        News::create([
            'title' => 'Wahana B diperbaiki',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana B diperbaiki',
            'news_cover' => 'img/promobanner2.jpg',
            'staff_id' => 2,
            'content' => '<div>Ini <strong>contoh konten</strong> dari Trix Editor.<br><p>Dengan paragraf dan format HTML.</p></div>',
        ]);
        News::create([
            'title' => 'Wahana C diperbaiki',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana C diperbaiki',
            'news_cover' => 'img/promobanner3.jpg',
            'staff_id' => 3,
            'content' => '<div>Ini <strong>contoh konten</strong> dari Trix Editor.<br><p>Dengan paragraf dan format HTML.</p></div>',
        ]);
        News::create([
            'title' => 'Wahana D diperbaiki',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana D diperbaiki',
            'news_cover' => 'img/promobanner1.jpg',
            'staff_id' => 4,
            'content' => '<div>Ini <strong>contoh konten</strong> dari Trix Editor.<br><p>Dengan paragraf dan format HTML.</p></div>',
        ]);
        News::create([
            'title' => 'Wahana E diperbaiki',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana E diperbaiki',
            'news_cover' => 'img/promobanner2.jpg',
            'staff_id' => 5,
            'content' => '<div>Ini <strong>contoh konten</strong> dari Trix Editor.<br><p>Dengan paragraf dan format HTML.</p></div>',
        ]);
        News::create([
            'title' => 'Wahana F diperbaiki',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana F diperbaiki',
            'news_cover' => 'img/promobanner3.jpg',
            'staff_id' => 6,
            'content' => '<div>Ini <strong>contoh konten</strong> dari Trix Editor.<br><p>Dengan paragraf dan format HTML.</p></div>',
        ]);
        News::create([
            'title' => 'Wahana G diperbaiki',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana G diperbaiki',
            'news_cover' => 'img/promobanner2.jpg',
            'staff_id' => 7,
            'content' => '<div>Ini <strong>contoh konten</strong> dari Trix Editor.<br><p>Dengan paragraf dan format HTML.</p></div>',
        ]);
        News::create([
            'title' => 'Wahana H diperbaiki',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, iste odit.',
            'keywords' => 'Wahana H diperbaiki',
            'news_cover' => 'img/promobanner3.jpg',
            'staff_id' => 8,
            'content' => '<div>Ini <strong>contoh konten</strong> dari Trix Editor.<br><p>Dengan paragraf dan format HTML.</p></div>',
        ]);
    }
}
