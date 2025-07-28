@push('styles')
@vite([
    'resources/css/jesselyn.css',
    // 'public/js/userprofile.js'
])
<style>
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
        border-left: 4px solid #007bff;
        padding-left: 1rem;
        margin: 1rem 0;
        font-style: italic;
        color: #666;
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

    <div class="d-flex align-items-center justify-content-center mt-3">
        <img src="{{ asset('storage/' . $news->news_cover) }}" 
            class="card-img-top rounded px-3 pt-3"
            alt="{{ $news->title }}"
            style="height: 10rem; object-fit: contain;">
    </div>

    <div class="mt-5 px-xl-5 mx-xl-5 px-2 mx-2">
        <div class="mb-5 article-content">
            {!! $news->content !!}
        </div>

        <p class="card-text opacity-50  mt-5">
            Keywords: {{ $news->keywords }}
        </p>
    </div>

    <div class="px-xl-5 mx-xl-5 px-2 mx-2 mt-5 pt-5">
        <h3 class="card-title  text-center mb-4">Baca Berita Lainnya</h3>
        <div class="d-flex justify-content-center align-items-center w-100">
            <div class="d-flex gap-5 flex-wrap align-items-center justify-content-center my-1 my-md-5">
                @foreach($otherNews as $item)
                <div>
                    <a href="/news-detail/{{ $item->id }}" class="text-decoration-none">
                        <div class="card" style="width: 22rem; height: 28rem;">
                            <img src="{{ asset('storage/' . $item->news_cover) }}" 
                                class="card-img-top rounded px-3 pt-3"
                                alt="{{ $item->title }}"
                                style="height: 10rem; object-fit: contain;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fs-3 ">{{ $item->title }}</h5>
                                    <p class="card-text ">{{ $item->description }}</p>
                                    <p class="card-text opacity-50 ">Keywords: {{ $item->keywords }}</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="/news-detail/{{ $item->id }}" class="text-decoration-none me-auto">See More</a>
                                    <a href="#" class="btn btn-secondary text-light text-decoration-none">
                                        <i class="bi bi-share-fill me-2"></i>
                                        Share
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
