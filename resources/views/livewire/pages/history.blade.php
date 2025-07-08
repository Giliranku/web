<div class="container-fluid px-0" style="background:#fff; min-height:100vh;">
   
    <!-- Breadcrumb -->
    <div class="container mt-4 mb-2 px-4">
        <a href="#" class="text-dark d-flex align-items-center mb-2" style="text-decoration:none; font-weight:500;">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke profil
        </a>
    </div>
    
    <div class="container my-4">
        <div class="row g-3 align-items-center">
        <div class="col-12 col-lg-12">
            <input type="text" class="form-control search-box" placeholder="Cari">
        </div>
        <div class="col-6 col-lg-4">
            <select class="form-select">
            <option>Kapasitas Terbesar</option>
            </select>
        </div>
        <div class="col-6 col-lg-4">
            <select class="form-select">
            <option>Restoran</option>
            </select>
        </div>
        <div class="col-12 col-lg-4">
            <button class="btn btn-primary w-100">Cari</button>
        </div>
        </div>
    </div>

    <style>
    @media (max-width: 768px) {
      .history-table { display: none !important; }
      .history-card-list { display: block !important; }
    }
    @media (min-width: 769px) {
      .history-table { display: block !important; }
      .history-card-list { display: none !important; }
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
                <thead>
                    <tr style="background:#ededf0; border-radius:8px;">
                        <th class="fw-bold" style="border:none;">Nomor Referal</th>
                        <th class="fw-bold" style="border:none;">Tanggal Pembelian</th>
                        <th class="fw-bold" style="border:none;">Metode Pembayaran</th>
                        <th class="fw-bold" style="border:none;">Total</th>
                        <th style="border:none;"></th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=0; $i<8; $i++)
                    <tr style="border-bottom:1px solid #ededf0;">
                        <td style="border:none;">392387498347242</td>
                        <td style="border:none;">2 Mei 2025</td>
                        <td style="border:none;">Qris</td>
                        <td style="border:none;">Rp. 500.000</td>
                        <td style="border:none; text-align:right;">
                            <i class="bi bi-chevron-right" style="font-size:1.3rem;"></i>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

    <!-- Card List (Mobile) -->
    <div class="container px-2 pb-5 history-card-list" style="display:none;">
        @for($i=0; $i<8; $i++)
        <div class="history-card">
            <a href="#" class="invoice-link">Lihat Invoice <i class="bi bi-chevron-right"></i></a>
            <div class="mb-1"><span style="font-weight:500;">No. Referal :</span> 392387498347242</div>
            <div class="mb-1"><span style="font-weight:500;">Tanggal Pembelian :</span> 2 Mei 2025</div>
            <div class="mb-1"><span style="font-weight:500;">Metode Pembayaran :</span> Qris</div>
            <div class="history-total">
                <span>Total :</span>
                <span>Rp 500.000,</span>
            </div>
        </div>
        @endfor
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>