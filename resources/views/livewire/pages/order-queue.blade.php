@vite([
  'resources/sass/app.scss',
  'resources/js/app.js',
  'resources/css/main.css',
  'resources/css/sorting.css',
  'resources/css/sorting.css',
  'resources/css/queue-detail.css',
  // 'public/js/userprofile.js'
])
<div>
  <!-- Filter -->
  <div class="container my-4">
    <div class="row g-3 align-items-center">
      <div class="col-12 col-lg-12">
        <input type="text" class="form-control search-box" placeholder="Cari">
      </div>
      <div class="col-6 col-lg-4">
        <select class="form-select">
          <option>Kapasitas Terbesar</option>
        </select>
      </div>
      <div class="col-6 col-lg-4">
        <select class="form-select" wire:model.lazy="type">
          <option value="restaurant">Restoran</option>
          <option value="wahana">Wahana</option>
        </select>
      </div>
      <div class="col-12 col-lg-4">
        <button class="btn btn-primary w-100">Cari</button>
      </div>
    </div>
  </div>

  <!-- Kartu -->
  <div class="container">
    @if($type === 'restaurant')
      @foreach ($restaurants as $restaurant)
        @php
          $isCurrentUser = isset($restaurant->user_queue_position) && $restaurant->user_queue_position !== null;
          $isFirst = $isCurrentUser && $restaurant->user_queue_position === 0;
        @endphp
        <div class="card resto-card mb-4" style="height:auto;">
          <div class="card-body row g-3 flex-column flex-lg-row">
            <div class="col-12 col-lg-4 order-2 order-lg-1 d-flex flex-column h-100 justify-content-between align-items-start">
              <div>
                <h4 class="resto-title mb-1">{{ $restaurant->name }}</h4>
                <p class="text-muted resto-subtitle mb-2">{{ $restaurant->location }}</p>
                <div class="d-flex align-items-center mb-3" style="gap:2rem;">
                  <div class="d-flex flex-column align-items-start me-4">
                    <div class="d-flex align-items-center mb-0">
                      <i class="bi bi-person-fill fs-2 me-2"></i>
                      <span class="fw-bold fs-3">{{ $restaurant->users_count }}</span>
                    </div>
                    <span style="color:#111; font-size:1.15rem; font-weight:500;">Antrian</span>
                  </div>
                  <span class="mx-2" style="display:inline-block; width:1px; height:64px; background:#111; border-radius:1px;"></span>
                  <div class="d-flex flex-column align-items-start">
                    <div class="d-flex align-items-center mb-0">
                      <i class="bi bi-clock-fill fs-2 me-2"></i>
                      <span class="fw-bold fs-3">{{ $restaurant->time_estimation }}</span>
                    </div>
                    <span style="color:#111; font-size:1.15rem; font-weight:500;">Menit</span>
                  </div>
                </div>
                <div class="text-danger mb-2" style="font-size: 0.85rem;">*Pesan untuk 2 orang</div>
                <p class="resto-description mb-3">{{ $restaurant->description }}</p>
                @if($isCurrentUser)
                  <span class="status-sticker mb-2"
                        style="background:{{ $isFirst ? '#28a745' : '#dc3545' }}; color:#fff; min-width:160px; min-height:40px; display:inline-flex; align-items:center; justify-content:center; font-size:1rem; border-radius:999px; font-weight:600; opacity:0.85; pointer-events:none;">
                      {{ $isFirst ? 'Siap Masuk' : 'Mengantri' }}
                  </span>
                @endif
              </div>
              <button class="btn btn-danger px-5 py-3 rounded-pill align-self-start text-white mt-5 mb-0" style="min-width: 140px;">Cancel Order</button>
            </div>
            <div class="col-12 col-lg-8 order-1 order-lg-2">
              <!-- Desktop: 3 small + 1 big image -->
              <div class="d-none d-lg-flex w-100 align-items-start picture">
                <div class="d-flex flex-column justify-content-between" style="height:598px; gap:32px;">
                  <div style="width:178px; height:178px; display:flex;">
                    <img src="{{ $restaurant->img1 }}" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:top;" />
                  </div>
                  <div style="width:178px; height:178px; display:flex;">
                    <img src="{{ $restaurant->img2 }}" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:center;" />
                  </div>
                  <div style="width:178px; height:178px; display:flex;">
                    <img src="{{ $restaurant->img3 }}" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:bottom;" />
                  </div>
                </div>
                <div class="d-flex align-items-start justify-content-center" style="margin-left:36px; width:598px; height:598px;">
                  <img src="{{ $restaurant->cover }}" style="object-fit:cover; width:598px; height:598px; aspect-ratio:1/1; object-position:center;" />
                </div>
              </div>
              <!-- Mobile: 1 big image -->
              <div class="d-block d-lg-none w-100 mb-3 picture">
                <img src="{{ $restaurant->cover }}" class="img-fluid w-100 rounded" style="max-height:220px; object-fit:cover;" />
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @elseif($type === 'wahana')
      @foreach ($attractions as $attraction)
        @php
          $isCurrentUser = isset($attraction->user_queue_position) && $attraction->user_queue_position !== null;
          $isFirst = $isCurrentUser && $attraction->user_queue_position === 0;
        @endphp
        <div class="card resto-card mb-4" style="height:auto;">
          <div class="card-body row g-3 flex-column flex-lg-row">
            <div class="col-12 col-lg-4 order-2 order-lg-1 d-flex flex-column h-100 justify-content-between align-items-start">
              <div>
                <h4 class="resto-title mb-1">{{ $attraction->name }}</h4>
                <p class="text-muted resto-subtitle mb-2">{{ $attraction->location ?? 'Taman Bermain Ancol' }}</p>
                <div class="d-flex align-items-center mb-3" style="gap:2rem;">
                  <div class="d-flex flex-column align-items-start me-4">
                    <div class="d-flex align-items-center mb-0">
                      <i class="bi bi-person-fill fs-2 me-2"></i>
                      <span class="fw-bold fs-3">{{ $attraction->users_count }}</span>
                    </div>
                    <span style="color:#111; font-size:1.15rem; font-weight:500;">Antrian</span>
                  </div>
                  <span class="mx-2" style="display:inline-block; width:1px; height:64px; background:#111; border-radius:1px;"></span>
                  <div class="d-flex flex-column align-items-start">
                    <div class="d-flex align-items-center mb-0">
                      <i class="bi bi-clock-fill fs-2 me-2"></i>
                      <span class="fw-bold fs-3">{{ $attraction->time_estimation ?? '-' }}</span>
                    </div>
                    <span style="color:#111; font-size:1.15rem; font-weight:500;">Menit</span>
                  </div>
                </div>
                <div class="text-danger mb-2" style="font-size: 0.85rem;">*Pesan untuk 2 orang</div>
                <p class="resto-description mb-3">{{ $attraction->description }}</p>
                @if($isCurrentUser)
                  <span class="status-sticker mb-2"
                        style="background:{{ $isFirst ? '#28a745' : '#dc3545' }}; color:#fff; min-width:160px; min-height:40px; display:inline-flex; align-items:center; justify-content:center; font-size:1rem; border-radius:999px; font-weight:600; opacity:0.85; pointer-events:none;">
                      {{ $isFirst ? 'Siap Masuk' : 'Mengantri' }}
                  </span>
                @endif
              </div>
              <button class="btn btn-danger px-5 py-3 rounded-pill align-self-start text-white mt-5 mb-0" style="min-width: 140px;">Cancel Order</button>
            </div>
            <div class="col-12 col-lg-8 order-1 order-lg-2">
              <!-- Desktop: 3 small + 1 big image -->
              <div class="d-none d-lg-flex w-100 align-items-start picture">
                <div class="d-flex flex-column justify-content-between" style="height:598px; gap:32px;">
                  <div style="width:178px; height:178px; display:flex;">
                    <img src="{{ $attraction->img1 ?? 'wahana1.png' }}" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:top;" />
                  </div>
                  <div style="width:178px; height:178px; display:flex;">
                    <img src="{{ $attraction->img2 ?? 'wahana1.png' }}" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:center;" />
                  </div>
                  <div style="width:178px; height:178px; display:flex;">
                    <img src="{{ $attraction->img3 ?? 'wahana1.png' }}" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:bottom;" />
                  </div>
                </div>
                <div class="d-flex align-items-start justify-content-center" style="margin-left:36px; width:598px; height:598px;">
                  <img src="{{ $attraction->cover ?? 'wahana1.png' }}" style="object-fit:cover; width:598px; height:598px; aspect-ratio:1/1; object-position:center;" />
                </div>
              </div>
              <!-- Mobile: 1 big image -->
              <div class="d-block d-lg-none w-100 mb-3 picture">
                <img src="{{ $attraction->cover ?? 'wahana1.png' }}" class="img-fluid w-100 rounded" style="max-height:220px; object-fit:cover;" />
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
</div> 