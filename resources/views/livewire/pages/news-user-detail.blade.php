@push('styles')
@vite([
    'resources/css/jesselyn.css',
    // 'public/js/userprofile.js'
])
<style>
    /* News Card Styles */
    .news-btn {
        background: var(--bs-primary);
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .news-btn:hover {
        background: #3a9d8f;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(74, 189, 172, 0.3);
    }
    
    .news-card {
        background: var(--bs-body-bg);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--bs-body-color);
        width: 100%;
        max-width: 350px;
        height: 480px;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--bs-border-color);
    }
    
    .news-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        text-decoration: none;
        color: var(--bs-body-color);
    }
    
    [data-bs-theme="dark"] .news-card {
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
    }
    
    [data-bs-theme="dark"] .news-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
    }
    
    .news-image {
        height: 220px;
        object-fit: cover;
        width: 100%;
    }
    
    .news-content {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex: 1;
        justify-content: space-between;
    }
    
    .news-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .news-description {
        color: var(--bs-secondary-color);
        margin-bottom: 0.5rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .news-keywords {
        color: var(--bs-tertiary-color);
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    /* Styling untuk gambar didalam artikel */
    .article-content img {
        max-width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin: 1rem 0;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Styling untuk gambar yang lebih kecil */
    .article-content img.small-image {
        max-width: 50%;
        max-height: 200px;
    }
    
    /* Styling untuk gambar yang inline */
    .article-content img.inline-image {
        max-width: 300px;
        max-height: 200px;
        display: inline-block;
        margin: 0.5rem;
    }
    
    /* Responsive image handling */
    @media (max-width: 768px) {
        .article-content img {
            max-width: 100%;
            max-height: 250px;
        }
    }
    
    /* Styling untuk paragraf yang mengandung gambar */
    .article-content p {
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    
    /* Styling untuk teks artikel */
    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        /* color: #333; * Remove For Dark mode Support */ 
    }
    
    .article-content h1,
    .article-content h2,
    .article-content h3,
    .article-content h4,
    .article-content h5,
    .article-content h6 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: bolder
    }
    
    .article-content ul,
    .article-content ol {
        margin-bottom: 1rem;
        padding-left: 2rem;
    }
    
    .article-content blockquote {
        border-left: 4px solid var(--bs-primary);
        padding-left: 1rem;
        margin: 1rem 0;
        font-style: italic;
        color: var(--bs-secondary-color);
    }
    
    /* Styling untuk cover utama */
    .main-cover {
        height: 20rem;
        object-fit: cover;
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }
    
    .main-cover:hover {
        transform: scale(1.02);
    }
    
    @media (max-width: 768px) {
        .main-cover {
            height: 15rem;
        }
    }
    
    @media (max-width: 576px) {
        .main-cover {
            height: 12rem;
        }
    }
</style>
@endpush
<div class="p-5 mb-5">
    <div>
        <h1 class="card-title mt-4 text-center">{{ $news->title }}</h1>
        <p class="card-text opacity-50 mt-3 text-center">
            {{ $news->staff->name ?? 'Unknown' }} -
            {{ $news->created_at->format('d/m/Y, H:i') }} WIB
        </p>
    </div>

    <div class="d-flex align-items-center justify-content-center mt-4 mb-4">
        <img src="{{ asset('storage/' . $news->news_cover) }}" 
            class="main-cover"
            alt="{{ $news->title }}">
    </div>

    <div class="mt-5 px-xl-5 mx-xl-5 px-2 mx-2">
        <div class="mb-5 article-content">
            {!! $news->content !!}
        </div>

        <p class="card-text opacity-50  mt-5">
            Keywords: {{ $news->keywords }}
        </p>
    </div>

    <div class="mt-5 pt-5">
        <h3 class="text-center mb-4">Baca Berita Lainnya</h3>
        
        <!-- News Grid Section -->
        <div class="bg-primary py-5 rounded-top-5">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    @foreach($otherNews as $item)
                    <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                        <a href="/news-detail/{{ $item->id }}" class="news-card">
                            <img src="{{ asset('storage/' . $item->news_cover) }}" 
                                class="news-image"
                                alt="{{ $item->title }}">
                            <div class="news-content">
                                <div>
                                    <h5 class="news-title">{{ $item->title }}</h5>
                                    <p class="news-description">{{ $item->description }}</p>
                                    <p class="news-keywords">Keywords: {{ $item->keywords }}</p>
                                </div>
                                <div class="mt-auto">
                                    <span class="news-btn">Read More</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
