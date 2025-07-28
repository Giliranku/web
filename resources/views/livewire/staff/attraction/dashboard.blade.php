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
        background: linear-gradient(135deg, rgba(28, 200, 138, 0.1), rgba(13, 202, 240, 0.1));
        border-left: 4px solid #1cc88a;
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
                    <i class="bi bi-star-fill me-2"></i>
                    Attraction Dashboard
                </h3>
            </div>
        </div>

        @if($attraction)
        <!-- Welcome Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card welcome-card shadow border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="text-success mb-1">Selamat Datang Kembali!</h5>
                                <h3 class="mb-2">{{ $attraction->name }}</h3>
                                <p class="text-muted mb-3">
                                    <i class="bi bi-geo-alt-fill me-1"></i>
                                    {{ $attraction->location }}
                                </p>
                                <a href="/staff/attraction/edit" class="btn btn-success btn-sm me-2">
                                    <i class="bi bi-stars me-2"></i>Edit Wahana
                                </a>
                                <a href="/staff/attraction/queue/{{ $attraction->id }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-list-ol me-2"></i>Kelola Antrian
                                </a>
                            </div>
                            <div class="col-auto">
                                <div class="text-success opacity-50">
                                    <i class="bi bi-star-fill" style="font-size: 3rem;"></i>
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
                                <i class="bi bi-ticket-perforated-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-subtitle mb-1 text-muted">Total Visitors</h6>
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
                                <h6 class="card-subtitle mb-1 text-muted">Today's Visitors</h6>
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
                                <h3 class="card-title mb-0">{{ number_format($attraction->capacity ?? 0) }}</h3>
                                <small class="text-muted">Maximum visitors</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attraction Info & Gallery -->
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card info-card shadow h-100">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                Informasi Attraction
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Nama Attraction</label>
                                        <p class="fw-bold ">{{ $attraction->name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Lokasi</label>
                                        <p class="">
                                            <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                            {{ $attraction->location }}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Kategori</label>
                                        <p class="">{{ $attraction->category ?? 'Attraction' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Kapasitas</label>
                                        <p class="">
                                            <i class="bi bi-people-fill text-info me-1"></i>
                                            {{ $attraction->capacity ?? 'Tidak ditentukan' }} orang
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-muted small text-uppercase fw-bold">Durasi</label>
                                        <p class="">
                                            <i class="bi bi-clock-fill text-warning me-1"></i>
                                            {{ $attraction->time_estimation ?? 'Tidak ditentukan' }} menit
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
                            @if($attraction->description)
                                <hr>
                                <div>
                                    <label class="form-label text-muted small text-uppercase fw-bold">Deskripsi</label>
                                    <p class="">{{ $attraction->description }}</p>
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
                                Gallery Attraction
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            @if($attraction->cover)
                                <div class="mb-3">
                                    <img src="{{ asset('img/' . $attraction->cover) }}" 
                                         alt="{{ $attraction->name }}" 
                                         class="img-fluid gallery-img shadow-sm"
                                         style="max-height: 200px; object-fit: cover; width: 100%;">
                                </div>
                            @else
                                <div class="bg-body-secondary p-4 rounded mb-3">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-2 mb-0">Tidak ada gambar cover</p>
                                </div>
                            @endif
                            
                            @if($attraction->img1 || $attraction->img2 || $attraction->img3)
                                <div class="row g-2">
                                    @if($attraction->img1)
                                        <div class="col-4">
                                            <img src="{{ asset('img/' . $attraction->img1) }}" 
                                                 class="img-fluid gallery-img shadow-sm" 
                                                 style="height: 60px; object-fit: cover; width: 100%;">
                                        </div>
                                    @endif
                                    @if($attraction->img2)
                                        <div class="col-4">
                                            <img src="{{ asset('img/' . $attraction->img2) }}" 
                                                 class="img-fluid gallery-img shadow-sm" 
                                                 style="height: 60px; object-fit: cover; width: 100%;">
                                        </div>
                                    @endif
                                    @if($attraction->img3)
                                        <div class="col-4">
                                            <img src="{{ asset('img/' . $attraction->img3) }}" 
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
            <!-- No Attraction Assigned -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow">
                        <div class="card-body text-center py-5">
                            <div class="text-warning mb-3">
                                <i class="bi bi-exclamation-triangle-fill" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class=" mb-2">Belum Ada Attraction yang Ditugaskan</h4>
                            <p class="text-muted mb-4">Anda belum ditugaskan untuk mengelola attraction. Silakan hubungi administrator untuk penugasan.</p>
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
