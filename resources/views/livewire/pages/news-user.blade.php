<div>
    <div class="d-flex flex-md-row flex-column gap-md-5 gap-4 justify-content-center align-items-center my-5">
        <h1 class="large-font-title p-3">NEWS</h1>
        <div class="p-4">
            <h3>Newsletter</h3>
            <p>Pengguna dapat subscribe ke newsletter dufan untuk mendapatkan info terkini!</p>
            <button type="button" class="btn btn-secondary text-light">Subscribe</button>
        </div>
    </div>
    <div class="bg-warning p-5 rounded-top-5 w-100">
        <div class="d-flex justify-content-center align-items-center w-100">
            <div class="d-flex gap-md-6 gap-4 flex-wrap align-items-center justify-content-center my-1 my-md-5"> 
                @foreach ($news as $item)
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
                                <div class="d-flex justify-content-between text-decoration-none align-items-center mt-3">
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
