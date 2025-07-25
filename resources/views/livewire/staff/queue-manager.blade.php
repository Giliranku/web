@push('styles')
<style>
    .queue-item {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .queue-item.waiting {
        border-left-color: #ffc107;
        background-color: rgba(255, 193, 7, 0.05);
    }
    
    .queue-item.called {
        border-left-color: #0dcaf0;
        background-color: rgba(13, 202, 240, 0.05);
        animation: pulse-called 2s infinite;
    }
    
    .queue-item.served {
        border-left-color: #198754;
        background-color: rgba(25, 135, 84, 0.05);
        opacity: 0.7;
    }
    
    .queue-item.cancelled {
        border-left-color: #dc3545;
        background-color: rgba(220, 53, 69, 0.05);
        opacity: 0.5;
    }
    
    @keyframes pulse-called {
        0% { box-shadow: 0 0 0 0 rgba(13, 202, 240, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(13, 202, 240, 0); }
        100% { box-shadow: 0 0 0 0 rgba(13, 202, 240, 0); }
    }
    
    .queue-position {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        color: white;
    }
    
    .queue-position.waiting { background: #ffc107; }
    .queue-position.called { background: #0dcaf0; }
    .queue-position.served { background: #198754; }
    .queue-position.cancelled { background: #dc3545; }
    
    .stats-card {
        border: none;
        border-radius: 15px;
        transition: transform 0.2s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-2px);
    }

    /* Custom Modal Styles */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }
    
    .modal-header {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        border-radius: 15px 15px 0 0;
        border-bottom: none;
    }
    
    .modal-body {
        padding: 2rem;
    }
    
    .cancel-icon {
        font-size: 4rem;
        color: #dc3545;
        margin-bottom: 1rem;
    }
</style>
@endpush

<div class="container-fluid">
    <!-- Header -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <h2 class="h3 fw-semibold text-dark mb-1">
                        Manajemen Antrian - {{ $location->name ?? 'Unknown Location' }}
                    </h2>
                    <p class="text-muted mb-0">
                        Kelola antrian {{ $type === 'attraction' ? 'wahana' : 'restoran' }} untuk tanggal yang dipilih
                    </p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <input 
                        type="date" 
                        wire:model.live="selected_date"
                        class="form-control"
                        style="width: auto;"
                    >
                    <div class="btn-group">
                        <button 
                            wire:click="callNextBatch"
                            class="btn btn-primary"
                            @if(collect($queues)->where('status', 'waiting')->isEmpty()) disabled @endif
                        >
                            <i class="fas fa-bell me-2"></i>
                            Panggil 1 Grup Permainan ({{ $location->players_per_round ?? 1 }} orang)
                        </button>
                        <button 
                            wire:click="markServedBatch"
                            class="btn btn-success"
                            @if(collect($queues)->where('status', 'called')->isEmpty()) disabled @endif
                        >
                            <i class="fas fa-check-double me-2"></i>
                            Selesai per Grup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card bg-primary bg-opacity-10 h-100">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-users" style="font-size: 2rem; color: var(--bs-primary);"></i>
                    </div>
                    <div class="small fw-medium text-muted">Total Antrian</div>
                    <div class="h2 fw-bold text-dark">{{ count($queues) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card bg-warning bg-opacity-10 h-100">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-clock" style="font-size: 2rem; color: var(--bs-warning);"></i>
                    </div>
                    <div class="small fw-medium text-muted">Menunggu</div>
                    <div class="h2 fw-bold text-warning">{{ collect($queues)->where('status', 'waiting')->count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card bg-info bg-opacity-10 h-100">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-bell" style="font-size: 2rem; color: var(--bs-info);"></i>
                    </div>
                    <div class="small fw-medium text-muted">Dipanggil</div>
                    <div class="h2 fw-bold text-info">{{ collect($queues)->where('status', 'called')->count() }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card bg-success bg-opacity-10 h-100">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-check-circle" style="font-size: 2rem; color: var(--bs-success);"></i>
                    </div>
                    <div class="small fw-medium text-muted">Selesai</div>
                    <div class="h2 fw-bold text-success">{{ collect($queues)->where('status', 'served')->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Queue List -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h3 class="h5 fw-medium text-dark mb-4">
                <i class="fas fa-list me-2"></i>Daftar Antrian
            </h3>
            
            @if(empty($queues))
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-users" style="font-size: 4rem; color: #dee2e6;"></i>
                    </div>
                    <div class="text-muted h5">Tidak ada antrian untuk tanggal ini</div>
                    <p class="text-muted">Belum ada pengunjung yang membuat antrian.</p>
                </div>
            @else
                <div id="queue-list" class="d-grid gap-3">
                    @foreach($queues as $queue)
                        <div 
                            data-queue-id="{{ $queue['id'] }}"
                            class="queue-item {{ $queue['status'] }} card border-0 shadow-sm"
                        >
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <!-- Queue Position Circle -->
                                    <div class="queue-position {{ $queue['status'] }} me-3">
                                        {{ $queue['queue_position'] ?? '0' }}
                                    </div>
                                    
                                    <!-- Queue Info -->
                                    <div class="flex-grow-1">
                                        <div class="fw-bold text-dark h5 mb-1">
                                            {{ $queue['user']['name'] ?? 'Unknown User' }}
                                        </div>
                                        <div class="small text-muted d-flex flex-wrap align-items-center gap-3">
                                            <span>
                                                <i class="fas fa-hashtag me-1"></i>
                                                Slot: {{ $queue['slot_number'] }}
                                            </span>
                                            <span>
                                                <i class="fas fa-clock me-1"></i>
                                                {{ $queue['reservation_time'] ?? 'Tidak ditentukan' }}
                                            </span>
                                            <span>
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ \Carbon\Carbon::parse($queue['reservation_date'])->format('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span class="badge 
                                                {{ $queue['status'] === 'waiting' ? 'bg-warning text-dark' : '' }}
                                                {{ $queue['status'] === 'called' ? 'bg-info text-white' : '' }}
                                                {{ $queue['status'] === 'served' ? 'bg-success text-white' : '' }}
                                                {{ $queue['status'] === 'cancelled' ? 'bg-danger text-white' : '' }}
                                                px-3 py-2">
                                                <i class="fas 
                                                    {{ $queue['status'] === 'waiting' ? 'fa-clock' : '' }}
                                                    {{ $queue['status'] === 'called' ? 'fa-bell' : '' }}
                                                    {{ $queue['status'] === 'served' ? 'fa-check-circle' : '' }}
                                                    {{ $queue['status'] === 'cancelled' ? 'fa-times-circle' : '' }}
                                                    me-1"></i>
                                                {{ ucfirst($queue['status']) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="d-flex gap-2 ms-3">
                                        @if($queue['status'] === 'waiting')
                                            <button 
                                                wire:click="callNext"
                                                class="btn btn-info"
                                                title="Panggil antrian ini"
                                            >
                                                <i class="fas fa-bell me-1"></i>
                                                Panggil
                                            </button>
                                        @endif
                                        
                                        @if(in_array($queue['status'], ['waiting', 'called']))
                                            <button 
                                                class="btn btn-outline-danger"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#cancelModal{{ $queue['id'] }}"
                                                title="Batalkan antrian"
                                            >
                                                <i class="fas fa-times me-1"></i>
                                                Batal
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Cancel Confirmation Modal -->
                        @if(in_array($queue['status'], ['waiting', 'called']))
                        <div class="modal fade" id="cancelModal{{ $queue['id'] }}" tabindex="-1" aria-labelledby="cancelModalLabel{{ $queue['id'] }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelModalLabel{{ $queue['id'] }}">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Konfirmasi Pembatalan
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <div class="cancel-icon">
                                            <i class="fas fa-user-times"></i>
                                        </div>
                                        <h5 class="mb-3">Apakah Anda yakin ingin membatalkan antrian ini?</h5>
                                        <div class="alert alert-light border">
                                            <strong>{{ $queue['user']['name'] ?? 'Unknown User' }}</strong><br>
                                            <small class="text-muted">Posisi antrian: {{ $queue['queue_position'] }}</small>
                                        </div>
                                        <p class="text-muted">
                                            Tindakan ini tidak dapat dibatalkan. Pengunjung akan kehilangan posisi antrian mereka.
                                        </p>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                            <i class="fas fa-arrow-left me-2"></i>
                                            Tidak, Kembali
                                        </button>
                                        <button 
                                            type="button" 
                                            class="btn btn-danger px-4" 
                                            wire:click="cancelQueue({{ $queue['id'] }})"
                                            data-bs-dismiss="modal"
                                        >
                                            <i class="fas fa-ban me-2"></i>
                                            Ya, Batalkan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    $wire.on('queue-updated', (data) => {
        if (data && data[0] && data[0].message) {
            // Show toast notification
            showToast(data[0].message, 'success');
        }
    });
    
    function showToast(message, type = 'info') {
        // Simple toast notification
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 1055; min-width: 300px;';
        toast.innerHTML = `
            <i class="fas fa-info-circle me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(toast);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 3000);
    }
    
    // Auto refresh queue every 30 seconds
    setInterval(() => {
        $wire.call('loadQueues');
    }, 30000);
    
    // Update time display
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { 
            hour: '2-digit', 
            minute: '2-digit',
            hour12: false 
        });
        
        // Update any time displays if they exist
        const timeElements = document.querySelectorAll('.current-time');
        timeElements.forEach(element => {
            element.textContent = timeString;
        });
    }
    
    // Update time every second
    setInterval(updateTime, 1000);
    updateTime();
</script>
@endpush
