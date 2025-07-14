@vite([
    'resources/sass/app.scss',
    'resources/js/app.js',
    'resources/css/main.css',
    'resources/css/jesselyn.css',
    // 'public/js/userprofile.js'
])
<div class="p-5 mb-5">
    <div>
        <h1 class="card-title mt-4 text-center">{{ $news->title }}</h1>
        <p class="card-text opacity-50 mt-3 text-center">
            {{ $news->staff->name ?? 'Unknown' }} -
            {{ $news->created_at->format('d/m/Y, H:i') }} WIB
        </p>
    </div>

    <div class="d-flex align-items-center justify-content-center mt-3">
        <img src="{{ asset($news->news_cover) }}"
             class="card-img-top rounded px-3 pt-3 w-news-detail"
             alt="{{ $news->title }}">
    </div>

    <div class="mt-5 px-xl-5 mx-xl-5 px-2 mx-2">
        <div class="mb-5">
            {!! $news->content !!}
        </div>

        <p class="card-text opacity-50 text-dark mt-5">
            Keywords: {{ $news->keywords }}
        </p>
    </div>

    <div class="px-xl-5 mx-xl-5 px-2 mx-2 mt-5 pt-5">
        <h3 class="card-title text-dark text-center mb-4">Baca Berita Lainnya</h3>
        <div class="d-flex justify-content-center align-items-center w-100">
            <div class="d-flex gap-5 flex-wrap align-items-center justify-content-center my-1 my-md-5">
                @foreach($otherNews as $item)
                <div>
                    <a href="/news-detail/{{ $item->id }}" class="text-decoration-none">
                        <div class="card" style="width: 22rem; height: 28rem;">
                            <img src="{{ asset($item->news_cover) }}"
                                class="card-img-top rounded px-3 pt-3"
                                alt="{{ $item->title }}"
                                style="height: 10rem;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title fs-3 text-dark">{{ $item->title }}</h5>
                                    <p class="card-text text-dark">{{ $item->description }}</p>
                                    <p class="card-text opacity-50 text-dark">Keywords: {{ $item->keywords }}</p>
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
