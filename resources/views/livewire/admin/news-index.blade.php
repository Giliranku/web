@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .news-card {
            transition: all 0.3s ease;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
        }
        
        .news-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #007bff;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .news-card:hover::before {
            transform: scaleX(1);
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        
        .news-image {
            width: 120px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .news-image:hover {
            transform: scale(1.05);
        }
        
        .news-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }
        
        .news-description {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 0.5rem;
        }
        
        .news-meta {
            font-size: 0.8rem;
            color: #868e96;
        }
        
        .news-author {
            color: #007bff;
            font-weight: 600;
        }
        
        .news-date {
            color: #28a745;
        }
        
        .news-keywords {
            background: #e9ecef;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.75rem;
            color: #495057;
            margin-right: 0.5rem;
            display: inline-block;
        }
        
        .btn-action {
            transition: all 0.3s ease;
            border-radius: 10px;
            border: none;
            padding: 0.6rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .btn-warning {
            background: #ffc107;
            color: #212529;
        }
        
        .btn-warning:hover {
            background: #e0a800;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .add-news-btn {
            transition: all 0.3s ease;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            background: #007bff;
            border: none;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }
        
        .add-news-btn:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
        }
        
        .header-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .search-container {
            border-radius: 12px;
            border: 1px solid #e9ecef;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .search-container:hover {
            border-color: #007bff;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.1);
        }
        
        .custom-input-sort {
            border-radius: 12px;
            border: 1px solid #e9ecef;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .custom-input-sort:hover {
            border-color: #007bff;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.1);
        }
        
        .vertical-line-admin {
            background: #007bff;
            border-radius: 2px;
        }
        
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .news-card {
            animation: fadeInUp 0.5s ease forwards;
        }
        
        .news-card:nth-child(1) { animation-delay: 0.1s; }
        .news-card:nth-child(2) { animation-delay: 0.15s; }
        .news-card:nth-child(3) { animation-delay: 0.2s; }
        .news-card:nth-child(4) { animation-delay: 0.25s; }
        .news-card:nth-child(5) { animation-delay: 0.3s; }
    </style>
@endpush

<div class="p-5">
    {{-- Search + Filter --}}
    <div class="d-flex gap-sm-5 flex-sm-row flex-column gap-1 mb-4">
        <div class="search-container shadow search-bar-sorting border rounded">
            <i class="bi bi-search search-icon"></i>
            <input type="text"
                   class="form-control search-input height-custom"
                   placeholder="Cari judul..."
                   wire:model.debounce.500ms="search">
        </div>

        {{-- Dropdown Sort --}}
        <div
    x-data="{
        open: false,
        selected: $wire.entangle('filterType'),
        options: {
            'none': 'Semua',
            'created_at_desc': 'Terbaru',
            'created_at_asc': 'Terlama'
        },
        select(option) {
            this.selected = option;
            $wire.set('filterType', option);
            this.open = false;
        }
    }"
    class="position-relative shadow border rounded bg-body-secondary custom-input-sort flex-grow-1 flex-md-grow-0 height-custom"
    @click.outside="open = false">

    <div class="dropdown-label">Urutkan Dari</div>

    <div class="custom-dropdown" @click="open = !open">
        <span x-text="options[selected]" style="font-size: 1rem;"></span>
        <i class="bi bi-chevron-down dropdown-icon"></i>
    </div>

    <div class="dropdown-list bg-body-secondary" x-show="open" x-transition>
        <template x-for="[value, label] in Object.entries(options)" :key="value">
            <div class="dropdown-item"
                 @click="select(value)"
                 x-text="label"></div>
        </template>
    </div>
</div>

    </div>

    {{-- Header --}}
    <div class="header-card card w-100 shadow p-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-sm-row flex-column">
            <div class="d-flex align-items-center">
                <div class="vertical-line-admin"></div>
                <h3 class="card-title ms-2 mb-0">Daftar Berita</h3>
            </div>
            <div>
                <a href="{{ route('admin.news.create') }}" class="text-decoration-none btn add-news-btn mt-sm-0 mt-2">
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambahkan
                </a>
            </div>
        </div>
    </div>

    {{-- List of News --}}
    <div class="d-flex flex-column gap-4">
        @forelse ($newsList as $news)
            <div class="news-card card w-100 shadow p-4">
                <div class="card-body d-flex align-items-start justify-content-between flex-sm-row flex-column">
                    <div class="d-flex align-items-start flex-sm-row flex-column text-center text-sm-start">
                        <img src="{{ asset('storage/' . $news->news_cover) }}"
                             alt="{{ $news->title }}"
                             class="news-image">
                        <div class="ms-sm-4 mt-sm-0 mt-3 flex-grow-1">
                            <h5 class="news-title">{{ $news->title }}</h5>
                            <p class="news-description">
                                {{ Str::limit($news->description, 100) }}
                            </p>
                            
                            {{-- Author and Date --}}
                            <div class="news-meta d-flex flex-wrap align-items-center gap-3 mb-2">
                                <span class="news-author">
                                    <i class="bi bi-person-fill me-1"></i>
                                    {{ $news->author_name }}
                                </span>
                                <span class="news-date">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $news->created_at->format('d M Y') }}
                                </span>
                            </div>
                            
                            {{-- Keywords --}}
                            @if($news->keywords)
                                <div class="keywords-container">
                                    @foreach(explode(',', $news->keywords) as $keyword)
                                        <span class="news-keywords">{{ trim($keyword) }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex flex-sm-column flex-row gap-2 mt-sm-0 mt-3">
                        <a href="{{ route('admin.news.edit', ['news' => $news->id]) }}" class="btn btn-warning btn-action">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <button class="btn btn-secondary btn-action" data-bs-toggle="modal"
                                data-bs-target="#deleteModal-{{ $news->id }}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Modal Delete Confirmation --}}
            <div class="modal fade" id="deleteModal-{{ $news->id }}" tabindex="-1"
                 aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4">
                        <div class="modal-body text-center p-5">
                            <button type="button"
                                    class="btn position-absolute top-0 end-0 m-3 p-0"
                                    data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i class="bi bi-x-lg fs-5"></i>
                            </button>
                            <p class="mb-1">Apakah Anda yakin akan menghapus</p>
                            <h5 class="fw-bold mb-5 mt-2">"{{ $news->title }}"</h5>
                            <div class="d-flex justify-content-center gap-4">
                                <button wire:click="delete({{ $news->id }})"
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-dismiss="modal">Ya, saya yakin</button>
                                <button type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted mt-5">
                <i class="bi bi-exclamation-circle"></i> Tidak ada berita ditemukan.
            </div>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    @if($newsList->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="News pagination">
                {{ $newsList->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    @endif
</div>
