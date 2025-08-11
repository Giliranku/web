<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\News;

class NewsModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_label_accessor()
    {
        $news = News::create([
            'title' => 'Hello',
            'description' => 'Desc',
            'keywords' => 'promo',
            'category' => 'promo',
        ]);

        $this->assertEquals('Promo Spesial', $news->category_label);
    }

    public function test_cover_url_fallback_when_missing()
    {
        $news = News::create([
            'title' => 'Hello',
            'description' => 'Desc',
            'category' => 'info',
            'keywords' => null,
            'news_cover' => null,
        ]);

        $this->assertStringContainsString('img/default-placeholder.svg', $news->image_url);
        $this->assertSame($news->getCoverUrl(), $news->image_url);
    }
}
