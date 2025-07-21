@push('styles')
@vite([
    'resources/css/jesselyn.css',
    'resources/css/sorting.css',
])
<style>
    .dashboard-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.8;
    }
    .welcome-card {
        background: linear-gradient(135deg, rgba(78, 115, 223, 0.1), rgba(28, 200, 138, 0.1));
        border-left: 4px solid #4e73df;
    }
    .info-card {
        border: none;
        border-radius: 15px;
    }
    .gallery-img {
        transition: transform 0.3s ease;
        border-radius: 10px;
    }
    .gallery-img:hover {
        transform: scale(1.05);
    }
</style>

<div>
    <div class="p-5">
        <!-- Header -->
        <div class="card w-100 shadow p-3 mb-4 bg-body-tertiary rounded">
            <div class="d-flex align-items-center">
                <div class="vertical-line-admin"></div>
                <h3 class="card-title ms-2">
                    <i class="bi bi-shop me-2"></i>
                    Restaurant Dashboard
                </h3>
            </div>
        </div>

        @if($restaurant)
        <!-- Welcome Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card welcome-card shadow border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="text-primary mb-1">Selamat Datang Kembali!</h5>
                                <h3 class="mb-2">{{ $restaurant->name }}</h3>
                                <p class="text-muted mb-3">
                                    <i class="bi bi-geo-alt-fill me-1"></i>
                                    {{ $restaurant->location }}
                                </p>
                                <a href="/staff/restaurant/edit" class="btn btn-primary btn-sm me-2">
                                    <i class="bi bi-pencil-square me-2"></i>Edit Restaurant
                                </a>
                                <a href="/staff/restaurant/queue/{{ $restaurant->id }}" class="btn btn-success btn-sm">
                                    <i class="bi bi-list-ol me-2"></i>Kelola Antrian
                                </a>
                            </div>
                            <div class="col-auto">
                                <div class="text-primary opacity-50">
                                    <i class="bi bi-shop" style="font-size: 3rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card dashboard-card h-100 shadow border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="stat-icon text-primary me-3">
                                <i class="bi bi-clipboard-data-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-subtitle mb-1 text-muted">Total Bookings</h6>
                                <h3 class="card-title mb-0">{{ number_format($totalBookings) }}</h3>
                                <small class="text-muted">All time</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card dashboard-card h-100 shadow border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="stat-icon text-success me-3">
                                <i class="bi bi-calendar-check-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-subtitle mb-1 text-muted">Today's Bookings</h6>
                                <h3 class="card-title mb-0">{{ number_format($todayBookings) }}</h3>
                                <small class="text-muted">{{ now()->format('d M Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card dashboard-card h-100 shadow border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="stat-icon text-warning me-3">
                                <i class="bi bi-calendar-week-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-subtitle mb-1 text-muted">This Week</h6>
                                <h3 class="card-title mb-0">{{ number_format($weeklyBookings) }}</h3>
                                <small class="text-muted">{{ now()->startOfWeek()->format('d M') }} - {{ now()->endOfWeek()->format('d M') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card dashboard-card h-100 shadow border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="stat-icon text-info me-3">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-subtitle mb-1 text-muted">Capacity</h6>
                                <h3 class="card-title mb-0">{{ number_format($restaurant->capacity ?? 0) }}</h3>
                                <small class="text-muted">Maximum guests</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Restaurant Info & Gallery -->
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card info-card shadow h-100">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                Informasi Restaurant
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Nama Restaurant</label>
                                        <p class="fw-bold text-dark">{{ $restaurant->name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Lokasi</label>
                                        <p class="text-dark">
                                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                            {{ $restaurant->location }}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Kategori</label>
                                        <p class="text-dark">{{ $restaurant->category ?? 'Restaurant' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Kapasitas</label>
                                        <p class="text-dark">
                                            <i class="bi bi-people-fill text-info me-1"></i>
                                            {{ $restaurant->capacity ?? 'Tidak ditentukan' }} orang
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Waktu Layanan</label>
                                        <p class="text-dark">
                                            <i class="bi bi-clock-fill text-warning me-1"></i>
                                            {{ $restaurant->time_estimation ?? 'Tidak ditentukan' }} menit
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Status</label>
                                        <div>
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle-fill me-1"></i>
                                                Aktif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($restaurant->description)
                                <hr>
                                <div>
                                    <label class="form-label text-muted small text-uppercase fw-bold">Deskripsi</label>
                                    <p class="text-dark">{{ $restaurant->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <div class="card info-card shadow h-100">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0">
                                <i class="bi bi-images me-2"></i>
                                Gallery Restaurant
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            @if($restaurant->cover)
                                <div class="mb-3">
                                    <img src="{{ asset('img/' . $restaurant->cover) }}" 
                                         alt="{{ $restaurant->name }}" 
                                         class="img-fluid gallery-img shadow-sm"
                                         style="max-height: 200px; object-fit: cover; width: 100%;">
                                </div>
                            @else
                                <div class="bg-light p-4 rounded mb-3">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-2 mb-0">Tidak ada gambar cover</p>
                                </div>
                            @endif
                            
                            @if($restaurant->img1 || $restaurant->img2 || $restaurant->img3)
                                <div class="row g-2">
                                    @if($restaurant->img1)
                                        <div class="col-4">
                                            <img src="{{ asset('img/' . $restaurant->img1) }}" 
                                                 class="img-fluid gallery-img shadow-sm" 
                                                 style="height: 60px; object-fit: cover; width: 100%;">
                                        </div>
                                    @endif
                                    @if($restaurant->img2)
                                        <div class="col-4">
                                            <img src="{{ asset('img/' . $restaurant->img2) }}" 
                                                 class="img-fluid gallery-img shadow-sm" 
                                                 style="height: 60px; object-fit: cover; width: 100%;">
                                        </div>
                                    @endif
                                    @if($restaurant->img3)
                                        <div class="col-4">
                                            <img src="{{ asset('img/' . $restaurant->img3) }}" 
                                                 class="img-fluid gallery-img shadow-sm" 
                                                 style="height: 60px; object-fit: cover; width: 100%;">
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- No Restaurant Assigned -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow">
                        <div class="card-body text-center py-5">
                            <div class="text-warning mb-3">
                                <i class="bi bi-exclamation-triangle-fill" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class="text-dark mb-2">Belum Ada Restaurant yang Ditugaskan</h4>
                            <p class="text-muted mb-4">Anda belum ditugaskan untuk mengelola restaurant. Silakan hubungi administrator untuk penugasan.</p>
                            <button class="btn btn-warning">
                                <i class="bi bi-telephone-fill me-2"></i>
                                Hubungi Admin
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
