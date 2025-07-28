<div 
    class="position-fixed queue-floating-widget"
    style="bottom: 100px; right: 16px; z-index: 1049;"
    wire:poll.30s="loadQueueData"
>
    @auth
        @if($hasTickets)
            @if($totalActiveQueues > 0)
                <!-- Floating Queue Button -->
                <div class="position-relative">
                    <button 
                        class="btn btn-warning rounded-circle shadow-lg queue-toggle-btn"
                        style="width: 60px; height: 60px; border: none;"
                        wire:click="$toggle('isOpen')"
                        aria-label="Lihat Antrian Aktif"
                    >
                        <i class="bi bi-clock-history text-white" style="font-size: 1.4rem;"></i>
                    </button>
                    
                    <!-- Queue Count Badge -->
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $totalActiveQueues }}
                        <span class="visually-hidden">antrian aktif</span>
                    </span>
                </div>
            @else
                <!-- No Active Queues - Show Information Button -->
                <div class="position-relative">
                    <button 
                        class="btn btn-outline-secondary rounded-circle shadow-sm queue-info-btn"
                        style="width: 50px; height: 50px; border: 2px solid var(--bs-secondary); opacity: 0.7;"
                        wire:click="$toggle('isOpen')"
                        aria-label="Info Antrian"
                        title="Klik untuk info antrian"
                    >
                        <i class="bi bi-info text-secondary" style="font-size: 1.2rem;"></i>
                    </button>
                </div>
            @endif

            <!-- Queue Details Panel -->
            @if($isOpen)
                <div 
                    class="queue-panel position-absolute bg-body rounded-4 shadow-lg border border-opacity-25"
                    style="bottom: 75px; left: -300px; right: 0; width: auto; max-width: 380px; margin-left: auto; max-height: 450px; overflow-y: auto; backdrop-filter: blur(10px);"
                    wire:click.outside="$set('isOpen', false)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                >
                    @if($totalActiveQueues > 0)
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-opacity-25 bg-body-secondary rounded-top-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock-history me-3 text-warning" style="font-size: 1.5rem;"></i>
                                <h5 class="mb-0 fw-bold text-body-emphasis">Antrian Aktif</h5>
                            </div>
                            <button 
                                class="btn-close" 
                                wire:click="$set('isOpen', false)"
                                aria-label="Tutup panel antrian"
                            ></button>
                        </div>

                        <!-- Queue List -->
                        <div class="p-4">
                            @foreach($activeQueues as $queue)
                                <div class="queue-item bg-body-tertiary border rounded-3 mb-3 p-3 position-relative transition-all">
                                    <!-- Status Indicator -->
                                    <div class="position-absolute top-0 end-0 mt-3 me-3">
                                        @if($queue['status'] === 'called')
                                            <span class="badge bg-success pulse-badge">
                                                <i class="bi bi-megaphone-fill me-1"></i>Dipanggil!
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-hourglass-split me-1"></i>Menunggu
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Queue Info -->
                                    <div class="pe-5 mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi {{ $queue['type'] === 'attraction' ? 'bi-star-fill text-primary' : 'bi-cup-hot-fill text-danger' }} me-2" style="font-size: 1.1rem;"></i>
                                            <h6 class="mb-0 fw-semibold text-body-emphasis">{{ $queue['name'] }}</h6>
                                        </div>
                                        
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="small text-muted">
                                                    <i class="bi bi-people-fill me-1"></i>
                                                    Posisi: <span class="fw-medium text-body-emphasis">#{{ $queue['queue_position'] }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="small {{ $queue['status_class'] }} text-end">
                                                    <i class="bi bi-clock me-1"></i>
                                                    {{ $queue['estimated_time'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cancel Button -->
                                    @if($queue['status'] === 'waiting')
                                        <div class="d-grid">
                                            <button 
                                                class="btn btn-outline-danger btn-sm"
                                                wire:click="cancelQueue({{ $queue['id'] }}, '{{ $queue['type'] }}')"
                                                wire:confirm="Yakin ingin membatalkan antrian ini?"
                                            >
                                                <i class="bi bi-x-circle me-1"></i>Batalkan Antrian
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Footer -->
                        <div class="p-4 pt-3 border-top border-opacity-25 bg-body-secondary rounded-bottom-4 text-center">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Data diperbarui otomatis setiap 30 detik
                            </small>
                        </div>
                    @else
                        <!-- No Active Queues Info -->
                        <div class="text-center p-4">
                            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-opacity-25 bg-body-secondary rounded-top-4 mb-0">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-info-circle me-3 text-primary" style="font-size: 1.5rem;"></i>
                                    <h5 class="mb-0 fw-bold text-body-emphasis">Info Antrian</h5>
                                </div>
                                <button 
                                    class="btn-close" 
                                    wire:click="$set('isOpen', false)"
                                    aria-label="Tutup panel info"
                                ></button>
                            </div>
                            
                            <div class="p-4">
                                <div class="mb-4">
                                    <i class="bi bi-clock-history text-muted" style="font-size: 4rem;"></i>
                                </div>
                                
                                <h6 class="fw-semibold text-body-emphasis mb-3">Tidak Ada Antrian Aktif</h6>
                                <p class="text-muted mb-4" style="line-height: 1.6;">
                                    Anda belum memiliki antrian yang sedang berlangsung. 
                                    Buat antrian baru di wahana atau restoran untuk melihat status antrian Anda disini.
                                </p>
                                
                                <a href="{{ route('tiket.ecommerce') }}" class="btn btn-primary" wire:navigate>
                                    <i class="bi bi-plus-circle me-2"></i>Buat Reservasi
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        @endif
    @endauth
</div>

@push('styles')
<style>
.queue-floating-widget {
    font-family: 'Inclusive Sans', system-ui, -apple-system, sans-serif;
}

.queue-toggle-btn {
    background: linear-gradient(135deg, #F7B733 0%, #FC4A1A 100%) !important;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(247, 183, 51, 0.4);
    animation: gentle-bounce 2s infinite ease-in-out;
}

.queue-toggle-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(247, 183, 51, 0.6);
    animation-play-state: paused;
}

@keyframes gentle-bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-3px);
    }
}

.queue-info-btn {
    transition: all 0.3s ease;
}

.queue-info-btn:hover {
    opacity: 1 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

.queue-panel {
    backdrop-filter: blur(10px);
    border: 1px solid rgba(var(--bs-border-color-rgb), 0.25) !important;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.queue-item {
    background: var(--bs-body-tertiary);
    border: 1px solid rgba(var(--bs-border-color-rgb), 0.25) !important;
    transition: all 0.3s ease;
}

.queue-item:hover {
    background: var(--bs-body-secondary);
    border-color: var(--bs-primary) !important;
    transform: translateY(-1px);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
}

.pulse-badge {
    animation: pulse-glow 1.5s infinite;
}

@keyframes pulse-glow {
    0% {
        box-shadow: 0 0 5px rgba(25, 135, 84, 0.5);
    }
    50% {
        box-shadow: 0 0 15px rgba(25, 135, 84, 0.8);
    }
    100% {
        box-shadow: 0 0 5px rgba(25, 135, 84, 0.5);
    }
}

/* Mobile responsiveness */
@media (max-width: 576px) {
    .queue-floating-widget {
        right: 10px !important;
        bottom: 85px !important;
    }
    
    .queue-toggle-btn {
        width: 50px !important;
        height: 50px !important;
    }
    
    .queue-toggle-btn i {
        font-size: 1.2rem !important;
    }
    
    .queue-info-btn {
        width: 45px !important;
        height: 45px !important;
    }
    
    .queue-panel {
        width: calc(100vw - 20px) !important;
        right: -50px !important;
        bottom: 60px !important;
        max-height: 350px !important;
    }
    
    .queue-item {
        padding: 1rem !important;
        margin-bottom: 0.75rem !important;
    }
    
    .queue-item .pe-5 {
        padding-right: 0 !important;
    }
}

/* Dark mode support */
[data-bs-theme="dark"] .queue-panel {
    background: var(--bs-body-bg) !important;
    border-color: rgba(var(--bs-border-color-rgb), 0.25) !important;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.5) !important;
}

[data-bs-theme="dark"] .queue-item {
    background: var(--bs-body-tertiary);
    border-color: rgba(var(--bs-border-color-rgb), 0.25) !important;
}

[data-bs-theme="dark"] .queue-item:hover {
    background: var(--bs-body-secondary);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.3);
}

/* Scrollbar styling for queue panel */
.queue-panel::-webkit-scrollbar {
    width: 6px;
}

.queue-panel::-webkit-scrollbar-track {
    background: var(--bs-light);
    border-radius: 3px;
}

.queue-panel::-webkit-scrollbar-thumb {
    background: var(--bs-secondary);
    border-radius: 3px;
}

.queue-panel::-webkit-scrollbar-thumb:hover {
    background: var(--bs-primary);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('livewire:navigated', function() {
    let previousCalledQueues = [];
    
    // Auto refresh queue data every 30 seconds
    setInterval(function() {
        if (typeof Livewire !== 'undefined') {
            Livewire.dispatch('queueUpdated');
        }
    }, 30000);
    
    // Check for newly called queues and play notification sound
    document.addEventListener('livewire:updated', function() {
        // Get current called queues
        const currentCalledQueues = [];
        document.querySelectorAll('.pulse-badge').forEach(badge => {
            const queueItem = badge.closest('.queue-item');
            if (queueItem) {
                const queueName = queueItem.querySelector('h6').textContent;
                currentCalledQueues.push(queueName);
            }
        });
        
        // Check for new called queues
        const newlyCalledQueues = currentCalledQueues.filter(
            queue => !previousCalledQueues.includes(queue)
        );
        
        if (newlyCalledQueues.length > 0) {
            // Play notification sound for newly called queues
            playNotificationSound();
            
            // Show browser notification if permission granted
            if ('Notification' in window && Notification.permission === 'granted') {
                new Notification('Antrian Dipanggil!', {
                    body: `${newlyCalledQueues.join(', ')} - Silakan datang ke lokasi!`,
                    icon: '/favicon.ico',
                    badge: '/favicon.ico'
                });
            }
        }
        
        previousCalledQueues = currentCalledQueues;
    });
    
    // Request notification permission on first load
    if ('Notification' in window && Notification.permission === 'default') {
        Notification.requestPermission();
    }
});

function playNotificationSound() {
    // Create audio context and play notification sound
    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
    const oscillator = audioContext.createOscillator();
    const gainNode = audioContext.createGain();
    
    oscillator.connect(gainNode);
    gainNode.connect(audioContext.destination);
    
    oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
    oscillator.frequency.setValueAtTime(600, audioContext.currentTime + 0.1);
    oscillator.frequency.setValueAtTime(800, audioContext.currentTime + 0.2);
    
    gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
    
    oscillator.start(audioContext.currentTime);
    oscillator.stop(audioContext.currentTime + 0.3);
}
</script>
@endpush
