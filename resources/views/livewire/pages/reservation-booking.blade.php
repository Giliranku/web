@push('styles')
<style>
    .queue-quantity-selector {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }
    
    .quantity-btn {
        width: 35px;
        height: 35px;
        border: 1px solid #dee2e6;
        background: #f8f9fa;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .quantity-btn:hover {
        background: #e9ecef;
        border-color: #adb5bd;
    }
    
    .quantity-input {
        width: 60px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 8px;
        font-weight: bold;
    }
    
    .instant-badge {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }
    
    .ticket-card {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .ticket-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .ticket-card.selected {
        border-color: #007bff !important;
        background-color: rgba(0, 123, 255, 0.1) !important;
    }
</style>
@endpush

<div class="container py-4">
    <!-- Header -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="h3 fw-semibold  mb-2">
                        Antrian Instan - {{ $location->name ?? 'Unknown Location' }}
                    </h2>
                    <p class="text-muted mb-0">
                        Buat antrian {{ $type === 'attraction' ? 'wahana' : 'restoran' }} langsung dengan waktu sekarang
                    </p>
                </div>
                <div class="instant-badge">
                    <i class="fas fa-bolt"></i>
                    Antrian Instan
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Current Date & Time Info -->
    <div class="card shadow-sm border-0 mb-4 bg-body">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-1 fw-semibold text-primary">
                        <i class="fas fa-calendar-day me-2"></i>Hari Ini
                    </h5>
                    <p class="mb-0 text-muted">{{ \Carbon\Carbon::today()->format('d F Y') }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5 class="mb-1 fw-semibold text-success">
                        <i class="fas fa-clock me-2"></i>Waktu Sekarang
                    </h5>
                    <p class="mb-0 text-muted" id="current-time">{{ \Carbon\Carbon::now()->format('H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Queue Information -->
    @auth
        @if(!empty($user_current_queues))
            <div class="card shadow-sm border-0 mb-4 border-warning">
                <div class="card-header bg-warning ">
                    <h6 class="mb-0 fw-semibold">
                        <i class="fas fa-info-circle me-2"></i>Antrian Anda Saat Ini
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($user_current_queues as $queue)
                        <div class="d-flex justify-content-between align-items-center mb-2 @if(!$loop->last) border-bottom pb-2 @endif">
                            <div>
                                <strong>{{ $queue['location_name'] }}</strong>
                                <span class="badge bg-secondary ms-2">Posisi {{ $queue['queue_position'] }}</span>
                            </div>
                            <div class="text-end">
                                <div class="text-primary fw-semibold">
                                    ~{{ $queue['estimated_wait_time'] }} menit
                                </div>
                                <small class="text-muted">{{ $queue['rounds_to_wait'] }} grup permainan</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($estimated_wait_time > 0 && $can_queue)
            <div class="card shadow-sm border-0 mb-4 border-info">
                <div class="card-body text-center">
                    <h6 class="text-primary mb-2">
                        <i class="fas fa-clock me-2"></i>Estimasi Waktu Tunggu
                    </h6>
                    <div class="display-6 text-info fw-bold">~{{ $estimated_wait_time }} menit</div>
                    <small class="text-muted">
                        Berdasarkan {{ ceil(($estimated_wait_time) / ($location->estimated_time_per_round ?? 10)) }} grup permainan sebelum Anda
                    </small>
                </div>
            </div>
        @endif

        @if(!$can_queue)
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ $queue_restriction_message }}
            </div>
        @endif
    @endauth

    <!-- Ticket Selection -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h3 class="h5 fw-medium  mb-3">
                <i class="fas fa-ticket-alt me-2 text-primary"></i>Pilih Tiket
            </h3>
            
            @auth
                @if(empty($user_tickets))
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-ticket-alt" style="font-size: 3rem; color: var(--bs-gray-300);"></i>
                        </div>
                        <div class="text-muted mb-3 h5">Anda belum memiliki tiket</div>
                        <p class="text-muted mb-4">Untuk membuat antrian, Anda perlu memiliki tiket terlebih dahulu</p>
                        <a href="{{ route('tiket-ecommerce') }}" wire:navigate class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-shopping-cart me-2"></i>Beli Tiket Sekarang
                        </a>
                    </div>
                @else
                    <div class="d-grid gap-3">
                        @foreach($user_tickets as $ticket)
                            <div 
                                class="ticket-card border rounded-3 p-4 {{ $selected_ticket_id == $ticket['id'] ? 'selected' : '' }}"
                                wire:click="$set('selected_ticket_id', {{ $ticket['id'] }})"
                                style="cursor: pointer;"
                            >
                                <div class="form-check">
                                    <input 
                                        type="radio" 
                                        wire:model="selected_ticket_id" 
                                        value="{{ $ticket['id'] }}"
                                        class="form-check-input"
                                        id="ticket_{{ $ticket['id'] }}"
                                    >
                                    <label class="form-check-label w-100" for="ticket_{{ $ticket['id'] }}">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1 pe-2">
                                                <div class="fw-bold h5 mb-2" style="word-break: break-word;">{{ $ticket['ticket_name'] }}</div>
                                                <div class="small text-muted mb-2">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    Dibeli: {{ Carbon\Carbon::parse($ticket['purchased_date'])->format('d M Y') }}
                                                </div>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                                        <i class="fas fa-ticket-alt me-1"></i>
                                                        Total: {{ $ticket['total_quantity'] }}
                                                    </span>
                                                    <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">
                                                        <i class="fas fa-check me-1"></i>
                                                        <span class="d-none d-sm-inline">Dapat digunakan untuk </span>Antrian
                                                    </span>
                                                    @if($ticket['used_quantity'] > 0)
                                                        <span class="badge bg-info bg-opacity-10 text-info px-2 py-1">
                                                            <i class="fas fa-door-open me-1"></i>
                                                            {{ $ticket['used_quantity'] }} <span class="d-none d-sm-inline">sudah </span>masuk<span class="d-none d-sm-inline"> taman</span>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($selected_ticket_id == $ticket['id'])
                                            <div class="queue-quantity-selector mt-3 pt-3 border-top">
                                                <div class="mb-2">
                                                    <label class="fw-medium text-body-emphasis">
                                                        <span class="d-none d-sm-inline">Jumlah </span>Antrian:
                                                    </label>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button 
                                                        type="button"
                                                        class="quantity-btn" 
                                                        wire:click="$set('queue_quantity', {{ max(1, $this->queue_quantity - 1) }})"
                                                        @if($queue_quantity <= 1) disabled @endif
                                                    >
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    
                                                    <input 
                                                        type="number" 
                                                        wire:model.live="queue_quantity" 
                                                        min="1" 
                                                        max="{{ $total_available_tickets }}"
                                                        class="quantity-input"
                                                    >
                                                    
                                                    <button 
                                                        type="button"
                                                        class="quantity-btn" 
                                                        wire:click="$set('queue_quantity', {{ min($total_available_tickets, $this->queue_quantity + 1) }})"
                                                        @if($queue_quantity >= $total_available_tickets) disabled @endif
                                                    >
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="small text-muted mt-1">
                                                    <span class="d-none d-sm-inline">Maksimal: {{ $total_available_tickets }} - Total semua tiket</span>
                                                    <span class="d-sm-none">Maks: {{ $total_available_tickets }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Total Available Tickets Summary -->
                    <div class="mt-4 p-3 bg-info bg-opacity-10 border border-info border-opacity-25 rounded-3">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-info me-2"></i>
                                <span class="fw-medium text-info">
                                    <span class="d-none d-sm-inline">Total Tiket untuk </span>Antrian
                                </span>
                            </div>
                            <span class="badge bg-info bg-opacity-20 text-light px-3 py-2 fs-6">
                                {{ $total_available_tickets }} tiket
                            </span>
                        </div>
                        <div class="small text-muted mt-2">
                            <span class="d-none d-md-inline">Semua tiket bersifat universal dan dapat digunakan berulang kali untuk mengantri di wahana atau restoran manapun.</span>
                            <span class="d-md-none">Tiket universal untuk semua wahana & restoran.</span>
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-sign-in-alt" style="font-size: 3rem; color: var(--bs-gray-300);"></i>
                    </div>
                    <div class="text-muted mb-3 h5">Silakan login untuk melakukan antrian</div>
                    <a href="{{ route('login') }}" wire:navigate class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                </div>
            @endauth
        </div>
    </div>
    <!-- Submit Button -->
    @auth
        @if(!empty($user_tickets))
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <button 
                        wire:click="makeReservation"
                        wire:loading.attr="disabled"
                        class="btn btn-success btn-lg w-100 py-3 fw-bold {{ !$selected_ticket_id || $queue_quantity < 1 || !$can_queue ? 'disabled' : '' }}"
                        @if(!$selected_ticket_id || $queue_quantity < 1 || !$can_queue) disabled @endif
                    >
                        <span wire:loading.remove>
                            <i class="fas fa-plus-circle me-2"></i>
                            @if($can_queue)
                                Buat {{ $queue_quantity ?? 1 }} Antrian Sekarang
                            @else
                                Tidak Dapat Mengantri
                            @endif
                        </span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Memproses Antrian...
                        </span>
                    </button>
                    
                    @if($selected_ticket_id && $queue_quantity >= 1)
                        <div class="mt-4 p-4 bg-body-secondary rounded-3">
                            <div class="text-center">
                                <div class="fw-bold mb-2 text-primary h5">
                                    <i class="fas fa-info-circle me-2"></i>Ringkasan Antrian
                                </div>
                                <div class="row g-3 text-start">
                                    <div class="col-md-4">
                                        <div class="small text-muted">Lokasi:</div>
                                        <div class="fw-medium">{{ $location->name }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="small text-muted">Tanggal & Waktu:</div>
                                        <div class="fw-medium">{{ \Carbon\Carbon::today()->format('d M Y') }}, Sekarang</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="small text-muted">Jumlah Antrian:</div>
                                        <div class="fw-medium text-success">{{ $queue_quantity ?? 1 }} antrian</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endauth
</div>

@push('scripts')
<script>
    // Update current time every second
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { 
            hour: '2-digit', 
            minute: '2-digit',
            hour12: false 
        });
        
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = timeString;
        }
    }
    
    // Update time immediately and then every second
    updateTime();
    setInterval(updateTime, 1000);
    
    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('livewire:navigated', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endpush
