<div x-data="{ mainImage: @entangle('mainImage'), fade: false }" class="container py-4">
    <div class="row">
        <!-- Main Image -->
        <div class="col-lg-8 col-md-12 mb-3">
            <img 
                :src="mainImage" 
                class="img-fluid rounded shadow w-100 transition" 
                :class="{ 'opacity-0': fade }"
                @load="fade = false"
                style="height: 637px; object-fit: cover; transition: opacity 0.5s ease;" 
                alt="Main Image"
                x-init="$watch('mainImage', () => fade = true)"
            >
        </div>

        <!-- Thumbnails -->
        <div 
            class="col-lg-4 col-md-12 d-flex d-md-flex flex-md-column gap-2 overflow-auto mb-3 px-0 justify-content-center justify-content-md-start"
            style="flex-wrap: nowrap;"
        >
            @foreach($images as $image)
                <img 
                    src="{{ $image }}" 
                    class="img-thumbnail cursor-pointer flex-shrink-0 mx-2 mx-md-0 custom-thumb" 
                    @click="mainImage = '{{ $image }}'" 
                    :class="{ 'border border-3 border-primary': mainImage === '{{ $image }}' }"
                    style="
                        width: 33.33vw;
                        aspect-ratio: 18/9;
                        object-fit: cover;
                        transition: border 0.3s ease;
                        margin-bottom: 0.5rem;
                    "
                >
            @endforeach
        </div>
    </div>

    <div class="mt-4 position-relative">
        <h4><strong>Kora Kora</strong></h4>
        <p><strong>Kapasitas:</strong> <span class="text-muted">10/1000</span></p>

        <h5 class="mt-4"><strong>Deskripsi</strong></h5>
        <p><strong>Lorem ipsum dolor sit amet,</strong> consectetur adipiscing elit, sed do eiusmod tempor incididunt...</p>

        <h5 class="mt-4"><strong>Lokasi</strong></h5>
        <p><strong>Lorem ipsum dolor sit amet,</strong> consectetur adipiscing elit, sed do eiusmod tempor incididunt...</p>

        <button class="btn btn-primary text-white mt-3 fw-bold px-4 position-absolute top-0 end-0">+ Pesan Antrian</button>
    </div>
</div>