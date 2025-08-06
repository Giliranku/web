
@push('styles')
@vite([
    'resources/css/queue-detail.css',
    'resources/css/wahana-detail.css',
])
@endpush
<div class="container py-4">
    <div x-data="{ mainImage: @entangle('mainImage'), fade: false }">
        <div class="row">
            <!-- Main Image -->
            <div class="{{ count($images) > 1 ? 'col-lg-7' : 'col-12' }} col-md-12 mb-3">
                <div class="main-image-container">
                    <img 
                        :src="mainImage" 
                        class="img-fluid rounded shadow w-100 transition" 
                        :class="{ 'opacity-0': fade }"
                        @load="fade = false"
                        style="height: 637px; object-fit: cover; transition: opacity 0.5s ease;" 
                        alt="Main Image"
                        x-init="$watch('mainImage', () => { fade = true; setTimeout(() => fade = false, 100); })"
                    >
                </div>
            </div>

            <!-- Thumbnails - Only show if more than 1 image -->
            @if(count($images) > 1)
                <div class="col-lg-5 col-md-12 mb-3">
                    <div class="thumbnail-container">
                        <!-- Desktop: Vertical layout -->
                        <div class="d-none d-lg-block">
                            @foreach($images as $index => $image)
                                <img 
                                    src="{{ $image }}" 
                                    class="img-thumbnail cursor-pointer w-100 custom-thumb mb-3" 
                                    @click="mainImage = '{{ $image }}'"
                                    :class="{ 'border border-3 border-primary': mainImage === '{{ $image }}' }"
                                    style="
                                        @if(count($images) == 2)
                                            height: 200px;
                                        @else
                                            height: 160px;
                                        @endif
                                        object-fit: cover;
                                        transition: all 0.3s ease;
                                    "
                                    alt="Thumbnail {{ $index + 1 }}"
                                >
                            @endforeach
                        </div>
                        
                        <!-- Mobile: Horizontal scrollable layout -->
                        <div class="d-lg-none d-flex gap-3 overflow-auto pb-2" style="scroll-snap-type: x mandatory;">
                            @foreach($images as $index => $image)
                                <img 
                                    src="{{ $image }}" 
                                    class="img-thumbnail cursor-pointer flex-shrink-0 custom-thumb" 
                                    @click="mainImage = '{{ $image }}'"
                                    :class="{ 'border border-3 border-primary': mainImage === '{{ $image }}' }"
                                    style="
                                        width: 120px;
                                        height: 80px;
                                        object-fit: cover;
                                        transition: all 0.3s ease;
                                        scroll-snap-align: start;
                                    "
                                    alt="Thumbnail {{ $index + 1 }}"
                                >
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

    <div class="mt-4">
        <!-- Header dengan Title dan Button -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5 gap-3">
            <div class="flex-grow-1">
                <h1 class="header-title">{{ $item->name }}</h1>
                <span class="badge type-badge">
                    <i class="fas fa-tag me-1"></i>{{ $this->getTypeName() }}
                </span>
            </div>
            <div class="flex-shrink-0">
                <button 
                    wire:click="orderQueue"
                    wire:loading.attr="disabled"
                    class="btn btn-light text-dark fw-bold px-4 py-2 w-100 w-md-auto border shadow-sm"
                    style="min-width: 200px; background-color: white; color: #333; border-color: #ddd;"
                >
                    <span wire:loading.remove>{{ $this->getButtonText() }}</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Memproses...
                    </span>
                </button>
            </div>
        </div>
        
        <!-- Informasi Detail -->
        <div class="row g-4 mb-5">
            <div class="col-12 col-md-4">
                <div class="info-item h-100">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-users text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="flex-grow-1">
                            <small class="text-muted d-block mb-1">Kapasitas Saat Ini</small>
                            <strong class="fs-5">{{ $currentCapacity }}/{{ $item->capacity }} orang</strong>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar" role="progressbar" 
                                     style="width: {{ ($currentCapacity / $item->capacity) * 100 }}%"
                                     aria-valuenow="{{ $currentCapacity }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="{{ $item->capacity }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($item->time_estimation)
                <div class="col-12 col-md-4">
                    <div class="info-item h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-clock text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1">Estimasi Waktu</small>
                                <strong class="fs-5">{{ $item->time_estimation }} menit</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12 col-md-4">
                <div class="info-item h-100">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-user-tie text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block mb-1">Dikelola oleh</small>
                            <strong class="fs-5">{{ $this->getStaffInfo() }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-5">
            <h3 class="section-header">Deskripsi</h3>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <p class="mb-0 text-justify" style="line-height: 1.7; font-size: 1.1rem;">{{ $item->description }}</p>
                </div>
            </div>
        </div>

        <!-- Lokasi -->
        <div class="mb-5">
            <h3 class="section-header">Lokasi</h3>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt text-danger me-3" style="font-size: 1.5rem;"></i>
                        <p class="mb-0" style="font-size: 1.1rem; font-weight: 500;">{{ $item->location }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>