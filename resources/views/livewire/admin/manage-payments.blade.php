<div class="container-fluid p-4">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="h3 mb-1 text-body-emphasis">Kelola Pembayaran</h2>
        <p class="text-muted mb-0">Kelola invoice, pembayaran, dan proses refund</p>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-receipt display-6 text-primary mb-2"></i>
                    <h5 class="card-title">{{ $stats['total'] }}</h5>
                    <p class="card-text text-muted small">Total Invoice</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle display-6 text-success mb-2"></i>
                    <h5 class="card-title">{{ $stats['paid'] }}</h5>
                    <p class="card-text text-muted small">Lunas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-clock display-6 text-warning mb-2"></i>
                    <h5 class="card-title">{{ $stats['pending'] }}</h5>
                    <p class="card-text text-muted small">Pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-arrow-return-left display-6 text-info mb-2"></i>
                    <h5 class="card-title">{{ $stats['refunded'] }}</h5>
                    <p class="card-text text-muted small">Refund</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body text-center">
                    <i class="bi bi-cash-stack display-6 mb-2"></i>
                    <h4 class="card-title">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h4>
                    <p class="card-text small">Total Pendapatan</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body text-center">
                    <i class="bi bi-arrow-return-left display-6 mb-2"></i>
                    <h4 class="card-title">Rp {{ number_format($stats['refunded_amount'], 0, ',', '.') }}</h4>
                    <p class="card-text small">Total Refund</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="searchTerm" class="form-label">Cari Invoice</label>
                    <input type="text" class="form-control" id="searchTerm" wire:model.live.debounce.300ms="searchTerm" 
                           placeholder="Cari berdasarkan ID invoice, nama user, atau email">
                </div>
                <div class="col-md-4">
                    <label for="statusFilter" class="form-label">Status</label>
                    <select class="form-select" id="statusFilter" wire:model.live="statusFilter">
                        <option value="all">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="paid">Lunas</option>
                        <option value="refunded">Refund</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100" wire:click="$set('statusFilter', 'all'); $set('searchTerm', '')">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoices List -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($invoices->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID Invoice</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Metode Bayar</th>
                                <th>Status</th>
                                <th>Tiket</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>
                                    <strong class="text-primary">#{{ $invoice->id }}</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-2" 
                                             style="width: 32px; height: 32px; font-size: 14px;">
                                            {{ substr($invoice->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ $invoice->user->name }}</div>
                                            <small class="text-muted">{{ $invoice->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($invoice->payment_method) }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $invoice->status_badge_class }}">{{ $invoice->status_label }}</span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $invoice->total_purchased_tickets }} tiket
                                        @if($invoice->total_used_tickets > 0)
                                            <br><span class="text-success">({{ $invoice->total_used_tickets }} terpakai)</span>
                                        @endif
                                    </small>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $invoice->created_at->format('d/m/Y H:i') }}</small>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button wire:click="viewInvoice({{ $invoice->id }})" 
                                                class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        @if($invoice->canBeRefunded())
                                        <button wire:click="showRefundForm({{ $invoice->id }})" 
                                                class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-arrow-return-left"></i>
                                        </button>
                                        @endif
                                        @if($invoice->status === 'pending')
                                        <button wire:click="updateStatus({{ $invoice->id }}, 'paid')" 
                                                class="btn btn-outline-success btn-sm"
                                                onclick="return confirm('Tandai sebagai lunas?')">
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
                    {{ $invoices->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-receipt display-4 text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada invoice ditemukan</h5>
                    <p class="text-muted">Belum ada invoice yang sesuai dengan filter yang dipilih</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Detail Modal -->
    @if($selectedInvoice && !$showRefundModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Invoice #{{ $selectedInvoice->id }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <span class="badge {{ $selectedInvoice->status_badge_class }} ms-2">{{ $selectedInvoice->status_label }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Total:</strong>
                            <span class="fs-5 fw-bold text-primary ms-2">Rp {{ number_format($selectedInvoice->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Customer:</strong>
                            <p class="mb-0 mt-1">{{ $selectedInvoice->user->name }}</p>
                            <small class="text-muted">{{ $selectedInvoice->user->email }}</small>
                        </div>
                        <div class="col-md-6">
                            <strong>Metode Pembayaran:</strong>
                            <p class="mb-0 mt-1">{{ ucfirst($selectedInvoice->payment_method) }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>Tanggal:</strong>
                        <p class="mb-0 mt-1 text-muted">{{ $selectedInvoice->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <hr>
                    <strong>Detail Tiket:</strong>
                    <div class="table-responsive mt-2">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tiket</th>
                                    <th>Jumlah</th>
                                    <th>Terpakai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedInvoice->invoiceTickets as $invoiceTicket)
                                <tr>
                                    <td>{{ $invoiceTicket->ticket->name }}</td>
                                    <td>{{ $invoiceTicket->quantity }}</td>
                                    <td>{{ $invoiceTicket->used_quantity }}</td>
                                    <td>
                                        @if($invoiceTicket->quantity == 0)
                                            <span class="badge bg-danger">Hangus</span>
                                        @elseif($invoiceTicket->used_quantity >= $invoiceTicket->quantity)
                                            <span class="badge bg-secondary">Habis</span>
                                        @elseif($invoiceTicket->used_quantity > 0)
                                            <span class="badge bg-warning">Sebagian</span>
                                        @else
                                            <span class="badge bg-success">Belum Dipakai</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($selectedInvoice->canBeRefunded())
                    <button wire:click="showRefundForm({{ $selectedInvoice->id }})" class="btn btn-danger">
                        <i class="bi bi-arrow-return-left me-2"></i>Proses Refund
                    </button>
                    @endif
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Refund Modal -->
    @if($showRefundModal && $selectedInvoice)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proses Refund - Invoice #{{ $selectedInvoice->id }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Perhatian!</strong> Proses refund akan membatalkan semua tiket yang terkait dengan invoice ini.
                        Tiket akan menjadi hangus dan tidak dapat digunakan lagi.
                    </div>

                    <div class="mb-3">
                        <strong>Detail Refund:</strong>
                        <ul class="list-unstyled mt-2">
                            <li>• Customer: {{ $selectedInvoice->user->name }}</li>
                            <li>• Total: Rp {{ number_format($selectedInvoice->total_price, 0, ',', '.') }}</li>
                            <li>• Jumlah Tiket: {{ $selectedInvoice->total_purchased_tickets }}</li>
                            <li>• Tiket Terpakai: {{ $selectedInvoice->total_used_tickets }}</li>
                        </ul>
                    </div>

                    <form wire:submit.prevent="processRefund">
                        <div class="mb-3">
                            <label for="refundReason" class="form-label">Alasan Refund <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('refundReason') is-invalid @enderror" 
                                      id="refundReason" wire:model="refundReason" rows="3" 
                                      placeholder="Masukkan alasan refund secara detail"></textarea>
                            @error('refundReason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Batal</button>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-arrow-return-left me-2"></i>Proses Refund
                            </button>
                        </div>
                    </form>
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
</style>
@endpush
