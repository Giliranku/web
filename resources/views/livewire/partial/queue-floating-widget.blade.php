<div 
    class="position-fixed queue-floating-widget"
    style="position: fixed !important; bottom: 100px !important; right: 16px !important; z-index: 1049 !important; display: block !important;"
    wire:poll.30s="loadQueueData"
>
    @auth
        <!-- Always show floating queue button -->
        <div class="position-relative">
            <button 
                class="btn btn-warning rounded-circle shadow-lg queue-toggle-btn"
                style="width: 60px; height: 60px; border: none;"
                wire:click="$toggle('isOpen')"
                aria-label="Menu Antrian"
            >
                <i class="bi bi-clock-history text-white" style="font-size: 1.4rem;"></i>
            </button>
            
            <!-- Queue Count Badge (only show if has active queues) -->
            @if($hasTickets && $totalActiveQueues > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $totalActiveQueues }}
                    <span class="visually-hidden">antrian aktif</span>
                </span>
            @endif
        </div>

        <!-- Queue Panel -->
        @if($isOpen)
            <div 
                class="queue-panel position-absolute bg-body rounded-4 shadow-lg border border-opacity-25"
                style="bottom: 75px; left: -320px; width: 340px; max-height: 500px; overflow-y: auto; backdrop-filter: blur(10px);"
                wire:click.outside="$set('isOpen', false)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            >
                @if($hasTickets)
                    @if($totalActiveQueues > 0)
                        <!-- Header untuk Antrian Aktif -->
                        <div class="queue-header d-flex justify-content-between align-items-center p-3 border-bottom bg-warning bg-opacity-10 rounded-top-4">
                            <div class="d-flex align-items-center">
                                <div class="queue-icon-wrapper bg-warning bg-opacity-20 rounded-circle p-2 me-3">
                                    <i class="bi bi-clock-history text-primary" style="font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-body-emphasis">Antrian Aktif</h6>
                                    <small class="text-muted">{{ $totalActiveQueues }} antrian berlangsung</small>
                                </div>
                            </div>
                            <button 
                                class="btn-close" 
                                wire:click="$set('isOpen', false)"
                                aria-label="Tutup panel"
                            ></button>
                        </div>

                        <!-- Queue List -->
                        <div class="queue-content p-3">
                            @foreach($activeQueues as $queue)
                                <div class="queue-item bg-body-tertiary border rounded-3 mb-3 overflow-hidden">
                                    <!-- Status Bar -->
                                    @if($queue['status'] === 'called')
                                        <div class="status-bar bg-success text-white px-3 py-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="small fw-semibold">
                                                    <i class="bi bi-megaphone-fill me-1"></i>Antrian Dipanggil!
                                                </span>
                                                <span class="pulse-indicator bg-white bg-opacity-50 rounded-circle" style="width: 8px; height: 8px;"></span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="status-bar bg-warning text-dark px-3 py-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="small fw-semibold">
                                                    <i class="bi bi-hourglass-split me-1"></i>Sedang Menunggu
                                                </span>
                                                <span class="small">Posisi #{{ $queue['queue_position'] }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Queue Details -->
                                    <div class="p-3">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="attraction-icon me-3 mt-1">
                                                <i class="bi {{ $queue['type'] === 'attraction' ? 'bi-star-fill text-primary' : 'bi-cup-hot-fill text-danger' }}" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-bold text-body-emphasis">{{ $queue['name'] }}</h6>
                                                <small class="text-muted text-capitalize">{{ $queue['type'] === 'attraction' ? 'Wahana' : 'Restoran' }}</small>
                                            </div>
                                        </div>
                                        
                                        <div class="queue-info-grid">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="small text-muted">
                                                    <i class="bi bi-people-fill me-1"></i>Posisi Antrian
                                                </span>
                                                <span class="small fw-bold text-body-emphasis">#{{ $queue['queue_position'] }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="small text-muted">
                                                    <i class="bi bi-clock me-1"></i>Estimasi Waktu
                                                </span>
                                                <span class="small fw-medium {{ $queue['status_class'] }}">{{ $queue['estimated_time'] }}</span>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        @if($queue['status'] === 'waiting')
                                            <button 
                                                class="btn btn-outline-danger btn-sm w-100"
                                                wire:click="cancelQueue({{ $queue['id'] }}, '{{ $queue['type'] }}')"
                                                wire:confirm="Yakin ingin membatalkan antrian ini?"
                                                wire:loading.attr="disabled"
                                                wire:target="cancelQueue"
                                            >
                                                <span wire:loading.remove wire:target="cancelQueue">
                                                    <i class="bi bi-x-circle me-1"></i>Batalkan Antrian
                                                </span>
                                                <span wire:loading wire:target="cancelQueue">
                                                    <div class="spinner-border spinner-border-sm me-2" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    Membatalkan...
                                                </span>
                                            </button>
                                        @else
                                            <div class="alert alert-success mb-0 py-2">
                                                <small class="mb-0">
                                                    <i class="bi bi-info-circle me-1"></i>
                                                    Anda dapat mengunjungi lokasi.
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Footer -->
                        <div class="queue-footer p-3 pt-2 border-top bg-body-secondary rounded-bottom-4 text-center">
                            <small class="text-muted">
                                <i class="bi bi-arrow-clockwise me-1"></i>
                                Diperbarui otomatis setiap 30 detik
                            </small>
                        </div>
                    @else
                        <!-- No Active Queues -->
                        <div class="empty-state">
                            <!-- Header -->
                            <div class="queue-header d-flex justify-content-between align-items-center p-3 border-bottom bg-body-secondary rounded-top-4">
                                <div class="d-flex align-items-center">
                                    <div class="queue-icon-wrapper bg-warning bg-opacity-20 rounded-circle p-2 me-3">
                                        <i class="bi bi-clock-history text-primary" style="font-size: 1.2rem;"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold text-body-emphasis">Menu Antrian</h6>
                                </div>
                                <button 
                                    class="btn-close" 
                                    wire:click="$set('isOpen', false)"
                                    aria-label="Tutup panel"
                                ></button>
                            </div>
                            
                            <!-- Content -->
                            <div class="text-center p-4">
                                <div class="empty-icon mb-3">
                                    <i class="bi bi-clock-history text-muted opacity-50" style="font-size: 3.5rem;"></i>
                                </div>
                                
                                <h6 class="fw-bold text-body-emphasis mb-2">Tidak Ada Antrian Aktif</h6>
                                <p class="text-muted mb-4 small" style="line-height: 1.5;">
                                    Anda belum memiliki antrian yang sedang berlangsung. 
                                    Kunjungi wahana atau restoran untuk membuat antrian baru.
                                </p>
                                
                                <a href="{{ route('tiket-ecommerce') }}" class="btn btn-primary btn-sm" wire:navigate>
                                    <i class="bi bi-plus-circle me-1"></i>Jelajahi Wahana
                                </a>
                            </div>
                        </div>
                    @endif
                @else
                    <!-- No Tickets -->
                    <div class="empty-state">
                        <!-- Header -->
                        <div class="queue-header d-flex justify-content-between align-items-center p-3 border-bottom bg-primary bg-opacity-10 rounded-top-4">
                            <div class="d-flex align-items-center">
                                <div class="queue-icon-wrapper bg-primary bg-opacity-20 rounded-circle p-2 me-3">
                                    <i class="bi bi-ticket-perforated text-primary" style="font-size: 1.2rem;"></i>
                                </div>
                                <h6 class="mb-0 fw-bold text-body-emphasis">Tiket Diperlukan</h6>
                            </div>
                            <button 
                                class="btn-close" 
                                wire:click="$set('isOpen', false)"
                                aria-label="Tutup panel"
                            ></button>
                        </div>
                        
                        <!-- Content -->
                        <div class="text-center p-4">
                            <div class="empty-icon mb-3">
                                <i class="bi bi-ticket-perforated text-muted opacity-50" style="font-size: 3.5rem;"></i>
                            </div>
                            
                            <h6 class="fw-bold text-body-emphasis mb-2">Belum Memiliki Tiket</h6>
                            <p class="text-muted mb-4 small" style="line-height: 1.5;">
                                Anda perlu membeli tiket terlebih dahulu untuk dapat membuat antrian di wahana atau restoran. 
                                Setelah membeli tiket, antrian akan tampil di sini.
                            </p>
                            
                            <a href="{{ route('tiket-ecommerce') }}" class="btn btn-primary" wire:navigate>
                                <i class="bi bi-cart-plus me-2"></i>Beli Tiket Sekarang
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    @endauth
</div>

@push('styles')
<style>
/* Force queue widget styles to always apply */
.queue-floating-widget {
    position: fixed !important;
    bottom: 100px !important;
    right: 16px !important;
    z-index: 1049 !important;
    display: block !important;
}

.queue-floating-widget .btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.queue-floating-widget .position-relative {
    position: relative !important;
}

.queue-floating-widget .position-absolute {
    position: absolute !important;
}

.queue-floating-widget .queue-panel {
    position: absolute !important;
    bottom: 75px !important;
    left: -320px !important;
    width: 340px !important;
    max-height: 500px !important;
    overflow-y: auto !important;
}

/* Force Bootstrap utilities */
.queue-floating-widget .bg-body {
    background-color: var(--bs-body-bg) !important;
}

.queue-floating-widget .text-white {
    color: #fff !important;
}

.queue-floating-widget .bg-warning {
    background-color: var(--bs-warning) !important;
}

.queue-floating-widget .rounded-circle {
    border-radius: 50% !important;
}

.queue-floating-widget .shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
}
</style>
@endpush

@push('scripts')
<script>
// Global variables to prevent duplication
let queueWidgetInitialized = false;
let previousCalledQueues = [];
let refreshInterval = null;

// Initialize queue widget functionality
function initializeQueueWidget() {
    if (queueWidgetInitialized) return;
    
    // Check if we're on queue/search page and force more aggressive CSS reload
    const currentUrl = window.location.pathname;
    const isQueuePage = currentUrl.includes('/search') || currentUrl.includes('/queue') || 
                       currentUrl.includes('/attraction') || currentUrl.includes('/restaurant');
    
    // Force CSS reapplication and reflow
    const queueWidget = document.querySelector('.queue-floating-widget');
    if (queueWidget) {
        if (isQueuePage) {
            // More aggressive reset for queue pages
            queueWidget.style.cssText = '';
            queueWidget.offsetHeight;
            queueWidget.style.cssText = 'position: fixed !important; bottom: 100px !important; right: 16px !important; z-index: 1049 !important;';
            
            // Force reload all stylesheets for queue pages
            const stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
            stylesheets.forEach(link => {
                const href = link.href;
                link.href = href + (href.includes('?') ? '&' : '?') + 'v=' + Date.now();
            });
            
            // Force recompute Bootstrap classes
            setTimeout(() => {
                const bootstrapElements = queueWidget.querySelectorAll('[class*="btn"], [class*="bg-"], [class*="text-"], [class*="border"], [class*="rounded"], [class*="shadow"]');
                bootstrapElements.forEach(el => {
                    const classList = Array.from(el.classList);
                    el.className = '';
                    el.offsetHeight; // Trigger reflow
                    el.className = classList.join(' ');
                });
            }, 50);
        }
        
        // Force style recalculation by temporarily hiding and showing
        queueWidget.style.visibility = 'hidden';
        queueWidget.offsetHeight; // Trigger reflow
        queueWidget.style.visibility = 'visible';
        
        // Force redraw of all child elements
        const allElements = queueWidget.querySelectorAll('*');
        allElements.forEach(el => {
            el.style.transform = 'translateZ(0)'; // Force hardware acceleration
            setTimeout(() => {
                el.style.transform = '';
            }, 10);
        });
    }
    
    // Clear any existing interval to prevent duplicates
    if (refreshInterval) {
        clearInterval(refreshInterval);
    }
    
    // Auto refresh queue data every 30 seconds
    refreshInterval = setInterval(function() {
        if (typeof Livewire !== 'undefined') {
            Livewire.dispatch('queueUpdated');
        }
    }, 30000);
    
    // Request notification permission
    if ('Notification' in window && Notification.permission === 'default') {
        Notification.requestPermission();
    }
    
    queueWidgetInitialized = true;
}

// Handle queue status updates and notifications
function handleQueueUpdates() {
    // Get current called queues
    const currentCalledQueues = [];
    document.querySelectorAll('.pulse-indicator').forEach(indicator => {
        const queueItem = indicator.closest('.queue-item');
        if (queueItem) {
            const queueName = queueItem.querySelector('h6')?.textContent;
            if (queueName) {
                currentCalledQueues.push(queueName);
            }
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
}

// Play notification sound
function playNotificationSound() {
    try {
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
    } catch (error) {
        console.log('Audio notification not available:', error);
    }
}

// Initialize on every navigation
document.addEventListener('livewire:navigated', function() {
    // Reset initialization flag to force reinitialization
    queueWidgetInitialized = false;
    
    // Check if we're navigating to queue/search pages
    const currentUrl = window.location.pathname;
    const isQueuePage = currentUrl.includes('/search') || currentUrl.includes('/queue') || 
                       currentUrl.includes('/attraction') || currentUrl.includes('/restaurant');
    
    if (isQueuePage) {
        // Force refresh CSS and assets for queue pages
        forceRefreshAssets();
        
        // Wait longer for CSS to reload on queue pages
        setTimeout(() => {
            initializeQueueWidget();
            // Additional forced style recalculation
            forceStyleRecalculation();
        }, 300);
    } else {
        // Normal initialization for other pages
        setTimeout(() => {
            initializeQueueWidget();
        }, 100);
    }
});

// Force refresh CSS assets without page reload
function forceRefreshAssets() {
    // Reload all CSS files
    const cssLinks = document.querySelectorAll('link[rel="stylesheet"]');
    cssLinks.forEach(link => {
        const newLink = link.cloneNode();
        newLink.href = link.href.split('?')[0] + '?v=' + Date.now();
        newLink.onload = () => link.remove();
        link.parentNode.insertBefore(newLink, link.nextSibling);
    });
    
    // Force browser to recalculate all CSS
    document.body.style.display = 'none';
    document.body.offsetHeight; // Trigger reflow
    document.body.style.display = '';
}

// Force comprehensive style recalculation
function forceStyleRecalculation() {
    const queueWidget = document.querySelector('.queue-floating-widget');
    if (queueWidget) {
        // Remove and re-add all classes
        const originalClasses = queueWidget.className;
        queueWidget.className = '';
        queueWidget.offsetHeight;
        queueWidget.className = originalClasses;
        
        // Force recalculate for all child elements
        const allChildren = queueWidget.querySelectorAll('*');
        allChildren.forEach(el => {
            const originalClasses = el.className;
            el.className = '';
            el.offsetHeight;
            el.className = originalClasses;
        });
        
        // Force hardware acceleration
        queueWidget.style.willChange = 'transform';
        setTimeout(() => {
            queueWidget.style.willChange = 'auto';
        }, 100);
    }
}

// Handle Livewire updates
document.addEventListener('livewire:updated', function() {
    // Check if we're on queue pages for more aggressive handling
    const currentUrl = window.location.pathname;
    const isQueuePage = currentUrl.includes('/search') || currentUrl.includes('/queue') || 
                       currentUrl.includes('/attraction') || currentUrl.includes('/restaurant');
    
    // Reapply styles after Livewire updates
    const queueWidget = document.querySelector('.queue-floating-widget');
    if (queueWidget) {
        if (isQueuePage) {
            // More aggressive style refresh for queue pages
            queueWidget.style.cssText = '';
            queueWidget.offsetHeight;
            queueWidget.style.cssText = 'position: fixed !important; bottom: 100px !important; right: 16px !important; z-index: 1049 !important;';
            
            // Force all Bootstrap classes to recompute
            setTimeout(() => {
                forceStyleRecalculation();
            }, 50);
        }
        
        // Force style recalculation
        queueWidget.style.visibility = 'hidden';
        queueWidget.offsetHeight; // Trigger reflow
        queueWidget.style.visibility = 'visible';
    }
    
    // Handle queue status updates
    handleQueueUpdates();
});

// Listen for queue cancellation events
document.addEventListener('livewire:initialized', function() {
    Livewire.on('queueCancelled', function() {
        // Force refresh widget data immediately
        setTimeout(() => {
            if (typeof Livewire !== 'undefined') {
                Livewire.dispatch('queueUpdated');
            }
        }, 100);
    });
    
    Livewire.on('queueUpdated', function() {
        // Force widget refresh
        const queueWidget = document.querySelector('.queue-floating-widget');
        if (queueWidget) {
            // Trigger re-render
            queueWidget.style.transform = 'scale(0.99)';
            setTimeout(() => {
                queueWidget.style.transform = 'scale(1)';
            }, 50);
        }
    });
});

// Initialize on first load (fallback for non-wire:navigate pages)
document.addEventListener('DOMContentLoaded', function() {
    initializeQueueWidget();
});
</script>
@endpush
