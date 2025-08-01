@push('styles')
@vite([
    'resources/css/jesselyn.css',
    // 'public/js/userprofile.js'
])
<style>
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
    
    .newsletter-section {
        background: linear-gradient(135deg, var(--bs-light) 0%, var(--bs-gray-200) 100%);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        max-width: 400px;
    }
    
    .newsletter-section h3 {
        color: var(--bs-heading-color);
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .newsletter-section p {
        color: var(--bs-secondary-color);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }
</style>
@endpush
<div>
    <!-- Header Section -->
    <div class="container my-5">
        <div class="row align-items-center justify-content-start g-4">
            <div class="col-md-6">
                <h1 class="large-font-title mb-0">NEWS</h1>
            </div>
        </div>
    </div>

    <!-- News Grid Section -->
    <div class="bg-primary py-5 rounded-top-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @foreach ($news as $item)
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
