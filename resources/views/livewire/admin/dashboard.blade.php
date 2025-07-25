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
    .chart-container {
        position: relative;
        height: 300px;
    }
    .growth-badge {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
    }
    .news-item {
        transition: background-color 0.3s ease;
    }
    .news-item:hover {
        background-color: rgba(0,0,0,0.05);
    }
</style>
@endpush



@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('dashboard', () => ({
        init() {
            this.initCharts();
        },
        
        initCharts() {
            // User vs Staff Chart
            const userStaffCtx = document.getElementById('userStaffChart');
            new Chart(userStaffCtx, {
                type: 'bar',
                data: {
                    labels: ['Users', 'Staff'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [{{ $totalUsers }}, {{ $totalStaff }}],
                        backgroundColor: [
                            'rgba(13, 110, 253, 0.8)',
                            'rgba(25, 135, 84, 0.8)'
                        ],
                        borderColor: [
                            'rgba(13, 110, 253, 1)',
                            'rgba(25, 135, 84, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // Content Distribution Chart
            const contentCtx = document.getElementById('contentChart');
            new Chart(contentCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Wahana', 'Restoran', 'Berita', 'Tiket'],
                    datasets: [{
                        data: [{{ $totalAttractions }}, {{ $totalRestaurants }}, {{ $totalNews }}, {{ $totalTickets }}],
                        backgroundColor: [
                            'rgba(13, 202, 240, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(220, 53, 69, 0.8)',
                            'rgba(108, 117, 125, 0.8)'
                        ],
                        borderColor: [
                            'rgba(13, 202, 240, 1)',
                            'rgba(255, 193, 7, 1)',
                            'rgba(220, 53, 69, 1)',
                            'rgba(108, 117, 125, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        }
    }));
});
</script>
@endpush

<div>
    <div class="p-5">
    <!-- Header -->
        <div class="card w-100 shadow p-3 mb-4 bg-body-tertiary rounded">
            <div class="d-flex align-items-center">
                <div class="vertical-line-admin"></div>
                <h3 class="card-title ms-2">Dashboard Admin</h3>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card dashboard-card h-100 shadow border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="stat-icon text-primary me-3">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted">Total Users</h6>
                            <h3 class="card-title mb-0">{{ number_format($totalUsers) }}</h3>
                            @if($userGrowth !== 0)
                                <span class="growth-badge badge bg-{{ $userGrowth > 0 ? 'success' : 'danger' }}">
                                    <i class="bi bi-{{ $userGrowth > 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                    {{ abs($userGrowth) }}%
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card dashboard-card h-100 shadow border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="stat-icon text-success me-3">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted">Total Staff</h6>
                            <h3 class="card-title mb-0">{{ number_format($totalStaff) }}</h3>
                            @if($staffGrowth !== 0)
                                <span class="growth-badge badge bg-{{ $staffGrowth > 0 ? 'success' : 'danger' }}">
                                    <i class="bi bi-{{ $staffGrowth > 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                    {{ abs($staffGrowth) }}%
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card dashboard-card h-100 shadow border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="stat-icon text-info me-3">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted">Wahana</h6>
                            <h3 class="card-title mb-0">{{ number_format($totalAttractions) }}</h3>
                            <small class="text-muted">Attractions</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card dashboard-card h-100 shadow border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="stat-icon text-warning me-3">
                            <i class="bi bi-shop"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted">Restoran</h6>
                            <h3 class="card-title mb-0">{{ number_format($totalRestaurants) }}</h3>
                            <small class="text-muted">Restaurants</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <div class="col-lg-8 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">
                            <i class="bi bi-bar-chart-fill me-2"></i>
                            Statistik User & Staff
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="userStaffChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">
                            <i class="bi bi-pie-chart-fill me-2"></i>
                            Distribusi Konten
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="contentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card dashboard-card shadow border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="stat-icon text-danger me-3">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted">Total Berita</h6>
                            <h3 class="card-title mb-0">{{ number_format($totalNews) }}</h3>
                            <small class="text-muted">Published News</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <div class="card dashboard-card shadow border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="stat-icon text-dark me-3">
                            <i class="bi bi-ticket-perforated-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-subtitle mb-1 text-muted">Total Tiket</h6>
                            <h3 class="card-title mb-0">{{ number_format($totalTickets) }}</h3>
                            <small class="text-muted">Available Tickets</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest News -->
        <div class="card shadow">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">
                        <i class="bi bi-newspaper me-2"></i>
                        Berita Terbaru
                    </h5>
                    <a href="{{ route('admin.manage-news') }}" class="btn btn-outline-primary btn-sm">
                        Lihat Semua
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($latestNews->count() > 0)
                    @foreach($latestNews as $news)
                        <div class="news-item d-flex align-items-center p-3 rounded {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-newspaper text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $news->title ?? 'Judul Berita' }}</h6>
                                <p class="text-muted mb-1 small">{{ Str::limit($news->content ?? 'Konten berita...', 100) }}</p>
                                <small class="text-muted">
                                    <i class="bi bi-person-circle me-1"></i>
                                    {{ $news->staff->name ?? 'Staff' }} • 
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $news->created_at->format('d M Y') }}
                                </small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge bg-success">Published</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-newspaper text-muted" style="font-size: 3rem;"></i>
                        <h5 class="text-muted mt-3">Belum ada berita</h5>
                        <p class="text-muted">Tambahkan berita pertama untuk ditampilkan di sini</p>
                        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Tambah Berita
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div x-data="dashboard"></div>

</div>