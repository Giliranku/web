<div class="container-fluid p-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-1 text-body-emphasis">Bantuan & Keluhan</h2>
            <p class="text-muted mb-0">Kelola tiket bantuan dan keluhan Anda</p>
        </div>
        <button type="button" class="btn btn-primary" wire:click.prevent="toggleCreateForm">
            <i class="bi bi-plus"></i> Buat Tiket Baru
        </button>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Create Form -->
    @if($showCreateForm)
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Buat Tiket Bantuan Baru</h5>
            <button type="button" class="btn-close" wire:click="hideCreateForm"></button>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createTicket">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="subject" class="form-label">Subjek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                               id="subject" wire:model="subject" placeholder="Masukkan subjek keluhan">
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="priority" class="form-label">Prioritas <span class="text-danger">*</span></label>
                        <select class="form-select @error('priority') is-invalid @enderror" 
                                id="priority" wire:model="priority">
                            <option value="low">Rendah</option>
                            <option value="medium">Sedang</option>
                            <option value="high">Tinggi</option>
                        </select>
                        @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" wire:model="description" rows="4" 
                              placeholder="Jelaskan keluhan atau masalah yang Anda alami secara detail"></textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary" wire:click="hideCreateForm">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-2"></i>Kirim Tiket
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Tickets List -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($tickets->count() > 0)
                <div class="row g-3">
                    @foreach($tickets as $ticket)
                    <div class="col-12">
                        <div class="card border border-opacity-25 h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <h6 class="card-title mb-0 text-primary fw-bold">#{{ $ticket->ticket_number }}</h6>
                                            <span class="badge {{ $ticket->status_badge_class }}">{{ $ticket->status_label }}</span>
                                            <span class="badge {{ $ticket->priority_badge_class }}">{{ $ticket->priority_label }}</span>
                                        </div>
                                        <h6 class="text-body-emphasis mb-2">{{ $ticket->subject }}</h6>
                                        <p class="text-muted mb-2 small">{{ Str::limit($ticket->description, 100) }}</p>
                                        <div class="small text-muted">
                                            <i class="bi bi-calendar me-1"></i>{{ $ticket->created_at->format('d/m/Y H:i') }}
                                            @if($ticket->responded_at)
                                                <span class="ms-3">
                                                    <i class="bi bi-reply me-1"></i>Direspon: {{ $ticket->responded_at->format('d/m/Y H:i') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <button wire:click="viewTicket({{ $ticket->id }})" 
                                            class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-eye me-1"></i>Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $tickets->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-ticket-perforated display-4 text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada tiket bantuan</h5>
                    <p class="text-muted">Klik "Buat Tiket Baru" untuk membuat tiket bantuan pertama Anda</p>
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

                    <div class="mb-3">
                        <strong>Subjek:</strong>
                        <p class="mb-0 mt-1">{{ $selectedTicket->subject }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Deskripsi:</strong>
                        <p class="mb-0 mt-1">{{ $selectedTicket->description }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Dibuat:</strong>
                        <p class="mb-0 mt-1 text-muted">{{ $selectedTicket->created_at->format('d/m/Y H:i') }}</p>
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
                    @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>Tiket ini belum mendapat respon dari admin.
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
.card-hover {
    transition: transform 0.2s, box-shadow 0.2s;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

[data-bs-theme="dark"] .card-hover:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

.modal {
    backdrop-filter: blur(5px);
}
</style>
@endpush
