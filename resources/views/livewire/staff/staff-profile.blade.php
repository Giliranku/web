<div>
@push('styles')
<style>
:root {
    --primary-color: #4ABDAC;
    --secondary-color: #FC4A1A;
    --warning-color: #F7B733;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
    --light-color: #f8f9fa;
    --dark-color: #343a40;
    --border-radius: 20px;
    --shadow-sm: 0 4px 16px rgba(0,0,0,0.05);
    --shadow-md: 0 8px 32px rgba(0,0,0,0.08);
    --shadow-lg: 0 16px 48px rgba(0,0,0,0.12);
    --gradient-primary: linear-gradient(135deg, #4ABDAC 0%, #2ECC71 100%);
    --gradient-secondary: linear-gradient(135deg, #FC4A1A 0%, #E74C3C 100%);
    --gradient-warning: linear-gradient(135deg, #F7B733 0%, #F39C12 100%);
    --gradient-bg-restaurant: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
    --gradient-bg-attraction: linear-gradient(135deg, #a8edea 0%, #fed6e3 50%, #d299c2 100%);
}

.staff-profile-page {
    min-height: 100vh;
    padding: 2rem;
}

.staff-profile-page.restaurant {
    background: var(--gradient-bg-restaurant);
}

.staff-profile-page.attraction {
    background: var(--gradient-bg-attraction);
}

.glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
}

.profile-header {
    padding: 2.5rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.profile-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 100%;
    background: var(--gradient-warning);
    opacity: 0.08;
    border-radius: 0 var(--border-radius) var(--border-radius) 0;
    transform: skewX(-15deg);
}

.profile-header.attraction::before {
    background: var(--gradient-primary);
}

.profile-header.restaurant::before {
    background: var(--gradient-secondary);
}

.staff-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 6px solid rgba(247, 183, 51, 0.2);
    object-fit: cover;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: var(--shadow-md);
}

.staff-avatar.attraction {
    border-color: rgba(74, 189, 172, 0.2);
}

.staff-avatar.restaurant {
    border-color: rgba(252, 74, 26, 0.2);
}

.staff-avatar:hover {
    transform: scale(1.05) rotate(3deg);
    box-shadow: var(--shadow-lg);
}

.staff-avatar.attraction:hover {
    border-color: var(--primary-color);
}

.staff-avatar.restaurant:hover {
    border-color: var(--secondary-color);
}

.avatar-upload-btn {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 40px;
    height: 40px;
    background: var(--gradient-warning);
    border: 4px solid white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: white;
    box-shadow: var(--shadow-md);
}

.avatar-upload-btn.attraction {
    background: var(--gradient-primary);
}

.avatar-upload-btn.restaurant {
    background: var(--gradient-secondary);
}

.avatar-upload-btn:hover {
    transform: scale(1.15) rotate(15deg);
}

.staff-badge {
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.95rem;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
}

.staff-badge.attraction {
    background: var(--gradient-primary);
}

.staff-badge.restaurant {
    background: var(--gradient-secondary);
}

.staff-badge:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.location-info {
    background: rgba(74, 189, 172, 0.08);
    border-radius: 15px;
    padding: 1.5rem;
    border-left: 5px solid var(--primary-color);
    backdrop-filter: blur(10px);
    box-shadow: var(--shadow-sm);
}

.location-info.restaurant {
    background: rgba(252, 74, 26, 0.08);
    border-left-color: var(--secondary-color);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 2.5rem;
}

.stat-card {
    padding: 2rem;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
}

.stat-card.today::before { background: var(--info-color); }
.stat-card.waiting::before { background: var(--gradient-warning); }
.stat-card.served::before { background: linear-gradient(90deg, #28a745, #20c997); }
.stat-card.cancelled::before { background: var(--gradient-secondary); }

.stat-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: var(--shadow-lg);
}

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
    position: relative;
}

.stat-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 20px;
    opacity: 0.1;
    background: white;
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon::before {
    opacity: 0.2;
    transform: scale(1.1);
}

.stat-icon.today { background: var(--info-color); }
.stat-icon.waiting { background: var(--warning-color); }
.stat-icon.served { background: var(--success-color); }
.stat-icon.cancelled { background: var(--danger-color); }

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--dark-color);
    margin-bottom: 0.5rem;
    line-height: 1;
}

.stat-label {
    font-size: 1rem;
    color: #6c757d;
    font-weight: 500;
    margin: 0;
}

.content-tabs {
    padding: 0;
    overflow: hidden;
}

.nav-tabs {
    border: none;
    background: rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
    padding: 0.5rem;
    border-radius: var(--border-radius) var(--border-radius) 0 0;
    margin: 0;
}

.nav-tabs .nav-link {
    border: none;
    background: transparent;
    color: #6c757d;
    font-weight: 600;
    padding: 1.25rem 2rem;
    transition: all 0.3s ease;
    border-radius: 15px;
    margin: 0 0.25rem;
}

.nav-tabs .nav-link.active {
    background: white;
    color: var(--warning-color);
    box-shadow: var(--shadow-sm);
    transform: translateY(-2px);
}

.nav-tabs .nav-link.active.attraction {
    color: var(--primary-color);
}

.nav-tabs .nav-link.active.restaurant {
    color: var(--secondary-color);
}

.nav-tabs .nav-link:hover:not(.active) {
    color: var(--warning-color);
    background: rgba(247, 183, 51, 0.1);
    transform: translateY(-1px);
}

.tab-content {
    padding: 2.5rem;
    background: white;
    border-radius: 0 0 var(--border-radius) var(--border-radius);
}

.form-floating {
    margin-bottom: 2rem;
}

.form-floating .form-control {
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 1.25rem 1rem;
    font-size: 1.05rem;
    transition: all 0.3s ease;
    background: rgba(248, 249, 250, 0.5);
}

.form-floating .form-control:focus {
    border-color: var(--warning-color);
    box-shadow: 0 0 0 0.25rem rgba(247, 183, 51, 0.15);
    background: white;
    transform: translateY(-2px);
}

.form-floating .form-control:focus.attraction {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(74, 189, 172, 0.15);
}

.form-floating .form-control:focus.restaurant {
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 0.25rem rgba(252, 74, 26, 0.15);
}

.form-floating label {
    color: #6c757d;
    font-weight: 500;
}

.btn-staff {
    border: none;
    border-radius: 15px;
    padding: 1.25rem 2.5rem;
    font-weight: 700;
    color: white;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: var(--shadow-sm);
    font-size: 1.05rem;
}

.btn-staff.attraction {
    background: var(--gradient-primary);
}

.btn-staff.restaurant {
    background: var(--gradient-secondary);
}

.btn-staff.danger {
    background: var(--gradient-secondary);
}

.btn-staff:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
    color: white;
}

.refresh-btn {
    background: rgba(255, 255, 255, 0.9);
    color: var(--warning-color);
    border: 2px solid rgba(247, 183, 51, 0.2);
    border-radius: 15px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.refresh-btn.attraction {
    color: var(--primary-color);
    border-color: rgba(74, 189, 172, 0.2);
}

.refresh-btn.restaurant {
    color: var(--secondary-color);
    border-color: rgba(252, 74, 26, 0.2);
}

.refresh-btn:hover {
    background: var(--warning-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.refresh-btn.attraction:hover {
    background: var(--primary-color);
}

.refresh-btn.restaurant:hover {
    background: var(--secondary-color);
}

.alert-custom {
    border: none;
    border-radius: 15px;
    padding: 1.25rem 1.75rem;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
    box-shadow: var(--shadow-sm);
}

.alert-success-custom {
    background: linear-gradient(135deg, rgba(212, 237, 218, 0.9), rgba(195, 230, 203, 0.9));
    color: #155724;
    border-left: 5px solid #28a745;
}

.alert-danger-custom {
    background: linear-gradient(135deg, rgba(248, 215, 218, 0.9), rgba(241, 185, 188, 0.9));
    color: #721c24;
    border-left: 5px solid #dc3545;
}

.alert-info-custom {
    background: linear-gradient(135deg, rgba(209, 236, 241, 0.9), rgba(173, 216, 230, 0.9));
    color: #0c5460;
    border-left: 5px solid #17a2b8;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-title i {
    color: var(--warning-color);
}

.section-title.attraction i {
    color: var(--primary-color);
}

.section-title.restaurant i {
    color: var(--secondary-color);
}

@media (max-width: 768px) {
    .staff-profile-page {
        padding: 1rem;
    }
    
    .profile-header {
        padding: 1.5rem;
        text-align: center;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .nav-tabs .nav-link {
        padding: 1rem;
        font-size: 0.9rem;
    }
    
    .tab-content {
        padding: 1.5rem;
    }
    
    .staff-avatar {
        width: 100px;
        height: 100px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}

@media (max-width: 576px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .stat-number {
        font-size: 1.75rem;
    }
}
</style>
@endpush

<div class="staff-profile-page {{ $type }}">
    <div class="container-fluid">
        {{-- Profile Header --}}
        <div class="profile-header glass-card {{ $type }}">
            <div class="row align-items-center">
                <div class="col-md-auto">
                    <div class="position-relative d-inline-block">
                        @if($avatar)
                            @if(str_contains($avatar, 'http'))
                                <img src="{{ $avatar }}" alt="Staff Avatar" class="staff-avatar {{ $type }}">
                            @else
                                <img src="{{ asset('storage/' . $avatar) }}" alt="Staff Avatar" class="staff-avatar {{ $type }}">
                            @endif
                        @else
                            <div class="staff-avatar {{ $type }} d-flex align-items-center justify-content-center bg-light">
                                <i class="bi bi-person-fill" style="font-size: 3rem; color: var(--{{ $type === 'attraction' ? 'primary' : 'secondary' }}-color);"></i>
                            </div>
                        @endif
                        
                        <label for="avatar-upload" class="avatar-upload-btn {{ $type }}">
                            <i class="bi bi-camera-fill"></i>
                        </label>
                        <input type="file" id="avatar-upload" wire:model="newAvatar" accept="image/*" style="display: none;">
                    </div>
                </div>
                <div class="col-md">
                    <div class="d-flex flex-column flex-md-row align-items-md-start justify-content-between">
                        <div class="flex-grow-1">
                            <h1 class="mb-3 fw-bold text-dark" style="font-size: 2.5rem;">{{ $name }}</h1>
                            <p class="text-muted mb-3 fs-5">{{ $email }}</p>
                            <div class="d-flex flex-column flex-md-row gap-3 align-items-start">
                                <div class="staff-badge {{ $type }}">
                                    <i class="bi bi-{{ $type === 'attraction' ? 'geo-alt' : 'cup-hot' }}-fill"></i>
                                    {{ ucfirst($type) }} Staff
                                </div>
                                @if($location)
                                    <div class="location-info {{ $type }}">
                                        <strong style="font-size: 1.1rem;">{{ $location->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $location->location }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 mt-md-0">
                            <button class="btn refresh-btn {{ $type }}" wire:click="loadStats">
                                <i class="bi bi-arrow-clockwise me-2"></i>
                                Refresh Stats
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if (session()->has('message'))
            <div class="alert alert-success-custom">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger-custom">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Upload Progress --}}
        @if($uploading)
            <div class="alert alert-info-custom">
                <i class="bi bi-cloud-arrow-up me-2"></i>
                Mengupload foto profil...
            </div>
        @endif

        {{-- Statistics Grid --}}
        <div class="stats-grid">
            <div class="stat-card glass-card today">
                <div class="stat-icon today">
                    <i class="bi bi-calendar-day"></i>
                </div>
                <h3 class="stat-number">{{ number_format($todayQueue) }}</h3>
                <p class="stat-label">Queue Hari Ini</p>
            </div>

            <div class="stat-card glass-card waiting">
                <div class="stat-icon waiting">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h3 class="stat-number">{{ number_format($totalWaiting) }}</h3>
                <p class="stat-label">Sedang Menunggu</p>
            </div>

            <div class="stat-card glass-card served">
                <div class="stat-icon served">
                    <i class="bi bi-check-circle"></i>
                </div>
                <h3 class="stat-number">{{ number_format($totalServed) }}</h3>
                <p class="stat-label">Telah Dilayani</p>
            </div>

            <div class="stat-card glass-card cancelled">
                <div class="stat-icon cancelled">
                    <i class="bi bi-x-circle"></i>
                </div>
                <h3 class="stat-number">{{ number_format($totalCancelled) }}</h3>
                <p class="stat-label">Dibatalkan</p>
            </div>
        </div>

        {{-- Content Tabs --}}
        <div class="content-tabs glass-card">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab === 'profile' ? 'active ' . $type : '' }}" 
                            wire:click="setActiveTab('profile')" 
                            type="button">
                        <i class="bi bi-person me-2"></i>Edit Profile
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $activeTab === 'security' ? 'active ' . $type : '' }}" 
                            wire:click="setActiveTab('security')" 
                            type="button">
                        <i class="bi bi-shield-lock me-2"></i>Security
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                {{-- Profile Edit Tab --}}
                @if($activeTab === 'profile')
                    <div class="tab-pane fade show active">
                        <h4 class="section-title {{ $type }}">
                            <i class="bi bi-person-gear"></i>
                            Profile Information
                        </h4>
                        
                        <form wire:submit.prevent="updateProfile">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control {{ $type }}" id="name" wire:model="name" placeholder="Full Name">
                                        <label for="name">Full Name</label>
                                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control {{ $type }}" id="email" wire:model="email" placeholder="Email">
                                        <label for="email">Email Address</label>
                                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-staff {{ $type }}">
                                    <i class="bi bi-check-lg me-2"></i>Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                {{-- Security Tab --}}
                @if($activeTab === 'security')
                    <div class="tab-pane fade show active">
                        <h4 class="section-title {{ $type }}">
                            <i class="bi bi-shield-lock"></i>
                            Change Password
                        </h4>
                        
                        <form wire:submit.prevent="updatePassword">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control {{ $type }}" id="password" wire:model="password" placeholder="New Password">
                                        <label for="password">New Password</label>
                                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control {{ $type }}" id="password_confirmation" wire:model="password_confirmation" placeholder="Confirm Password">
                                        <label for="password_confirmation">Confirm Password</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-staff danger">
                                    <i class="bi bi-shield-check me-2"></i>Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
