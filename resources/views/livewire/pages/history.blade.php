@push('styles')
@vite([
    'resources/css/invoice-page.css',  
    // 'public/js/userprofile.js'
])
@endpush
<div class="container-fluid px-0" style="background:#fff; min-height:100vh;">

    <!-- Breadcrumb -->
    <div class="container mt-4 mb-2 px-4">
        <a href="#" class="text-dark d-flex align-items-center mb-2" style="text-decoration:none; font-weight:500;">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke profil
        </a>
    </div>

    <div class="container my-4">
        @php
            // Derive methods from invoices passed from Livewire component
            $methodsList = $invoices->pluck('payment_method')->unique();
        @endphp
        <form method="GET" action="{{ route('history') }}">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-lg-5">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Cari Nomor Referal">
                </div>
                <div class="col-6 col-lg-3">
                    <select name="method" class="form-select">
                        <option value="">Semua Metode Pembayaran</option>
                        @foreach($methodsList as $method)
                            <option value="{{ $method }}" @selected(request('method') == $method)>{{ $method }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-lg-3">
                    <select name="period" class="form-select">
                        <option value="">Semua Periode</option>
                        <option value="7" @selected(request('period') == '7')>7 Hari Terakhir</option>
                        <option value="30" @selected(request('period') == '30')>30 Hari Terakhir</option>
                    </select>
                </div>
                <div class="col-12 col-lg-1">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <style>
        @media (max-width: 768px) {
            .history-table {
                display: none !important;
            }

            .history-card-list {
                display: block !important;
            }
        }

        @media (min-width: 769px) {
            .history-table {
                display: block !important;
            }

            .history-card-list {
                display: none !important;
            }
        }

        .history-card {
            border: 1px solid #ededf0;
            border-radius: 8px;
            padding: 1.2rem 1rem 1rem 1rem;
            margin-bottom: 1.2rem;
            background: #fff;
            position: relative;
        }

        .history-card .invoice-link {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 0.95rem;
            color: #888;
            text-decoration: none;
        }

        .history-card .invoice-link:hover {
            text-decoration: underline;
        }

        .history-card .history-total {
            font-weight: 600;
            margin-top: 0.7rem;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
        }
    </style>

    <!-- Table (Desktop) -->
    <div class="container px-4 pb-5 history-table">
        <div class="table-responsive rounded" style="overflow-x:auto;">
            <table class="table align-middle mb-0" style="min-width:700px;">
                <thead class="bg-light">
                    <tr>
                        <th>No. Referal</th>
                        <th>Tanggal Pembelian</th>
                        <th>Metode Pembayaran</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->created_at->format('d M Y') }}</td>
                            <td>{{ $invoice->payment_method }}</td>
                            <td>Rp{{ number_format($invoice->total_price, 0, ',', '.') }}</td>
                            <td class="text-end">
                                <a href="{{ route('invoice', $invoice->id) }}"><i class="bi bi-chevron-right fs-4"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada riwayat pembelian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Card List (Mobile) -->
    <div class="container px-2 pb-5 history-card-list" style="display:none;">
        @forelse($invoices as $invoice)
            <div class="history-card">
                <a href="{{ route('invoice', $invoice->id) }}" class="invoice-link">Lihat Invoice <i
                        class="bi bi-chevron-right"></i></a>
                <div><strong>No. Referal :</strong> {{ $invoice->referral_number }}</div>
                <div><strong>Tanggal Pembelian :</strong> {{ $invoice->created_at->format('d M Y') }}</div>
                <div><strong>Metode Pembayaran :</strong> {{ $invoice->payment_method }}</div>
                <div class="history-total">
                    <span>Total :</span>
                    <span>Rp{{ number_format($invoice->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada riwayat pembelian.</p>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>