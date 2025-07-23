@push('styles')
@vite([
    'resources/css/invoice-page.css',  
    // 'public/js/userprofile.js'
])
@endpush
{{-- Informasi Tiket Elektronik --}}
<div class="container pt-3 pb-5 justify-content-center" style="max-width: 90vw">

    {{-- Bagian Atas: Notifikasi Pembayaran --}}
    <div class="mb-5 justify-content-center d-none d-md-flex align-items-center">
        <div
            class="bg-primary text-white px-5 py-3 rounded-4 shadow-sm d-flex align-items-center gap-2 fs-4 justify-content-center">
            <img src="{{asset('img/VectorCentang.png')}}" alt="Centang" class="h-1 img-fluid "
                style="min-height: 1vw; max-height: 2vw;">
            <span class="ms-4">Pembayaran Berhasil</span>
        </div>
    </div>

    <div class="mb-5 justify-content-center d-md-none align-items-center">
        <div
            class="bg-primary text-white px-5 py-3 rounded-4 shadow-sm d-flex align-items-center gap-2 fs-5 justify-content-center">
            <img src="{{asset('img/VectorCentang.png')}}" alt="Centang" class="h-1 img-fluid "
                style="min-height: 3vw; max-height: 4vw;">
            <span class="ms-4">Pembayaran Berhasil</span>
        </div>
    </div>

    {{-- Konten Utama --}}
    <div class="bg-white p-4 rounded-3 shadow-sm border border-dark">

        {{-- Logo dan Barcode --}}
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('img/logo-giliranku.png') }}" alt="icon" style="width:4vw">
                <div>
                    <div class="fw-bold fs-3">Giliranku - Inclusive Theme Park</div>
                    <div class="small text-muted fs-5">Tiket Elektronik</div>
                </div>
            </div>
            <div>
                <img src="{{ asset('img/barcode.png') }}" alt="barcode" style="width: 30vw">
            </div>
        </div>

        {{-- Data Dinamis --}}
        <div class="row my-3">
            <div class="col-6 text-muted fs-6">Nomor Referal</div>
            <div class="col-6 text-end fs-4">{{ $invoice->id }}</div>
        </div>
        <div class="row my-3">
            <div class="col-6 small text-muted">Tanggal Pembelian</div>
            <div class="col-6 text-end fs-4">{{ $invoice->created_at->translatedFormat('d F Y') }}</div>
        </div>
        <div class="row my-3">
            <div class="col-6 small text-muted">Metode Pembayaran</div>
            <div class="col-6 text-end fs-4">{{ $invoice->payment_method }}</div>
        </div>

        <hr>

        {{-- Tiket yang Dibeli --}}
        @php
            $ticketCounts = [];
            foreach ($invoice->tickets as $ticket) {
                $ticketCounts[$ticket->name] = ($ticketCounts[$ticket->name] ?? 0) + 1;
            }
        @endphp

        @foreach($ticketCounts as $name => $count)
            @php
                $ticket = $invoice->tickets->firstWhere('name', $name);
            @endphp
            <div class="row my-3">
                <div class="col-7">Ticket {{ $name }} ({{ $count }}x)</div>
                <div class="col-5 text-end">Rp. {{ number_format($ticket->price * $count, 0, ',', '.') }}</div>
            </div>
        @endforeach

        <hr>

        <div class="row mb-5">
            <div class="col-7 fw-bold">Total Harga</div>
            <div class="col-5 text-end fw-bold">Rp. {{ number_format($invoice->total_price, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="d-flex flex-column gap-3 mt-5">
        <button type="button" class="btn btn-outline-secondary w-100 fs-4 rounded-4" onclick="history.back()">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali
        </button>
    </div>
</div>