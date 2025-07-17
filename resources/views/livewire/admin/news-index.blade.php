@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
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
    class="position-relative shadow border rounded bg-light custom-input-sort flex-grow-1 flex-md-grow-0 height-custom"
    @click.outside="open = false">

    <div class="dropdown-label">Urutkan Dari</div>

    <div class="custom-dropdown" @click="open = !open">
        <span x-text="options[selected]" style="font-size: 1rem;"></span>
        <i class="bi bi-chevron-down dropdown-icon"></i>
    </div>

    <div class="dropdown-list bg-light dark:text-dark" x-show="open" x-transition>
        <template x-for="[value, label] in Object.entries(options)" :key="value">
            <div class="dropdown-item"
                 @click="select(value)"
                 x-text="label"></div>
        </template>
    </div>
</div>

    </div>

    {{-- Header --}}
    <div class="card w-100 shadow p-3 bg-body-tertiary rounded mb-3">
        <div class="d-flex align-items-center justify-content-between flex-sm-row flex-column">
            <div class="d-flex align-items-center">
                <div class="vertical-line-admin"></div>
                <h3 class="card-title ms-2">Daftar Berita</h3>
            </div>
            <div>
                <a href="{{ route('news.create') }}" class="text-decoration-none btn btn-primary mt-sm-0 mt-2">
                    Tambahkan <i class="bi bi-plus-circle ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- List of News --}}
    <div class="d-flex flex-column gap-3">
        @forelse ($newsList as $news)
            <div class="card w-100 shadow p-3 bg-body-tertiary rounded">
                <div class="card-body d-flex align-items-center justify-content-between flex-sm-row flex-column">
                    <div class="d-flex align-items-center flex-sm-row flex-column text-center text-sm-start">
                        <img src="{{ asset('storage/' . $news->news_cover) }}"
                             alt="{{ $news->title }}"
                             style="width: 80px; height: 80px; object-fit: contain;">
                        <h5 class="card-title ms-sm-4 mt-sm-0 mt-3">{{ $news->title }}</h5>
                    </div>
                    <div class="d-flex flex-sm-column flex-row gap-3 mt-sm-0 mt-2">
                        <a href="{{ route('news.edit', ['news' => $news->id]) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <button class="btn btn-secondary" data-bs-toggle="modal"
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
</div>
