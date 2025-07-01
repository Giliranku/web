<div>
    <!-- Filter -->
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

  <!-- Kartu Restoran -->
  <div class="container">
    <!-- Card 1 -->
    <div class="card resto-card mb-4" style="height:auto;">
      <div class="card-body row g-3 flex-column flex-lg-row">
        <div class="col-12 col-lg-4 order-2 order-lg-1 d-flex flex-column align-items-start">
          <h4 class="resto-title mb-1">DoAndFun</h4>
          <p class="text-muted resto-subtitle mb-2">Taman Bermain Ancol</p>
          <div class="d-flex align-items-center mb-3" style="gap:2rem;">
            <div class="d-flex flex-column align-items-start me-4">
              <div class="d-flex align-items-center mb-0">
                <i class="bi bi-person-fill fs-2 me-2"></i>
                <span class="fw-bold fs-3">20</span>
              </div>
              <span style="color:#111; font-size:1.15rem; font-weight:500;">Antrian</span>
            </div>
            <span class="mx-2" style="display:inline-block; width:1px; height:64px; background:#111; border-radius:1px;"></span>
            <div class="d-flex flex-column align-items-start">
              <div class="d-flex align-items-center mb-0">
                <i class="bi bi-clock-fill fs-2 me-2"></i>
                <span class="fw-bold fs-3">12</span>
              </div>
              <span style="color:#111; font-size:1.15rem; font-weight:500;">Menit</span>
            </div>
          </div>
          <div class="text-danger mb-2" style="font-size: 0.85rem;">*Pesan untuk 2 orang</div>
          <p class="resto-description mb-3">DoAndFun adalah wahana hiburan inovatif yang menawarkan petualangan 360 derajat yang mendebarkan. Menggabungkan rotasi berkecepatan tinggi, gerakan dinamis, dan efek imersif, wahana ini memberikan pengalaman unik yang mensimulasikan sensasi terbang dan jatuh bebas.</p>
          <button class="btn btn-danger btn-sm px-5 py-1 rounded-pill">Mengantri</button>
        </div>
        <div class="col-12 col-lg-8 order-1 order-lg-2">
          <!-- Desktop: 3 small + 1 big image -->
          <div class="d-none d-lg-flex w-100 align-items-start picture">
            <div class="d-flex flex-column justify-content-between" style="height:598px; gap:32px;">
              <div style="width:178px; height:178px; display:flex;">
                <img src="wahana1.png" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:top;" />
              </div>
              <div style="width:178px; height:178px; display:flex;">
                <img src="wahana1.png" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:center;" />
              </div>
              <div style="width:178px; height:178px; display:flex;">
                <img src="wahana1.png" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:bottom;" />
              </div>
            </div>
            <div class="d-flex align-items-start justify-content-center" style="margin-left:36px; width:598px; height:598px;">
              <img src="wahana1.png" style="object-fit:cover; width:598px; height:598px; aspect-ratio:1/1; object-position:center;" />
            </div>
          </div>
          <!-- Mobile: 1 big image -->
          <div class="d-block d-lg-none w-100 mb-3 picture">
            <img src="wahana1.png" class="img-fluid w-100 rounded" style="max-height:220px; object-fit:cover;" />
          </div>
        </div>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="card resto-card mb-4" style="height:auto;">
      <div class="card-body row g-3 flex-column flex-lg-row">
        <div class="col-12 col-lg-4 order-2 order-lg-1 d-flex flex-column align-items-start">
          <h4 class="resto-title mb-1">SpinReverse</h4>
          <p class="text-muted resto-subtitle mb-2">Taman Bermain Ancol</p>
          <div class="d-flex align-items-center mb-3" style="gap:2rem;">
            <div class="d-flex flex-column align-items-start me-4">
              <div class="d-flex align-items-center mb-0">
                <i class="bi bi-person-fill fs-2 me-2"></i>
                <span class="fw-bold fs-3">0</span>
              </div>
              <span style="color:#111; font-size:1.15rem; font-weight:500;">Antrian</span>
            </div>
            <span class="mx-2" style="display:inline-block; width:1px; height:64px; background:#111; border-radius:1px;"></span>
            <div class="d-flex flex-column align-items-start">
              <div class="d-flex align-items-center mb-0">
                <i class="bi bi-clock-fill fs-2 me-2"></i>
                <span class="fw-bold fs-3">0</span>
              </div>
              <span style="color:#111; font-size:1.15rem; font-weight:500;">Menit</span>
            </div>
          </div>
          <div class="text-danger mb-2" style="font-size: 0.85rem;">*Pesan untuk 5 orang</div>
          <p class="resto-description mb-3">SpinReverse adalah wahana hiburan inovatif yang menawarkan petualangan 360 derajat yang mendebarkan. Menggabungkan rotasi berkecepatan tinggi, gerakan dinamis, dan efek imersif, wahana ini memberikan pengalaman unik yang mensimulasikan sensasi terbang dan jatuh bebas.</p>
          <button class="btn btn-primary btn-sm px-5 py-1 rounded-pill">Siap Masuk</button>
        </div>
        <div class="col-12 col-lg-8 order-1 order-lg-2">
          <!-- Desktop: 3 small + 1 big image -->
          <div class="d-none d-lg-flex w-100 align-items-start picture">
            <div class="d-flex flex-column justify-content-between" style="height:598px; gap:32px;">
              <div style="width:178px; height:178px; display:flex;">
                <img src="wahana2.png" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:top;" />
              </div>
              <div style="width:178px; height:178px; display:flex;">
                <img src="wahana2.png" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:center;" />
              </div>
              <div style="width:178px; height:178px; display:flex;">
                <img src="wahana2.png" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:bottom;" />
              </div>
            </div>
            <div class="d-flex align-items-start justify-content-center" style="margin-left:36px; width:598px; height:598px;">
              <img src="wahana2.png" style="object-fit:cover; width:598px; height:598px; aspect-ratio:1/1; object-position:center;" />
            </div>
          </div>
          <!-- Mobile: 1 big image -->
          <div class="d-block d-lg-none w-100 mb-3 picture">
            <img src="wahana2.png" class="img-fluid w-100 rounded" style="max-height:220px; object-fit:cover;" />
          </div>
        </div>
      </div>
    </div>
    <!-- Card 3 -->
    <div class="card resto-card mb-4" style="height:auto;">
      <div class="card-body row g-3 flex-column flex-lg-row">
        <div class="col-12 col-lg-4 order-2 order-lg-1 d-flex flex-column align-items-start">
          <h4 class="resto-title mb-1">Mercus Tower</h4>
          <p class="text-muted resto-subtitle mb-2">Taman Bermain Ancol</p>
          <div class="d-flex align-items-center mb-3" style="gap:2rem;">
            <div class="d-flex flex-column align-items-start me-4">
              <div class="d-flex align-items-center mb-0">
                <i class="bi bi-person-fill fs-2 me-2"></i>
                <span class="fw-bold fs-3">34</span>
              </div>
              <span style="color:#111; font-size:1.15rem; font-weight:500;">Antrian</span>
            </div>
            <span class="mx-2" style="display:inline-block; width:1px; height:64px; background:#111; border-radius:1px;"></span>
            <div class="d-flex flex-column align-items-start">
              <div class="d-flex align-items-center mb-0">
                <i class="bi bi-clock-fill fs-2 me-2"></i>
                <span class="fw-bold fs-3">145</span>
              </div>
              <span style="color:#111; font-size:1.15rem; font-weight:500;">Menit</span>
            </div>
          </div>
          <div class="text-danger mb-2" style="font-size: 0.85rem;">*Pesan untuk 2 orang</div>
          <p class="resto-description mb-3">Mercus Tower adalah wahana hiburan inovatif yang menawarkan petualangan 360 derajat yang mendebarkan. Menggabungkan rotasi berkecepatan tinggi, gerakan dinamis, dan efek imersif, wahana ini memberikan pengalaman unik yang mensimulasikan sensasi terbang dan jatuh bebas.</p>
          <button class="btn btn-danger btn-sm px-5 py-1 rounded-pill">Mengantri</button>
        </div>
        <div class="col-12 col-lg-8 order-1 order-lg-2">
          <!-- Desktop: 3 small + 1 big image -->
          <div class="d-none d-lg-flex w-100 align-items-start picture">
            <div class="d-flex flex-column justify-content-between" style="height:598px; gap:32px;">
              <div style="width:178px; height:178px; display:flex;">
                <img src="wahana3.png" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:top;" />
              </div>
              <div style="width:178px; height:178px; display:flex;">
                <img src="wahana3.png" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:center;" />
              </div>
              <div style="width:178px; height:178px; display:flex;">
                <img src="wahana3.png" style="object-fit:cover; width:178px; height:178px; aspect-ratio:1/1; object-position:bottom;" />
              </div>
            </div>
            <div class="d-flex align-items-start justify-content-center" style="margin-left:36px; width:598px; height:598px;">
              <img src="wahana3.png" style="object-fit:cover; width:598px; height:598px; aspect-ratio:1/1; object-position:center;" />
            </div>
          </div>
          <!-- Mobile: 1 big image -->
          <div class="d-block d-lg-none w-100 mb-3 picture">
            <img src="wahana3.png" class="img-fluid w-100 rounded" style="max-height:220px; object-fit:cover;" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

