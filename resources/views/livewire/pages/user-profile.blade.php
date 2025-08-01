@push('styles')
@vite([
    'resources/css/user-profile-page.css'
])
<style>
    :root {
        --primary-color: var(--bs-primary);
        --secondary-color: var(--bs-secondary);
        --warning-color: var(--bs-warning);
        --light-color: var(--bs-light);
        --dark-color: var(--bs-dark);
        --bg-light: var(--bs-gray-100);
        --border-radius: 12px;
        --shadow-sm: var(--bs-box-shadow-sm);
        --shadow-md: var(--bs-box-shadow);
    }

    .user-profile-avatar {
        width: 180px;
        height: 180px;
        border: 4px solid var(--warning-color);
        box-shadow: var(--shadow-md);
    }

    .edit-btn {
        width: 45px;
        height: 45px;
        background: var(--warning-color);
        border: 2px solid var(--light-color);
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
    }

    .edit-btn:hover {
        background: var(--secondary-color);
        transform: scale(1.05);
    }

    .activity-accordion {
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .activity-tab {
        transition: all 0.3s ease;
        border: none !important;
        margin-bottom: 2px;
    }

    .activity-tab:hover {
        background: var(--warning-color) !important;
        transform: translateX(5px);
    }

    .activity-tab.active {
        background: var(--warning-color) !important;
        font-weight: 600;
    }

    .content-card {
        background: var(--bs-body-bg);
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }

    .content-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .queue-badge {
        border-radius: 20px;
        font-weight: 600;
        padding: 8px 16px;
    }

    .field-container {
        background: var(--bs-gray-100);
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 20px;
        border-left: 4px solid var(--primary-color);
    }

    .field-input {
        border: 2px solid var(--bs-border-color);
        border-radius: 8px;
        transition: all 0.3s ease;
        background: var(--bs-body-bg);
        color: var(--bs-body-color);
    }

    .field-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem var(--bs-primary-bg-subtle);
    }

    .mobile-edit-btn {
        background: var(--warning-color);
        border: 3px solid var(--light-color);
        box-shadow: var(--shadow-md);
    }
        .queue-badge {
            transition: all 0.3s ease;
            border: none;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .queue-badge:hover {
            transform: translateY(-1px);
        }

        .content-card {
            border: 1px solid var(--bs-border-color-translucent);
            background: var(--bs-body-bg);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-color: var(--bs-primary);
        }

        /* Mobile Responsive */
        @media (max-width: 767.98px) {
            .profile-container {
                padding: 1rem;
            }

            .user-profile-avatar {
                width: 80px;
                height: 80px;
            }

            .profile-header {
                text-align: center;
            }

            .profile-sidebar {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .sidebar-nav .nav-link {
                padding: 1rem;
                margin-bottom: 0.5rem;
            }

            .profile-main {
                padding: 1rem;
            }

            .content-card .card-body {
                padding: 1.5rem !important;
            }

            .queue-info-mobile {
                text-align: center;
                margin-top: 1rem;
            }

            .queue-badges {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                align-items: center;
            }
        }

        /* Tablet Responsive */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .profile-container {
                padding: 1.5rem;
            }

            .user-profile-avatar {
                width: 100px;
                height: 100px;
            }
        }

        /* Large Screen */
        @media (min-width: 1200px) {
            .profile-container {
                max-width: 1200px;
                margin: 0 auto;
            }
        }

        .profile-sidebar-card {
            border: none;
            backdrop-filter: blur(10px);
        }

        .profile-main-content {
            border: none;
            backdrop-filter: blur(10px);
            min-height: 600px;
        }
    </style>
@endpush
<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    {{-- Desktop Layout --}}
    <div class="d-none d-md-block">
        <!-- Background Image -->
        <div class="w-100 position-relative" style="height: 300px; overflow: hidden;">
            <img src="{{ asset('img/bgmelar.png') }}" alt="Background" 
                 class="w-100 h-100 object-fit-cover">
        </div>

        <!-- Main Content Container -->
        <div class="container-fluid px-4" style="margin-top: -150px; position: relative; z-index: 2;">
            <div class="row justify-content-center">
                <!-- Profile Sidebar -->
                <div class="col-lg-3 col-md-4">
                    <div class="profile-sidebar-card bg-white rounded-4 shadow-lg p-4 mb-4">
                        <!-- Avatar Section -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if($avatar)
                                    @if(str_contains($avatar, 'http'))
                                        <img src="{{ $avatar }}" class="user-profile-avatar rounded-circle object-fit-cover">
                                    @else
                                        <img src="{{ asset('storage/' . $avatar) }}" class="user-profile-avatar rounded-circle object-fit-cover">
                                    @endif
                                @else
                                    <div class="user-profile-avatar rounded-circle d-flex align-items-center justify-content-center bg-light">
                                        <i class="bi bi-person-fill text-muted" style="font-size: 60px;"></i>
                                    </div>
                                @endif
                                
                                <!-- Edit Button -->
                                <button class="edit-btn btn position-absolute bottom-0 end-0 rounded-circle d-flex align-items-center justify-content-center"
                                    onclick="document.getElementById('avatarInput').click()" aria-label="Edit Foto">
                                    <i class="bi bi-pencil text-white" style="font-size: 18px;"></i>
                                </button>
                                
                                <!-- Hidden file input -->
                                <input type="file" id="avatarInput" wire:model="newAvatar" accept="image/*" style="display: none;">
                                
                                <!-- Loading spinner -->
                                @if($uploading)
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded-circle" 
                                         style="background: rgba(255,255,255,0.9);">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- User Info -->
                            <div class="mt-3">
                                <h4 class="fw-bold text-dark mb-1">{{ $name ?? 'User Name' }}</h4>
                                <p class="text-muted mb-0">{{ $email ?? 'user@email.com' }}</p>
                            </div>
                        </div>

                        <!-- Navigation Tabs -->
                        <div class="activity-accordion">
                            <div class="bg-light rounded-3">
                                <div class="p-3 text-center bg-warning rounded-top">
                                    <h6 class="mb-0 fw-bold text-dark">
                                        <i class="bi bi-person-gear me-2"></i>
                                        Aktivitas Anda
                                    </h6>
                                </div>
                                
                                <div class="p-2">
                                    <button wire:click="setActiveTab('profile')" 
                                        class="activity-tab {{ $activeTab === 'profile' ? 'active' : '' }} btn w-100 text-start mb-2 py-3 px-3 rounded">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person-circle me-3 fs-5"></i>
                                                <span class="fw-semibold">Profile</span>
                                            </div>
                                            <i class="bi bi-chevron-right"></i>
                                        </div>
                                    </button>
                                    
                                    <button wire:click="setActiveTab('wahana')" 
                                        class="activity-tab {{ $activeTab === 'wahana' ? 'active' : '' }} btn w-100 text-start mb-2 py-3 px-3 rounded">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-controller me-3 fs-5"></i>
                                                <span class="fw-semibold">Wahana</span>
                                            </div>
                                            <i class="bi bi-chevron-right"></i>
                                        </div>
                                    </button>
                                    
                                    <button wire:click="setActiveTab('restoran')" 
                                        class="activity-tab {{ $activeTab === 'restoran' ? 'active' : '' }} btn w-100 text-start py-3 px-3 rounded">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-cup-hot me-3 fs-5"></i>
                                                <span class="fw-semibold">Restoran</span>
                                            </div>
                                            <i class="bi bi-chevron-right"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="col-lg-9 col-md-8">
                    <div class="profile-main-content bg-white rounded-4 shadow-lg p-4">
                @if($activeTab === 'profile')
                    <!-- Profile Edit Tab -->
                    <div class="mb-4">
                        <h2 class="fw-bold text-dark mb-1">
                            <i class="bi bi-person-gear me-2"></i>
                            Edit Profile
                        </h2>
                        <p class="text-muted">Kelola informasi profil Anda</p>
                    </div>

                    <!-- Field Nama -->
                    <div class="field-container" x-data="{ edit: false }" x-init="$watch('edit', value => {
                            if(value) $nextTick(() => $refs.input.focus())
                        })">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="bi bi-person me-2"></i>
                                    Nama Lengkap
                                </label>
                                
                                <!-- Display Mode -->
                                <div x-show="!edit" class="py-2">
                                    <span class="fs-5" x-text="$wire.name || 'Belum diisi'"></span>
                                </div>
                                
                                <!-- Edit Mode -->
                                <div x-show="edit" style="display: none;">
                                    <input type="text" x-ref="input" wire:model.defer="name" 
                                        class="form-control field-input fs-5"
                                        placeholder="Masukkan nama lengkap"
                                        @keydown.enter="$wire.updateProfile(); edit = false"
                                        @blur="$wire.updateProfile(); edit = false">
                                </div>
                            </div>
                            
                            <button class="btn btn-outline-primary ms-3" @click="edit = !edit">
                                <i class="bi" :class="edit ? 'bi-check-lg' : 'bi-pencil'"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Field Email -->
                    <div class="field-container" x-data="{ edit: false }" x-init="$watch('edit', value => {
                            if(value) $nextTick(() => $refs.input.focus())
                        })">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="bi bi-envelope me-2"></i>
                                    Email
                                </label>
                                
                                <!-- Display Mode -->
                                <div x-show="!edit" class="py-2">
                                    <span class="fs-5" x-text="$wire.email || 'Belum diisi'"></span>
                                </div>
                                
                                <!-- Edit Mode -->
                                <div x-show="edit" style="display: none;">
                                    <input type="email" x-ref="input" wire:model.defer="email" 
                                        class="form-control field-input fs-5"
                                        placeholder="Masukkan email"
                                        @keydown.enter="$wire.updateProfile(); edit = false"
                                        @blur="$wire.updateProfile(); edit = false">
                                </div>
                            </div>
                            
                            <button class="btn btn-outline-primary ms-3" @click="edit = !edit">
                                <i class="bi" :class="edit ? 'bi-check-lg' : 'bi-pencil'"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Field Telepon -->
                    <div class="field-container" x-data="{ edit: false }" x-init="$watch('edit', value => {
                            if(value) $nextTick(() => $refs.input.focus())
                        })">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="bi bi-phone me-2"></i>
                                    Nomor Telepon
                                </label>
                                
                                <!-- Display Mode -->
                                <div x-show="!edit" class="py-2">
                                    <span class="fs-5" x-text="$wire.number || 'Belum diisi'"></span>
                                </div>
                                
                                <!-- Edit Mode -->
                                <div x-show="edit" style="display: none;">
                                    <input type="tel" x-ref="input" wire:model.defer="number" 
                                        class="form-control field-input fs-5"
                                        placeholder="Masukkan nomor telepon"
                                        @keydown.enter="$wire.updateProfile(); edit = false"
                                        @blur="$wire.updateProfile(); edit = false">
                                </div>
                            </div>
                            
                            <button class="btn btn-outline-primary ms-3" @click="edit = !edit">
                                <i class="bi" :class="edit ? 'bi-check-lg' : 'bi-pencil'"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Field Lokasi -->
                    <div class="field-container" x-data="{ edit: false }" x-init="$watch('edit', value => {
                            if(value) $nextTick(() => $refs.input.focus())
                        })">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    Lokasi
                                </label>
                                
                                <!-- Display Mode -->
                                <div x-show="!edit" class="py-2">
                                    <span class="fs-5" x-text="$wire.location || 'Belum diisi'"></span>
                                </div>
                                
                                <!-- Edit Mode -->
                                <div x-show="edit" style="display: none;">
                                    <input type="text" x-ref="input" wire:model.defer="location" 
                                        class="form-control field-input fs-5"
                                        placeholder="Masukkan lokasi"
                                        @keydown.enter="$wire.updateProfile(); edit = false"
                                        @blur="$wire.updateProfile(); edit = false">
                                </div>
                            </div>
                            
                            <button class="btn btn-outline-primary ms-3" @click="edit = !edit">
                                <i class="bi" :class="edit ? 'bi-check-lg' : 'bi-pencil'"></i>
                            </button>
                        </div>
                    </div>

                @elseif($activeTab === 'wahana')
                    <!-- Wahana Tab -->
                    <div class="mb-4">
                        <h2 class="fw-bold text-dark mb-1">
                            <i class="bi bi-controller me-2"></i>
                            Antrian Wahana Anda
                        </h2>
                        <p class="text-muted">Kelola antrian wahana yang sedang Anda ikuti</p>
                    </div>

                    @if($userAttractions->count() > 0)
                        <div class="row g-3">
                            @foreach($userAttractions as $userAttraction)
                                <div class="col-12">
                                    <div class="content-card card">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center">
                                                <div class="col-lg-8 col-md-12">
                                                    <div class="d-flex align-items-start mb-3">
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                                            <i class="bi bi-controller text-primary fs-4"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="card-title mb-1 fw-bold">{{ $userAttraction->attraction->name }}</h5>
                                                            <p class="text-muted mb-2">
                                                                <i class="bi bi-geo-alt-fill me-2 text-danger"></i>
                                                                {{ $userAttraction->attraction->location }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row g-2 text-sm">
                                                        <div class="col-auto">
                                                            <span class="badge bg-light text-dark px-3 py-2">
                                                                <i class="bi bi-calendar-fill me-1"></i>
                                                                {{ $userAttraction->reservation_date->format('d M Y') }}
                                                            </span>
                                                        </div>
                                                        <div class="col-auto">
                                                            <span class="badge bg-light text-dark px-3 py-2">
                                                                <i class="bi bi-clock-fill me-1"></i>
                                                                {{ $userAttraction->reservation_time ? $userAttraction->reservation_time->format('H:i') : 'Flexible' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-4 col-md-12 queue-info-mobile">
                                                    <div class="d-flex flex-column align-items-lg-end align-items-center gap-2 queue-badges">
                                                        <span class="queue-badge badge bg-warning text-dark fs-6">
                                                            <i class="bi bi-hash me-1"></i>
                                                            Posisi {{ $userAttraction->queue_position }}
                                                        </span>
                                                        
                                                        <span class="queue-badge badge fs-6
                                                            @if($userAttraction->status === 'waiting') bg-secondary
                                                            @elseif($userAttraction->status === 'called') bg-success
                                                            @elseif($userAttraction->status === 'served') bg-primary
                                                            @else bg-danger
                                                            @endif">
                                                            <i class="bi 
                                                                @if($userAttraction->status === 'waiting') bi-clock-fill
                                                                @elseif($userAttraction->status === 'called') bi-megaphone-fill
                                                                @elseif($userAttraction->status === 'served') bi-check-circle-fill
                                                                @else bi-x-circle-fill
                                                                @endif me-1"></i>
                                                            {{ ucfirst($userAttraction->status) }}
                                                        </span>
                                                        
                                                        @if($userAttraction->status === 'waiting')
                                                            <small class="text-muted">
                                                                <i class="bi bi-stopwatch me-1"></i>
                                                                Est. {{ $userAttraction->attraction->getEstimatedWaitingTime($userAttraction->queue_position) }} menit
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="content-card card text-center py-5">
                            <div class="card-body">
                                <div class="mb-4">
                                    <i class="bi bi-controller text-muted" style="font-size: 4rem; opacity: 0.5;"></i>
                                </div>
                                <h5 class="text-muted mb-3">Tidak ada antrian wahana</h5>
                                <p class="text-muted mb-4">Anda belum mengantri di wahana manapun hari ini.</p>
                                <a href="{{ route('attractions') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Jelajahi Wahana
                                </a>
                            </div>
                        </div>
                    @endif

                @elseif($activeTab === 'restoran')
                    <!-- Restoran Tab -->
                    <div class="mb-4">
                        <h2 class="fw-bold text-dark mb-1">
                            <i class="bi bi-cup-hot me-2"></i>
                            Antrian Restoran Anda
                        </h2>
                        <p class="text-muted">Kelola antrian restoran yang sedang Anda ikuti</p>
                    </div>

                    @if($userRestaurants->count() > 0)
                        <div class="row g-3">
                            @foreach($userRestaurants as $userRestaurant)
                                <div class="col-12">
                                    <div class="content-card card">
                                        <div class="card-body p-4">
                                            <div class="row align-items-center">
                                                <div class="col-lg-8 col-md-12">
                                                    <div class="d-flex align-items-start mb-3">
                                                        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                                            <i class="bi bi-cup-hot text-warning fs-4"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="card-title mb-1 fw-bold">{{ $userRestaurant->restaurant->name }}</h5>
                                                            <p class="text-muted mb-2">
                                                                <i class="bi bi-geo-alt-fill me-2 text-danger"></i>
                                                                {{ $userRestaurant->restaurant->location }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row g-2 text-sm">
                                                        <div class="col-auto">
                                                            <span class="badge bg-light text-dark px-3 py-2">
                                                                <i class="bi bi-calendar-fill me-1"></i>
                                                                {{ $userRestaurant->reservation_date->format('d M Y') }}
                                                            </span>
                                                        </div>
                                                        <div class="col-auto">
                                                            <span class="badge bg-light text-dark px-3 py-2">
                                                                <i class="bi bi-clock-fill me-1"></i>
                                                                {{ $userRestaurant->reservation_time ? $userRestaurant->reservation_time->format('H:i') : 'Flexible' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-4 col-md-12 queue-info-mobile">
                                                    <div class="d-flex flex-column align-items-lg-end align-items-center gap-2 queue-badges">
                                                        <span class="queue-badge badge bg-warning text-dark fs-6">
                                                            <i class="bi bi-hash me-1"></i>
                                                            Posisi {{ $userRestaurant->queue_position }}
                                                        </span>
                                                        
                                                        <span class="queue-badge badge fs-6
                                                            @if($userRestaurant->status === 'waiting') bg-secondary
                                                            @elseif($userRestaurant->status === 'called') bg-success
                                                            @elseif($userRestaurant->status === 'served') bg-primary
                                                            @else bg-danger
                                                            @endif">
                                                            <i class="bi 
                                                                @if($userRestaurant->status === 'waiting') bi-clock-fill
                                                                @elseif($userRestaurant->status === 'called') bi-megaphone-fill
                                                                @elseif($userRestaurant->status === 'served') bi-check-circle-fill
                                                                @else bi-x-circle-fill
                                                                @endif me-1"></i>
                                                            {{ ucfirst($userRestaurant->status) }}
                                                        </span>
                                                        
                                                        @if($userRestaurant->status === 'waiting')
                                                            <small class="text-muted">
                                                                <i class="bi bi-stopwatch me-1"></i>
                                                                Est. {{ $userRestaurant->restaurant->getEstimatedWaitingTime($userRestaurant->queue_position) }} menit
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="content-card card text-center py-5">
                            <div class="card-body">
                                <div class="mb-4">
                                    <i class="bi bi-cup-hot text-muted" style="font-size: 4rem; opacity: 0.5;"></i>
                                </div>
                                <h5 class="text-muted mb-3">Tidak ada antrian restoran</h5>
                                <p class="text-muted mb-4">Anda belum mengantri di restoran manapun hari ini.</p>
                                <a href="{{ route('queues.index') }}" class="btn btn-warning btn-lg rounded-pill px-4">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Jelajahi Restoran
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile --}}
    <div class="d-block d-md-none position-relative" style="overflow-x: hidden">

        <div class="position-absolute top-5 end-0 mt-2 me-4 " style="z-index: 10;">
            <button class="d-flex btn justify-content-center align-items-center bg-white" type="button"
                style="height: 10vw; width: 10vw; border-radius:100%; box-shadow:0 0 10px #bbb; border: 2px solid #f9d778;"
                onclick="document.getElementById('avatarInputMobile').click()" aria-label="Edit Foto">

                <i class="bi bi-pencil text-dark" style="font-size:5vw;"></i>
            </button>
        </div>

        <div class="justify-content-center d-flex position-absolute"
            style="min-height: 30vh;max-height:75vh; z-index: -1;">
            <div>
                <img src="{{ asset('img/bgmelar.png') }}" alt="bg image" style="height:100%;width: 100%">
            </div>
        </div>

        <div class="justify-content-center d-flex flex-column position-relative">
            <!-- SIDEBAR KIRI -->


            <div class="d-flex flex-row justify-content-center" style="">
                <div class="d-flex flex-column align-items-center w-50">
                    <!-- Foto Profile -->
                    <div class="d-flex position-relative mb-3 flex-row" style="margin-top: 1vw; margin-left: 2vw;">
                        @if($avatar)
                            @if(str_contains($avatar, 'http'))
                                <img src="{{ $avatar }}" class="rounded-circle border border-2 w-100" style="object-fit:cover;">
                            @else
                                <img src="{{ asset('storage/' . $avatar) }}" class="rounded-circle border border-2 w-100" style="object-fit:cover;">
                            @endif
                        @else
                            <div class="rounded-circle d-flex align-items-center justify-content-center w-100 border border-2" style="aspect-ratio: 1/1;">
                                <i class="bi bi-person-fill text-muted" style="font-size: 10vw;"></i>
                            </div>
                        @endif
                        
                        <!-- Loading spinner for avatar upload (mobile) -->
                        @if($uploading)
                            <div class="position-absolute d-flex align-items-center justify-content-center" 
                                 style="top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.8); border-radius: 50%;">
                                <span class="spinner-border text-primary" role="status"></span>
                            </div>
                        @endif
                    </div>

                    <!-- SIDEBAR Profil Aktivitas -->
                    <div class="w-100 d-flex flex-column align-items-center">
                        <div class="accordion w-100" id="profileAccordionMobile">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button border border-dark rounded"
                                        style="background: var(--bs-warning); color: var(--bs-dark);" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-activity-mobile" aria-expanded="true">
                                        Aktivitas Anda
                                    </button>
                                </h2>
                                <div id="flush-activity-mobile" class="accordion-collapse collapse show">
                                    <div class="accordion-body p-0 ">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item rounded-bottom-3 shadow {{ $activeTab === 'profile' ? 'bg-warning' : '' }}"
                                                style="background: {{ $activeTab === 'profile' ? '#f9d778' : '#ffe8ad' }};">
                                                <button wire:click="setActiveTab('profile')" 
                                                    class="btn text-decoration-none w-100 d-flex justify-content-between align-items-center"
                                                    style="background: none; border: none; padding: 0;">
                                                    Profile
                                                    <i class="bi bi-chevron-right"></i>
                                                </button>
                                            </li>
                                            <li class="list-group-item {{ $activeTab === 'wahana' ? 'bg-warning' : '' }}" 
                                                style="background: {{ $activeTab === 'wahana' ? '#f9d778' : '#ffe8ad' }};">
                                                <button wire:click="setActiveTab('wahana')" 
                                                    class="btn text-decoration-none w-100 d-flex justify-content-between align-items-center"
                                                    style="background: none; border: none; padding: 0;">
                                                    Wahana
                                                    <i class="bi bi-chevron-right"></i>
                                                </button>
                                            </li>
                                            <li class="list-group-item" 
                                                style="background: {{ $activeTab === 'restoran' ? '#f9d778' : '#ffe8ad' }};">
                                                <button wire:click="setActiveTab('restoran')" 
                                                    class="btn text-decoration-none w-100 d-flex justify-content-between align-items-center"
                                                    style="background: none; border: none; padding: 0;">
                                                    Restoran
                                                    <i class="bi bi-chevron-right"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BAGIAN PROFILE EDIT MOBILE -->
            <div class="d-flex ms-5 flex-column w-100 mt-3 ">
                @if($activeTab === 'profile')
                    <!-- Field NAMA -->
                    <div x-data="{ edit: false }" x-init="$watch('edit', value => {
                            if(value) $nextTick(() => $refs.input.focus())
                        })"
                        class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                        style="min-height: 4.5rem;">
                        <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                            <span class="ms-2 fs-6 fw-bold">Nama</span>
                            <!-- Display -->
                            <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                    'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                                class="ms-2 fs-6 field-display transition-all"
                                style="border-radius:2vw;  top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                                x-text="$wire.name"></span>
                            <!-- Input -->
                            <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                    'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                                class="fs-6 ms-3 field-input transition-all"
                                style="border-radius:10px; padding:6px 20px; color: var(--bs-body-color);  min-width:220px; top:2rem; left:0; background: var(--bs-body-bg); transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                                wire:model.defer="name" @keydown.enter="$wire.updateProfile(); edit = false"
                                @blur="$wire.updateProfile(); edit = false" x-ref="input">
                        </div>
                        <!-- Tombol kanan -->
                        <div class="justify-content-center edit-field-btn"
                            style="width:5vw; margin-right:25vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                            <button class="btn" type="button" @click="edit = !edit" style="background:none;">
                                <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                    :style="edit ? 'font-size:5vw; transition:all 0.2s;' : 'font-size:5vw; transition:all 0.2s;'"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="w-75">

                    <!-- Field EMAIL -->
                    <div x-data="{ edit: false }" x-init="$watch('edit', value => {
                            if(value) $nextTick(() => $refs.input.focus())
                        })"
                        class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                        style="min-height: 4.5rem;">
                        <div class="d-flex justify-content-start flex-column field-form-group" style="width:50%;">
                            <span class="ms-2 fs-6 fw-bold">Email</span>
                            <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                    'opacity:1; pointer-events:auto; z-index:2; position:relative;word-break:break-all;'"
                                class="ms-2 fs-6 field-display transition-all"
                                style="border-radius:2vw;  top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                                x-text="$wire.email"></span>
                            <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                    'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                                class="fs-6 ms-3 field-input transition-all"
                                style="border-radius:10px; padding:6px 20px; color:#444; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                                wire:model.defer="email" @keydown.enter="$wire.updateProfile(); edit = false"
                                @blur="$wire.updateProfile(); edit = false" x-ref="input">
                        </div>
                        <div class="justify-content-center edit-field-btn"
                            style="width:5vw; margin-right:25vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                            <button class="btn" type="button" @click="edit = !edit" style="background:none;">
                                <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                    :style="edit ? 'font-size:5vw; transition:all 0.2s;' : 'font-size:5vw; transition:all 0.2s;'"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="w-75">

                    <!-- Field TELEPON -->
                    <div x-data="{ edit: false }" x-init="$watch('edit', value => {
                            if(value) $nextTick(() => $refs.input.focus())
                        })"
                        class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                        style="min-height: 4.5rem;">
                        <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                            <span class="ms-2 fs-6 fw-bold">Nomor Telepon</span>
                            <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                    'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                                class="ms-2 fs-6 field-display transition-all"
                                style="border-radius:2vw; top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                                x-text="$wire.number"></span>
                            <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                    'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                                class="fs-6 ms-3 field-input transition-all"
                                style="border-radius:10px; padding:6px 20px; color:#444; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                                wire:model.defer="number" @keydown.enter="$wire.updateProfile(); edit = false"
                                @blur="$wire.updateProfile(); edit = false" x-ref="input">
                        </div>
                        <div class="justify-content-center edit-field-btn"
                            style="width:5vw; margin-right:25vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                            <button class="btn" type="button" @click="edit = !edit" style="background:none;">
                                <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                    :style="edit ? 'font-size:5vw; transition:all 0.2s;' : 'font-size:5vw; transition:all 0.2s;'"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="w-75">

                    <!-- Field LOKASI -->
                    <div x-data="{ edit: false }" x-init="$watch('edit', value => {
                            if(value) $nextTick(() => $refs.input.focus())
                        })"
                        class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                        style="min-height: 4.5rem;">
                        <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                            <span class="ms-2 fs-6 fw-bold">Lokasi</span>
                            <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                    'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                                class="ms-2 fs-6 field-display transition-all"
                                style="border-radius:2vw;  top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                                x-text="$wire.location"></span>
                            <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                    'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                                class="fs-6 ms-3 field-input transition-all"
                                style="border-radius:10px; padding:6px 20px; color:#444;  min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                                wire:model.defer="location" @keydown.enter="$wire.updateProfile(); edit = false"
                                @blur="$wire.updateProfile(); edit = false" x-ref="input">
                        </div>
                        <div class="justify-content-center edit-field-btn"
                            style="width:5vw; margin-right:25vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                            <button class="btn" type="button" @click="edit = !edit" style="background:none;">
                                <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                    :style="edit ? ' font-size:5vw; transition:all 0.2s;' : ' font-size:5vw; transition:all 0.2s;'"></i>
                            </button>
                        </div>
                    </div>

                @elseif($activeTab === 'wahana')
                    <!-- Wahana Tab Mobile -->
                    <div class="ps-3">
                        <h4 class="mb-4">Antrian Wahana</h4>
                        @if($userAttractions->count() > 0)
                            @foreach($userAttractions as $userAttraction)
                                <div class="card mb-3 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title mb-2">{{ $userAttraction->attraction->name }}</h6>
                                        <p class="card-text text-muted mb-1" style="font-size: 0.8rem;">
                                            <i class="bi bi-geo-alt-fill me-1"></i>{{ $userAttraction->attraction->location }}
                                        </p>
                                        <p class="card-text text-muted mb-2" style="font-size: 0.8rem;">
                                            <i class="bi bi-calendar-fill me-1"></i>{{ $userAttraction->reservation_date->format('d M Y') }}
                                            <i class="bi bi-clock-fill ms-2 me-1"></i>{{ $userAttraction->reservation_time ? $userAttraction->reservation_time->format('H:i') : '-' }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-warning text-dark">
                                                Posisi #{{ $userAttraction->queue_position }}
                                            </span>
                                            <span class="badge 
                                                @if($userAttraction->status === 'waiting') bg-secondary
                                                @elseif($userAttraction->status === 'called') bg-success
                                                @elseif($userAttraction->status === 'served') bg-primary
                                                @else bg-danger
                                                @endif">
                                                {{ ucfirst($userAttraction->status) }}
                                            </span>
                                        </div>
                                        @if($userAttraction->status === 'waiting')
                                            <small class="text-muted">
                                                Est. {{ $userAttraction->attraction->getEstimatedWaitingTime($userAttraction->queue_position) }} menit
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-exclamation-circle text-muted" style="font-size: 2rem;"></i>
                                <h6 class="mt-2 text-muted">Tidak ada antrian wahana</h6>
                                <p class="text-muted" style="font-size: 0.9rem;">Anda belum mengantri di wahana manapun hari ini.</p>
                                <a href="{{ route('attractions') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i>Cari Wahana
                                </a>
                            </div>
                        @endif
                    </div>

                @elseif($activeTab === 'restoran')
                    <!-- Restoran Tab Mobile -->
                    <div class="ps-3">
                        <h4 class="mb-4">Antrian Restoran</h4>
                        @if($userRestaurants->count() > 0)
                            @foreach($userRestaurants as $userRestaurant)
                                <div class="card mb-3 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title mb-2">{{ $userRestaurant->restaurant->name }}</h6>
                                        <p class="card-text text-muted mb-1" style="font-size: 0.8rem;">
                                            <i class="bi bi-geo-alt-fill me-1"></i>{{ $userRestaurant->restaurant->location }}
                                        </p>
                                        <p class="card-text text-muted mb-2" style="font-size: 0.8rem;">
                                            <i class="bi bi-calendar-fill me-1"></i>{{ $userRestaurant->reservation_date->format('d M Y') }}
                                            <i class="bi bi-clock-fill ms-2 me-1"></i>{{ $userRestaurant->reservation_time ? $userRestaurant->reservation_time->format('H:i') : '-' }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-warning text-dark">
                                                Posisi #{{ $userRestaurant->queue_position }}
                                            </span>
                                            <span class="badge 
                                                @if($userRestaurant->status === 'waiting') bg-secondary
                                                @elseif($userRestaurant->status === 'called') bg-success
                                                @elseif($userRestaurant->status === 'served') bg-primary
                                                @else bg-danger
                                                @endif">
                                                {{ ucfirst($userRestaurant->status) }}
                                            </span>
                                        </div>
                                        @if($userRestaurant->status === 'waiting')
                                            <small class="text-muted">
                                                Est. {{ $userRestaurant->restaurant->getEstimatedWaitingTime($userRestaurant->queue_position) }} menit
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-exclamation-circle text-muted" style="font-size: 2rem;"></i>
                                <h6 class="mt-2 text-muted">Tidak ada antrian restoran</h6>
                                <p class="text-muted" style="font-size: 0.9rem;">Anda belum mengantri di restoran manapun hari ini.</p>
                                <a href="{{ route('queues.index') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i>Cari Restoran
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

    </div>

</div>
