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
                padding: 0.5rem;
            }

            .mobile-header {
                background: linear-gradient(135deg, var(--warning-color) 0%, #f0c674 100%);
                min-height: 200px;
                border-radius: 0 0 25px 25px;
                position: relative;
                overflow: hidden;
            }

            .mobile-bg-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(249, 215, 120, 0.9) 0%, rgba(240, 198, 116, 0.9) 100%);
                z-index: 1;
            }

            .mobile-profile-content {
                position: relative;
                z-index: 2;
                padding: 1.5rem;
                color: white;
            }

            .mobile-avatar {
                width: 80px;
                height: 80px;
                border: 3px solid white;
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            }

            .mobile-edit-btn {
                width: 35px;
                height: 35px;
                background: white;
                border: 2px solid var(--warning-color);
                box-shadow: 0 2px 10px rgba(0,0,0,0.2);
                position: absolute;
                bottom: -5px;
                right: -5px;
            }

            .mobile-user-info h4 {
                font-size: 1.25rem;
                font-weight: 700;
                text-shadow: 0 1px 3px rgba(0,0,0,0.1);
            }

            .mobile-user-info p {
                font-size: 0.9rem;
                opacity: 0.9;
            }

            .mobile-nav-tabs {
                background: white;
                border-radius: 15px;
                margin: -20px 1rem 1.5rem 1rem;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                overflow: hidden;
                position: relative;
                z-index: 3;
            }

            .mobile-nav-tab {
                padding: 1rem;
                border: none;
                background: white;
                color: var(--bs-dark);
                font-weight: 600;
                transition: all 0.3s ease;
                border-bottom: 1px solid var(--bs-border-color);
            }

            .mobile-nav-tab:last-child {
                border-bottom: none;
            }

            .mobile-nav-tab.active {
                background: var(--warning-color);
                color: var(--bs-dark);
            }

            .mobile-content {
                padding: 0 1rem 2rem 1rem;
            }

            .mobile-field {
                background: white;
                border-radius: 12px;
                padding: 1rem;
                margin-bottom: 1rem;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                border: 1px solid var(--bs-border-color);
            }

            .mobile-field-label {
                font-size: 0.85rem;
                font-weight: 600;
                color: var(--bs-secondary);
                margin-bottom: 0.5rem;
                display: block;
            }

            .mobile-field-value {
                font-size: 1rem;
                color: var(--bs-dark);
                margin-bottom: 0;
            }

            .mobile-field-input {
                border: 2px solid var(--bs-border-color);
                border-radius: 8px;
                padding: 0.75rem;
                font-size: 1rem;
                width: 100%;
                background: var(--bs-body-bg);
                color: var(--bs-body-color);
                transition: all 0.3s ease;
            }

            .mobile-field-input:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem var(--bs-primary-bg-subtle);
                outline: none;
            }

            .mobile-edit-btn-field {
                background: none;
                border: none;
                color: var(--primary-color);
                font-size: 1.1rem;
                padding: 0.5rem;
                border-radius: 50%;
                transition: all 0.3s ease;
            }

            .mobile-edit-btn-field:hover {
                background: var(--bs-primary-bg-subtle);
                transform: scale(1.1);
            }

            .mobile-queue-card {
                background: white;
                border-radius: 12px;
                padding: 1rem;
                margin-bottom: 1rem;
                box-shadow: 0 2px 15px rgba(0,0,0,0.08);
                border: 1px solid var(--bs-border-color);
                transition: all 0.3s ease;
            }

            .mobile-queue-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            }

            .mobile-queue-header {
                display: flex;
                align-items-start;
                margin-bottom: 0.75rem;
            }

            .mobile-queue-icon {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 0.75rem;
                flex-shrink: 0;
            }

            .mobile-queue-title {
                font-size: 1rem;
                font-weight: 600;
                margin-bottom: 0.25rem;
                color: var(--bs-dark);
            }

            .mobile-queue-location {
                font-size: 0.85rem;
                color: var(--bs-secondary);
                margin-bottom: 0.5rem;
            }

            .mobile-queue-datetime {
                display: flex;
                gap: 0.5rem;
                margin-bottom: 0.75rem;
                flex-wrap: wrap;
            }

            .mobile-queue-badge {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
                border-radius: 6px;
                font-weight: 500;
            }

            .mobile-queue-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 0.75rem;
                border-top: 1px solid var(--bs-border-color);
            }

            .mobile-empty-state {
                text-align: center;
                padding: 2rem 1rem;
                background: white;
                border-radius: 12px;
                margin: 1rem;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            }

            .mobile-empty-icon {
                font-size: 3rem;
                color: var(--bs-secondary);
                margin-bottom: 1rem;
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

    {{-- Mobile Layout --}}
    <div class="d-block d-md-none">
        <!-- Mobile Header with Profile -->
        <div class="mobile-header">
            <div class="mobile-bg-overlay"></div>
            <div class="mobile-profile-content">
                <div class="d-flex align-items-center">
                    <!-- Avatar -->
                    <div class="position-relative me-3">
                        @if($avatar)
                            @if(str_contains($avatar, 'http'))
                                <img src="{{ $avatar }}" class="mobile-avatar rounded-circle object-fit-cover">
                            @else
                                <img src="{{ asset('storage/' . $avatar) }}" class="mobile-avatar rounded-circle object-fit-cover">
                            @endif
                        @else
                            <div class="mobile-avatar rounded-circle d-flex align-items-center justify-content-center bg-white">
                                <i class="bi bi-person-fill text-muted" style="font-size: 2rem;"></i>
                            </div>
                        @endif
                        
                        <!-- Edit Button -->
                        <button class="mobile-edit-btn btn rounded-circle d-flex align-items-center justify-content-center"
                            onclick="document.getElementById('avatarInputMobile').click()" aria-label="Edit Foto">
                            <i class="bi bi-pencil text-warning" style="font-size: 0.9rem;"></i>
                        </button>
                        
                        <!-- Loading spinner -->
                        @if($uploading)
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded-circle" 
                                 style="background: rgba(255,255,255,0.9);">
                                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- User Info -->
                    <div class="mobile-user-info flex-grow-1">
                        <h4 class="mb-1">{{ $name ?? 'User Name' }}</h4>
                        <p class="mb-0">{{ $email ?? 'user@email.com' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation Tabs -->
        <div class="mobile-nav-tabs">
            <button wire:click="setActiveTab('profile')" 
                class="mobile-nav-tab w-100 d-flex justify-content-between align-items-center {{ $activeTab === 'profile' ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-circle me-2"></i>
                    <span>Profile</span>
                </div>
                <i class="bi bi-chevron-right"></i>
            </button>
            
            <button wire:click="setActiveTab('wahana')" 
                class="mobile-nav-tab w-100 d-flex justify-content-between align-items-center {{ $activeTab === 'wahana' ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-controller me-2"></i>
                    <span>Wahana</span>
                </div>
                <i class="bi bi-chevron-right"></i>
            </button>
            
            <button wire:click="setActiveTab('restoran')" 
                class="mobile-nav-tab w-100 d-flex justify-content-between align-items-center {{ $activeTab === 'restoran' ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-cup-hot me-2"></i>
                    <span>Restoran</span>
                </div>
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>

        <!-- Content Area -->
        <div class="mobile-content">
            @if($activeTab === 'profile')
                <!-- Profile Fields -->
                <div x-data="{ edit: false }" class="mobile-field">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <label class="mobile-field-label">
                                <i class="bi bi-person me-1"></i> Nama
                            </label>
                            <div x-show="!edit">
                                <p class="mobile-field-value">{{ $name ?? 'Belum diisi' }}</p>
                            </div>
                            <div x-show="edit" style="display: none;">
                                <input type="text" wire:model.defer="name" 
                                    class="mobile-field-input"
                                    placeholder="Masukkan nama"
                                    @keydown.enter="$wire.updateProfile(); edit = false"
                                    @blur="$wire.updateProfile(); edit = false"
                                    x-ref="nameInput">
                            </div>
                        </div>
                        <button class="mobile-edit-btn-field" @click="edit = !edit; if(edit) $nextTick(() => $refs.nameInput.focus())">
                            <i class="bi" :class="edit ? 'bi-check-lg' : 'bi-pencil'"></i>
                        </button>
                    </div>
                </div>

                <div x-data="{ edit: false }" class="mobile-field">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <label class="mobile-field-label">
                                <i class="bi bi-envelope me-1"></i> Email
                            </label>
                            <div x-show="!edit">
                                <p class="mobile-field-value" style="word-break: break-all;">{{ $email ?? 'Belum diisi' }}</p>
                            </div>
                            <div x-show="edit" style="display: none;">
                                <input type="email" wire:model.defer="email" 
                                    class="mobile-field-input"
                                    placeholder="Masukkan email"
                                    @keydown.enter="$wire.updateProfile(); edit = false"
                                    @blur="$wire.updateProfile(); edit = false"
                                    x-ref="emailInput">
                            </div>
                        </div>
                        <button class="mobile-edit-btn-field" @click="edit = !edit; if(edit) $nextTick(() => $refs.emailInput.focus())">
                            <i class="bi" :class="edit ? 'bi-check-lg' : 'bi-pencil'"></i>
                        </button>
                    </div>
                </div>

                <div x-data="{ edit: false }" class="mobile-field">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <label class="mobile-field-label">
                                <i class="bi bi-telephone me-1"></i> Nomor Telepon
                            </label>
                            <div x-show="!edit">
                                <p class="mobile-field-value">{{ $number ?? 'Belum diisi' }}</p>
                            </div>
                            <div x-show="edit" style="display: none;">
                                <input type="tel" wire:model.defer="number" 
                                    class="mobile-field-input"
                                    placeholder="Masukkan nomor telepon"
                                    @keydown.enter="$wire.updateProfile(); edit = false"
                                    @blur="$wire.updateProfile(); edit = false"
                                    x-ref="phoneInput">
                            </div>
                        </div>
                        <button class="mobile-edit-btn-field" @click="edit = !edit; if(edit) $nextTick(() => $refs.phoneInput.focus())">
                            <i class="bi" :class="edit ? 'bi-check-lg' : 'bi-pencil'"></i>
                        </button>
                    </div>
                </div>

                <div x-data="{ edit: false }" class="mobile-field">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <label class="mobile-field-label">
                                <i class="bi bi-geo-alt me-1"></i> Lokasi
                            </label>
                            <div x-show="!edit">
                                <p class="mobile-field-value">{{ $location ?? 'Belum diisi' }}</p>
                            </div>
                            <div x-show="edit" style="display: none;">
                                <input type="text" wire:model.defer="location" 
                                    class="mobile-field-input"
                                    placeholder="Masukkan lokasi"
                                    @keydown.enter="$wire.updateProfile(); edit = false"
                                    @blur="$wire.updateProfile(); edit = false"
                                    x-ref="locationInput">
                            </div>
                        </div>
                        <button class="mobile-edit-btn-field" @click="edit = !edit; if(edit) $nextTick(() => $refs.locationInput.focus())">
                            <i class="bi" :class="edit ? 'bi-check-lg' : 'bi-pencil'"></i>
                        </button>
                    </div>
                </div>

            @elseif($activeTab === 'wahana')
                <!-- Wahana Tab Mobile -->
                <div class="mb-3">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-controller me-2"></i>
                        Antrian Wahana Anda
                    </h5>
                </div>
                
                @if($userAttractions->count() > 0)
                    @foreach($userAttractions as $userAttraction)
                        <div class="mobile-queue-card">
                            <div class="mobile-queue-header">
                                <div class="mobile-queue-icon bg-primary bg-opacity-10">
                                    <i class="bi bi-controller text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mobile-queue-title">{{ $userAttraction->attraction->name }}</h6>
                                    <p class="mobile-queue-location">
                                        <i class="bi bi-geo-alt-fill me-1"></i>
                                        {{ $userAttraction->attraction->location }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mobile-queue-datetime">
                                <span class="mobile-queue-badge bg-light text-dark">
                                    <i class="bi bi-calendar-fill me-1"></i>
                                    {{ $userAttraction->reservation_date->format('d M Y') }}
                                </span>
                                <span class="mobile-queue-badge bg-light text-dark">
                                    <i class="bi bi-clock-fill me-1"></i>
                                    {{ $userAttraction->reservation_time ? $userAttraction->reservation_time->format('H:i') : 'Flexible' }}
                                </span>
                            </div>
                            
                            <div class="mobile-queue-footer">
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
                                <small class="text-muted mt-2 d-block">
                                    <i class="bi bi-clock me-1"></i>
                                    Est. {{ $userAttraction->attraction->getEstimatedWaitingTime($userAttraction->queue_position) }} menit
                                </small>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="mobile-empty-state">
                        <i class="bi bi-exclamation-circle mobile-empty-icon"></i>
                        <h6 class="fw-bold text-dark mb-2">Tidak ada antrian wahana</h6>
                        <p class="text-muted mb-3">Anda belum mengantri di wahana manapun hari ini.</p>
                        <a href="{{ route('attractions') }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="bi bi-plus-circle me-1"></i>Cari Wahana
                        </a>
                    </div>
                @endif

            @elseif($activeTab === 'restoran')
                <!-- Restoran Tab Mobile -->
                <div class="mb-3">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-cup-hot me-2"></i>
                        Antrian Restoran Anda
                    </h5>
                </div>
                
                @if($userRestaurants->count() > 0)
                    @foreach($userRestaurants as $userRestaurant)
                        <div class="mobile-queue-card">
                            <div class="mobile-queue-header">
                                <div class="mobile-queue-icon bg-success bg-opacity-10">
                                    <i class="bi bi-cup-hot text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mobile-queue-title">{{ $userRestaurant->restaurant->name }}</h6>
                                    <p class="mobile-queue-location">
                                        <i class="bi bi-geo-alt-fill me-1"></i>
                                        {{ $userRestaurant->restaurant->location }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mobile-queue-datetime">
                                <span class="mobile-queue-badge bg-light text-dark">
                                    <i class="bi bi-calendar-fill me-1"></i>
                                    {{ $userRestaurant->reservation_date->format('d M Y') }}
                                </span>
                                <span class="mobile-queue-badge bg-light text-dark">
                                    <i class="bi bi-clock-fill me-1"></i>
                                    {{ $userRestaurant->reservation_time ? $userRestaurant->reservation_time->format('H:i') : 'Flexible' }}
                                </span>
                            </div>
                            
                            <div class="mobile-queue-footer">
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
                                <small class="text-muted mt-2 d-block">
                                    <i class="bi bi-clock me-1"></i>
                                    Est. {{ $userRestaurant->restaurant->getEstimatedWaitingTime($userRestaurant->queue_position) }} menit
                                </small>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="mobile-empty-state">
                        <i class="bi bi-exclamation-circle mobile-empty-icon"></i>
                        <h6 class="fw-bold text-dark mb-2">Tidak ada antrian restoran</h6>
                        <p class="text-muted mb-3">Anda belum mengantri di restoran manapun hari ini.</p>
                        <a href="{{ route('queues.index') }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="bi bi-plus-circle me-1"></i>Cari Restoran
                        </a>
                    </div>
                @endif
                @endif
        </div>

        <!-- Hidden file input for mobile -->
        <input type="file" id="avatarInputMobile" wire:model="newAvatar" accept="image/*" style="display: none;">
    </div>

</div>
