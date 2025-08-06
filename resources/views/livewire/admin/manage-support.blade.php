<div class="container-fluid p-4">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="h3 mb-1 text-body-emphasis">Kelola Bantuan</h2>
        <p class="text-muted mb-0">Kelola tiket bantuan dan keluhan dari staff</p>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-ticket-perforated display-6 text-primary mb-2"></i>
                    <h5 class="card-title">{{ $stats['total'] }}</h5>
                    <p class="card-text text-muted small">Total Tiket</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-clock display-6 text-warning mb-2"></i>
                    <h5 class="card-title">{{ $stats['open'] }}</h5>
                    <p class="card-text text-muted small">Tiket Terbuka</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle display-6 text-success mb-2"></i>
                    <h5 class="card-title">{{ $stats['resolved'] }}</h5>
                    <p class="card-text text-muted small">Tiket Selesai</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-exclamation-triangle display-6 text-danger mb-2"></i>
                    <h5 class="card-title">{{ $stats['high_priority'] }}</h5>
                    <p class="card-text text-muted small">Prioritas Tinggi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="searchTerm" class="form-label">Cari Tiket</label>
                    <input type="text" class="form-control" id="searchTerm" wire:model.live.debounce.300ms="searchTerm" 
                           placeholder="Cari berdasarkan nomor tiket, subjek, atau nama staff">
                </div>
                <div class="col-md-3">
                    <label for="statusFilter" class="form-label">Status</label>
                    <select class="form-select" id="statusFilter" wire:model.live="statusFilter">
                        <option value="all">Semua Status</option>
                        <option value="open">Terbuka</option>
                        <option value="in_progress">Dalam Proses</option>
                        <option value="resolved">Selesai</option>
                        <option value="closed">Ditutup</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="priorityFilter" class="form-label">Prioritas</label>
                    <select class="form-select" id="priorityFilter" wire:model.live="priorityFilter">
                        <option value="all">Semua Prioritas</option>
                        <option value="high">Tinggi</option>
                        <option value="medium">Sedang</option>
                        <option value="low">Rendah</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100" wire:click="$set('statusFilter', 'all'); $set('priorityFilter', 'all'); $set('searchTerm', '')">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tickets List -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($tickets->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nomor Tiket</th>
                                <th>Staff</th>
                                <th>Subjek</th>
                                <th>Prioritas</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr>
                                <td>
                                    <strong class="text-primary">#{{ $ticket->ticket_number }}</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-2" 
                                             style="width: 32px; height: 32px; font-size: 14px;">
                                            {{ substr($ticket->staff->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ $ticket->staff->name }}</div>
                                            <small class="text-muted">{{ ucfirst($ticket->staff->role) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-medium">{{ Str::limit($ticket->subject, 40) }}</div>
                                        <small class="text-muted">{{ Str::limit($ticket->description, 60) }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $ticket->priority_badge_class }}">{{ $ticket->priority_label }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $ticket->status_badge_class }}">{{ $ticket->status_label }}</span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $ticket->created_at->format('d/m/Y H:i') }}</small>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button wire:click="viewTicket({{ $ticket->id }})" 
                                                class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        @if($ticket->status === 'open')
                                        <button wire:click="updateStatus({{ $ticket->id }}, 'in_progress')" 
                                                class="btn btn-outline-warning btn-sm">
                                            <i class="bi bi-play-fill"></i>
                                        </button>
                                        @endif
                                        @if(in_array($ticket->status, ['open', 'in_progress']))
                                        <button wire:click="updateStatus({{ $ticket->id }}, 'resolved')" 
                                                class="btn btn-outline-success btn-sm">
                                            <i class="bi bi-check"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $tickets->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-ticket-perforated display-4 text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada tiket ditemukan</h5>
                    <p class="text-muted">Belum ada tiket bantuan yang sesuai dengan filter yang dipilih</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Detail Modal -->
    @if($selectedTicket)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Tiket #{{ $selectedTicket->ticket_number }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <span class="badge {{ $selectedTicket->status_badge_class }} ms-2">{{ $selectedTicket->status_label }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Prioritas:</strong>
                            <span class="badge {{ $selectedTicket->priority_badge_class }} ms-2">{{ $selectedTicket->priority_label }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Staff:</strong>
                            <p class="mb-0 mt-1">{{ $selectedTicket->staff->name }} ({{ ucfirst($selectedTicket->staff->role) }})</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Dibuat:</strong>
                            <p class="mb-0 mt-1 text-muted">{{ $selectedTicket->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>Subjek:</strong>
                        <p class="mb-0 mt-1">{{ $selectedTicket->subject }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Deskripsi:</strong>
                        <p class="mb-0 mt-1">{{ $selectedTicket->description }}</p>
                    </div>

                    @if($selectedTicket->admin_response)
                    <hr>
                    <div class="mb-3">
                        <strong>Respon Admin:</strong>
                        <div class="bg-light p-3 rounded mt-2">
                            <p class="mb-2">{{ $selectedTicket->admin_response }}</p>
                            <small class="text-muted">
                                Direspon oleh: {{ $selectedTicket->respondedBy->name ?? 'Admin' }} 
                                pada {{ $selectedTicket->responded_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    </div>
                    @endif

                    @if(!$selectedTicket->admin_response || in_array($selectedTicket->status, ['open', 'in_progress']))
                    <hr>
                    <form wire:submit.prevent="respondToTicket">
                        <div class="mb-3">
                            <label for="adminResponse" class="form-label">
                                <strong>{{ $selectedTicket->admin_response ? 'Update Respon' : 'Respon Admin' }}:</strong>
                            </label>
                            <textarea class="form-control @error('adminResponse') is-invalid @enderror" 
                                      id="adminResponse" wire:model="adminResponse" rows="4" 
                                      placeholder="Berikan respon atau solusi untuk tiket ini"></textarea>
                            @error('adminResponse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-2"></i>{{ $selectedTicket->admin_response ? 'Update Respon' : 'Kirim Respon' }}
                            </button>
                        </div>
                    </form>
                    @else
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
.table th {
    border-top: none;
    font-weight: 600;
    background-color: var(--bs-gray-50);
}

[data-bs-theme="dark"] .table th {
    background-color: var(--bs-gray-800);
}

.modal {
    backdrop-filter: blur(5px);
}
</style>
@endpush
