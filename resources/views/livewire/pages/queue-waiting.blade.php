@push('styles')
<style>
    :root {
        --primary-50: #eff6ff;
        --primary-100: #dbeafe;
        --primary-500: #3b82f6;
        --primary-600: #2563eb;
        --primary-700: #1d4ed8;
        --primary-800: #1e40af;
        
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        
        --success-50: #f0fdf4;
        --success-100: #dcfce7;
        --success-200: #bbf7d0;
        --success-500: #22c55e;
        --success-600: #16a34a;
        --success-700: #15803d;
        --success-800: #166534;
        
        --warning-50: #fffbeb;
        --warning-100: #fef3c7;
        --warning-200: #fde68a;
        --warning-500: #f59e0b;
        --warning-600: #d97706;
        
        --error-50: #fef2f2;
        --error-100: #fee2e2;
        --error-200: #fecaca;
        --error-500: #ef4444;
        --error-600: #dc2626;
        --error-700: #b91c1c;
        --error-800: #991b1b;
        
        --spacing-xs: 8px;
        --spacing-sm: 12px;
        --spacing-md: 16px;
        --spacing-lg: 20px;
        --spacing-xl: 24px;
        --spacing-2xl: 32px;
        --spacing-3xl: 48px;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, var(--primary-50) 0%, var(--primary-100) 100%);
        min-height: 100vh;
    }

    /* Layout */
    .queue-container {
        max-width: 900px;
        margin: 0 auto;
        padding: var(--spacing-lg);
        min-height: 100vh;
    }

    .page-header {
        text-align: center;
        margin-bottom: var(--spacing-2xl);
        padding: var(--spacing-xl);
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .page-title {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: var(--spacing-xs);
        letter-spacing: -0.025em;
    }
    
    .page-subtitle {
        font-size: 1rem;
        color: var(--gray-600);
        font-weight: 500;
    }

    /* Summary Header */
    .summary-header {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--spacing-md);
        margin-bottom: var(--spacing-xl);
        padding: var(--spacing-lg);
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .summary-stat {
        text-align: center;
        padding: var(--spacing-md);
    }

    .summary-stat .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: var(--spacing-xs);
    }

    .summary-stat .stat-label {
        font-size: 0.875rem;
        color: var(--gray-600);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Sections */
    .queues-section {
        margin-bottom: var(--spacing-xl);
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: var(--spacing-lg);
        display: flex;
        align-items: center;
        gap: var(--spacing-sm);
    }

    .section-title i {
        color: var(--primary-600);
    }

    /* Queue Cards Grid */
    .queues-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: var(--spacing-lg);
    }

    .queue-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .queue-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .queue-waiting {
        border-color: var(--warning-200);
    }

    .queue-called {
        border-color: var(--success-200);
        animation: pulse-glow 2s infinite;
    }

    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); }
        50% { box-shadow: 0 4px 30px rgba(34, 197, 94, 0.3); }
    }

    /* Queue Card Header */
    .queue-header {
        padding: var(--spacing-lg);
        background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .queue-called .queue-header {
        background: linear-gradient(135deg, var(--success-600), var(--success-700));
    }

    .queue-position {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
    }

    .queue-status {
        display: flex;
        align-items: center;
        gap: var(--spacing-xs);
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Queue Card Body */
    .queue-body {
        padding: var(--spacing-lg);
    }

    .venue-name {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: var(--spacing-xs);
        line-height: 1.3;
    }

    .venue-type {
        color: var(--gray-600);
        font-size: 0.875rem;
        margin-bottom: var(--spacing-md);
        display: flex;
        align-items: center;
        gap: var(--spacing-xs);
    }

    .queue-info {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-sm);
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: var(--spacing-sm);
        color: var(--gray-700);
        font-size: 0.875rem;
    }

    .info-item i {
        color: var(--primary-600);
        width: 16px;
        text-align: center;
    }

    /* Completed Queues */
    .completed-list {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .completed-item {
        display: flex;
        align-items: center;
        gap: var(--spacing-md);
        padding: var(--spacing-md) var(--spacing-lg);
        border-bottom: 1px solid var(--gray-100);
        transition: background-color 0.2s ease;
    }

    .completed-item:last-child {
        border-bottom: none;
    }

    .completed-item:hover {
        background-color: var(--gray-50);
    }

    .completed-icon {
        color: var(--success-600);
        font-size: 1.25rem;
    }

    .completed-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: var(--spacing-xs);
    }

    .completed-name {
        font-weight: 600;
        color: var(--gray-900);
    }

    .completed-detail {
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    /* Actions Section */
    .actions-section {
        margin-top: var(--spacing-xl);
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: var(--spacing-md);
    }

    /* Button Styles */
    .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--spacing-sm);
        padding: var(--spacing-md) var(--spacing-lg);
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-700), var(--primary-800));
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-success {
        background: linear-gradient(135deg, var(--success-600), var(--success-700));
        color: white;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, var(--success-700), var(--success-800));
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--error-600), var(--error-700));
        color: white;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, var(--error-700), var(--error-800));
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-secondary {
        background: var(--gray-100);
        color: var(--gray-700);
        border: 1px solid var(--gray-200);
    }

    .btn-secondary:hover {
        background: var(--gray-200);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: var(--spacing-3xl);
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--gray-400);
        margin-bottom: var(--spacing-lg);
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: var(--spacing-md);
    }

    .empty-description {
        color: var(--gray-600);
        margin-bottom: var(--spacing-xl);
    }

    /* Page Footer */
    .page-footer {
        text-align: center;
        margin-top: var(--spacing-3xl);
        padding: var(--spacing-lg);
    }

    .footer-text {
        color: var(--gray-500);
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--spacing-sm);
    }

    /* Additional styles for compatibility */
    .card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .card-body {
        padding: var(--spacing-xl);
    }
    
    .btn-group {
        display: flex;
        gap: var(--spacing-sm);
        flex-wrap: wrap;
        justify-content: center;
    }

    /* Loading State */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
    }
    
    .loading-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid var(--gray-200);
        border-top: 3px solid var(--primary-500);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Floating Controls */
    .floating-controls {
        position: fixed;
        top: var(--spacing-lg);
        right: var(--spacing-lg);
        z-index: 1000;
        display: flex;
        gap: var(--spacing-sm);
    }
    
    .control-btn {
        width: 44px;
        height: 44px;
        background: white;
        border: 1px solid var(--gray-300);
        border-radius: 12px;
        color: var(--gray-600);
        font-size: 1rem;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .control-btn:hover {
        background: var(--gray-50);
        color: var(--gray-700);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }
    
    .live-indicator {
        background: var(--success-100);
        color: var(--success-600);
        padding: var(--spacing-xs) var(--spacing-sm);
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: var(--spacing-xs);
        border: 1px solid var(--success-200);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .live-dot {
        width: 6px;
        height: 6px;
        background: var(--success-500);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .queue-container {
            padding: var(--spacing-md);
        }
        
        .queues-grid {
            grid-template-columns: 1fr;
        }
        
        .actions-grid {
            grid-template-columns: 1fr;
        }
        
        .summary-header {
            grid-template-columns: 1fr;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .floating-controls {
            top: var(--spacing-md);
            right: var(--spacing-md);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto refresh every 30 seconds
    setInterval(function() {
        @this.call('refreshQueue');
    }, 30000);
    
    // Refresh when tab becomes active
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            @this.call('refreshQueue');
        }
    });
</script>
@endpush

<div class="queue-container">
    <div>
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Status Antrian</h1>
            <p class="page-subtitle">Pantau posisi antrian Anda secara real-time</p>
        </div>

        @if(!empty($ticketDetails))
            @php
                $activeQueues = collect($ticketDetails)->whereIn('status', ['waiting', 'called']);
                $completedQueues = collect($ticketDetails)->where('status', 'served');
                $totalTickets = collect($ticketDetails)->count();
            @endphp

            {{-- Summary Header --}}
            <div class="summary-header">
                <div class="summary-stat">
                    <div class="stat-number">{{ $activeQueues->count() }}</div>
                    <div class="stat-label">Antrian Aktif</div>
                </div>
                <div class="summary-stat">
                    <div class="stat-number">{{ $completedQueues->count() }}</div>
                    <div class="stat-label">Selesai</div>
                </div>
                <div class="summary-stat">
                    <div class="stat-number">{{ $totalTickets }}</div>
                    <div class="stat-label">Total</div>
                </div>
            </div>

            {{-- Active Queues - Compact Design --}}
            @if($activeQueues->isNotEmpty())
                <div class="queues-section">
                    <h2 class="section-title">
                        <i class="bi bi-clock-history"></i>
                        Antrian Aktif
                    </h2>
                    
                    <div class="queues-grid">
                        @foreach($activeQueues as $queue)
                            <div class="queue-card {{ $queue['status'] === 'called' ? 'queue-called' : 'queue-waiting' }}">
                                <div class="queue-header">
                                    <div class="queue-position">{{ $queue['queue_position'] }}</div>
                                    <div class="queue-status">
                                        @if($queue['status'] === 'called')
                                            <i class="bi bi-megaphone-fill"></i>
                                            <span>Dipanggil</span>
                                        @else
                                            <i class="bi bi-clock-fill"></i>
                                            <span>Menunggu</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="queue-body">
                                    <h4 class="venue-name">{{ $queue['venue_name'] }}</h4>
                                    <p class="venue-type">
                                        <i class="bi bi-{{ $queue['venue_type'] === 'attraction' ? 'controller' : 'cup-hot' }}"></i>
                                        {{ $queue['venue_type'] === 'attraction' ? 'Wahana' : 'Restaurant' }}
                                    </p>
                                    
                                    <div class="queue-info">
                                        <div class="info-item">
                                            <i class="bi bi-people-fill"></i>
                                            <span>{{ $currentServingNumber ?? 1 }} sedang dilayani</span>
                                        </div>
                                        @if($queue['estimated_wait'] > 0)
                                            <div class="info-item">
                                                <i class="bi bi-hourglass-split"></i>
                                                <span>~{{ $queue['estimated_wait'] }} menit</span>
                                            </div>
                                        @endif
                                        <div class="info-item">
                                            <i class="bi bi-clock"></i>
                                            <span>{{ \Carbon\Carbon::parse($queue['created_at'])->format('H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Completed Queues - Very Compact --}}
            @if($completedQueues->isNotEmpty())
                <div class="queues-section">
                    <h2 class="section-title">
                        <i class="bi bi-check-circle-fill"></i>
                        Riwayat Selesai
                    </h2>
                    
                    <div class="completed-list">
                        @foreach($completedQueues as $queue)
                            <div class="completed-item">
                                <div class="completed-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="completed-info">
                                    <span class="completed-name">{{ $queue['venue_name'] }}</span>
                                    <span class="completed-detail">
                                        #{{ $queue['queue_position'] }} • 
                                        {{ $queue['venue_type'] === 'attraction' ? 'Wahana' : 'Restaurant' }} • 
                                        {{ \Carbon\Carbon::parse($queue['created_at'])->format('H:i') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Action Buttons --}}
            <div class="actions-section">
                <div class="actions-grid">
                    <button wire:click="refreshQueue" class="btn btn-primary">
                        <i class="bi bi-arrow-clockwise"></i>
                        Refresh
                    </button>
                    
                    @if($activeQueues->isNotEmpty())
                        <button wire:click="cancelQueue" class="btn btn-danger" 
                                onclick="return confirm('Yakin ingin membatalkan semua antrian aktif?')">
                            <i class="bi bi-x-circle"></i>
                            Batalkan Semua
                        </button>
                    @endif
                    
                    <a href="/reservation-booking" wire:navigate class="btn btn-success">
                        <i class="bi bi-plus-circle"></i>
                        Antrian Baru
                    </a>
                    
                    <a href="/" wire:navigate class="btn btn-secondary">
                        <i class="bi bi-house"></i>
                        Beranda
                    </a>
                </div>
            </div>

        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <h3 class="empty-title">Tidak Ada Antrian Aktif</h3>
                <p class="empty-description">
                    Anda belum memiliki antrian yang sedang aktif saat ini. 
                    Silakan beli tiket untuk bergabung dalam antrian.
                </p>
                <div class="actions-grid">
                    <a href="/tiket-ecommerce" wire:navigate class="btn btn-primary">
                        <i class="bi bi-ticket-perforated"></i>
                        Beli Tiket
                    </a>
                    <a href="/" wire:navigate class="btn btn-secondary">
                        <i class="bi bi-house"></i>
                        Beranda
                    </a>
                </div>
            </div>
        @endif

        <!-- Page Footer -->
        <div class="page-footer">
            <p class="footer-text">
                <i class="bi bi-arrow-clockwise"></i>
                <span>Diperbarui otomatis setiap 30 detik</span>
            </p>
        </div>
    </div>
</div>
