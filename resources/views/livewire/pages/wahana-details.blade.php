
@push('styles')
@vite([
    'resources/css/queue-detail.css',
])
<style>
    .custom-thumb {
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 8px;
    }
    
    .custom-thumb:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .text-justify {
        text-align: justify;
    }
    
    .card {
        border-radius: 10px;
    }
    
    .btn {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    /* Header styling */
    .header-title {
        font-size: 2.2rem;
        font-weight: 700;
        /* color: #2c3e50; */
        margin-bottom: 0.75rem;
        line-height: 1.2;
    }
    
    .type-badge {
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 20px !important;
        padding: 8px 16px !important;
        border: 1px solid rgba(13, 110, 253, 0.2);
    }
    
    /* Main image container */
    .main-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
    }
    
    /* Responsive adjustments for single image */
    @media (max-width: 991.98px) {
        .single-image {
            margin: 0 auto;
        }
    }
    
    /* Thumbnail container styling */
    .thumbnail-container {
        max-height: 637px;
        overflow: hidden; /* Hide overflow completely */
        padding: 8px; /* Add padding for better spacing */
    }
    
    /* Remove all scrollbar styling */
    .thumbnail-container::-webkit-scrollbar {
        display: none;
    }
    
    /* For Firefox - hide scrollbar completely */
    .thumbnail-container {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
</style>
@endpush
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb rounded p-3">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" wire:navigate class="text-decoration-none text-primary">
                    <i class="fas fa-home me-1"></i>Beranda
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('queues.index') }}" wire:navigate class="text-decoration-none text-primary">
                    {{ $this->getTypeName() }}
                </a>
            </li>
            <li class="breadcrumb-item active " aria-current="page">
                <strong>{{ $item->name }}</strong>
            </li>
        </ol>
    </nav>    <div x-data="{ mainImage: @entangle('mainImage'), fade: false }">
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
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div class="flex-grow-1">
                <h2 class="header-title">{{ $item->name }}</h2>
                <span class="badge bg-primary bg-opacity-10 text-primary type-badge">
                    <i class="fas fa-tag me-1"></i>{{ $this->getTypeName() }}
                </span>
            </div>
            <div class="flex-shrink-0">
                <button 
                    wire:click="orderQueue"
                    wire:loading.attr="disabled"
                    class="btn {{ $this->getButtonClass() }} text-white fw-bold px-4 py-2 w-100 w-md-auto"
                    style="min-width: 200px;"
                >
                    <span wire:loading.remove>{{ $this->getButtonText() }}</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Memproses...
                    </span>
                </button>
            </div>
        </div>
        
        <!-- Informasi Detail dalam Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users me-2 text-primary"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block">Kapasitas</small>
                                <strong>{{ $currentCapacity }}/{{ $item->capacity }}</strong>
                                <div class="progress mt-1" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" 
                                         style="width: {{ ($currentCapacity / $item->capacity) * 100 }}%"
                                         aria-valuenow="{{ $currentCapacity }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="{{ $item->capacity }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($item->time_estimation)
                        <div class="col-12 col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock me-2 text-warning"></i>
                                <div>
                                    <small class="text-muted d-block">Estimasi Waktu</small>
                                    <strong>{{ $item->time_estimation }} menit</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-12 col-md-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-tie me-2 text-success"></i>
                            <div>
                                <small class="text-muted d-block">Dikelola oleh</small>
                                <strong>{{ $this->getStaffInfo() }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            
            <h5 class="mb-3"><strong>Deskripsi</strong></h5>
            <p>{{ $item->description }}</p>
        </div>

        <!-- Lokasi -->
        <div class="mb-4">
            <h5 class="mb-3"><strong>Lokasi</strong></h5>
            <p>{{ $item->location }}</p>
        </div>
    </div>
</div>
</div>