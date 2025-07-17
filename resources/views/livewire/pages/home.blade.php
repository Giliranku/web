@push('styles')
@vite([
        'resources/css/jesselyn.css'
        ])
<style>
   :root {
      --primary: #4ABDAC;
      --secondary: #FC4A1A; 
      --warning: #F7B733;
      --light: #FFFFFF;
      --dark: #000000;
   }
   
   .hero-section {
      background: linear-gradient(135deg, var(--primary), #3a9d94);
   }
   
   .card-hover {
      transition: all 0.3s ease;
      border: none;
   }
   
   .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
   }
   
   .section-divider {
      height: 3px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      border: none;
      margin: 3rem 0;
   }
   
   .btn-primary-custom {
      background: linear-gradient(45deg, var(--primary), #3a9d94);
      border: none;
      border-radius: 25px;
      padding: 12px 30px;
      color: white;
      font-weight: 600;
      transition: all 0.3s ease;
   }
   
   .btn-primary-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(74, 189, 172, 0.4);
   }
   
   .btn-secondary-custom {
      background: linear-gradient(45deg, var(--secondary), #e03d0f);
      border: none;
      border-radius: 25px;
      padding: 12px 30px;
      color: white;
      font-weight: 600;
      transition: all 0.3s ease;
   }
   
   .btn-secondary-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(252, 74, 26, 0.4);
   }
   
   .stats-card {
      background: linear-gradient(135deg, var(--light), #f8f9fa);
      border-radius: 15px;
      padding: 2rem;
      border: 2px solid var(--primary);
      transition: all 0.3s ease;
   }
   
   .stats-card:hover {
      background: linear-gradient(135deg, var(--primary), #3a9d94);
      color: white;
   }
   
   .image-container {
      border-radius: 15px;
      overflow: hidden;
      position: relative;
   }
   
   .image-container::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, transparent, rgba(74, 189, 172, 0.1));
      transition: all 0.3s ease;
   }
   
   .image-container:hover::after {
      background: linear-gradient(45deg, transparent, rgba(74, 189, 172, 0.2));
   }
   
   /* Mobile Carousel Fixes */
   @media (max-width: 767.98px) {
      .mobile-carousel-container {
         display: flex;
         justify-content: center;
         align-items: center;
         gap: 15px;
         padding: 0 20px;
      }
      
      .mobile-carousel-item {
         flex-shrink: 0;
         text-align: center;
      }
      
      .mobile-carousel-item.main {
         transform: scale(1.1);
         z-index: 10;
      }
      
      .mobile-carousel-item.side {
         opacity: 0.7;
         transform: scale(0.85);
      }
      
      .mobile-carousel-item img {
         width: 80px !important;
         height: 80px !important;
         object-fit: cover;
         border-radius: 12px;
      }
      
      .mobile-carousel-item.main img {
         width: 100px !important;
         height: 100px !important;
      }
      
      .mobile-carousel-item h6 {
         font-size: 0.7rem !important;
         margin-top: 8px !important;
         margin-bottom: 0 !important;
         line-height: 1.2 !important;
      }
      
      .mobile-carousel-item.main h6 {
         font-size: 0.8rem !important;
      }
   }
</style>
@endpush

<div class="overflow-x-hidden home-page">
   <!-- Full Screen Hero Section -->
   <div class="position-relative" style="height: 100vh; min-height: 600px;">
      <!-- Thin Search Bar at Top -->
      <div class="position-absolute w-100" style="top: 20px; z-index: 1030;">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-6 col-md-8">
                  <div class="search-container">
                     <i class="bi bi-search search-icon text-muted d-none"></i>
                     <input type="text" class="form-control border-0 shadow-lg" 
                            class="form-control home-search-input ms-5" 
                            placeholder="Cari wahana, restoran, atau info menarik...">
                            
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Full Screen Carousel -->
      <div id="carouselExampleInterval" class="carousel slide h-100" data-bs-ride="carousel">
         <div class="carousel-inner h-100">
            <div class="carousel-item active h-100" data-bs-interval="10000">
               <div class="position-relative h-100">
                  <img src="{{asset('img/promobanner1.jpg')}}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Gambar Acara Berkemah di Bawah Laut">
                  <!-- Gradient overlay for better text readability -->
                  <div class="position-absolute top-0 start-0 w-100 h-100 home-card-overlay-1"></div>
               </div>
            </div>
            <div class="carousel-item h-100" data-bs-interval="2000">
               <div class="position-relative h-100">
                  <img src="{{asset('img/promobanner2.jpg')}}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Gambar Acara Pertunjukan Robot">
                  <div class="position-absolute top-0 start-0 w-100 h-100 home-card-overlay-2"></div>
               </div>
            </div>
            <div class="carousel-item h-100">
               <div class="position-relative h-100">
                  <img src="{{asset('img/promobanner3.jpg')}}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Gambar Promo Gratis Minuman">
                  <div class="position-absolute top-0 start-0 w-100 h-100 home-card-overlay-3"></div>
               </div>
            </div>
         </div>

         <!-- Modern carousel controls -->
         <button class="carousel-control-prev position-absolute top-50 start-0 translate-middle-y ms-3" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <div class="d-flex align-items-center justify-content-center home-nav-btn">
               <span class="carousel-control-prev-icon" style="filter: invert(1);" aria-hidden="true"></span>
            </div>
            <span class="visually-hidden">Previous</span>
         </button>

         <button class="carousel-control-next position-absolute top-50 end-0 translate-middle-y me-3" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <div class="d-flex align-items-center justify-content-center home-nav-btn">
               <span class="carousel-control-next-icon" style="filter: invert(1);" aria-hidden="true"></span>
            </div>
            <span class="visually-hidden">Next</span>
         </button>

         <!-- Carousel indicators -->
         <div class="carousel-indicators position-absolute bottom-0 start-50 translate-middle-x mb-4" style="margin: 0;">
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0" class="active home-indicator" aria-current="true"></button>
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="1" class="home-indicator"></button>
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="2" class="home-indicator"></button>
         </div>
      </div>
   </div>
   <!-- Welcome Section -->
   <div class="container my-5">
      <div class="text-center mb-5">
         <h2 class="display-5 fw-bold text-primary">Selamat Datang di Giliranku</h2>
         <p class="lead text-dark">Wahana Seru Sepuasnya!</p>
         <hr class="section-divider w-25 mx-auto">
      </div>

      <div class="row align-items-center g-4">
         <div class="col-lg-4 text-center">
            <div class="image-container">
               <img src="{{asset('img/logo-icon.png')}}" class="img-fluid" style="max-width: 300px;" alt="Logo Giliranku">
            </div>
         </div>
         <div class="col-lg-8">
            <div class="ps-lg-4">
               <h3 class="fw-bold mb-4" style="color: var(--dark);">Taman Hiburan Giliranku</h3>
               <p class="fs-5 text-muted leading-relaxed">
                  Nikmati sensasi petualangan tak terlupakan di Taman Hiburan Giliranku, destinasi seru yang cocok untuk segala usia, mulai dari keluarga, teman-teman, hingga para pencari adrenalin sejati. 
               </p>
               <p class="fs-5 text-muted">
                  Dengan beragam wahana ekstrem yang memacu jantung, zona anak yang aman dan menyenangkan, serta berbagai spot foto Instagramable, setiap sudut taman ini dirancang untuk memberikan pengalaman yang tak terlupakan!
               </p>
            </div>
         </div>
      </div>
   </div>
   <!-- Statistics Section -->
   <div class="container my-5">
      <div class="row g-4">
         <div class="col-md-4">
            <div class="stats-card text-center">
               <h3 class="fw-bold mb-2" style="color: var(--secondary);">500.000+</h3>
               <p class="mb-0 fs-5">Pengunjung setiap harinya</p>
            </div>
         </div>
         <div class="col-md-4">
            <div class="stats-card text-center">
               <h3 class="fw-bold mb-2" style="color: var(--secondary);">30+</h3>
               <p class="mb-0 fs-5">Wahana unik</p>
            </div>
         </div>
         <div class="col-md-4">
            <div class="stats-card text-center">
               <h3 class="fw-bold mb-2" style="color: var(--secondary);">10+</h3>
               <p class="mb-0 fs-5">Promo setiap bulan</p>
            </div>
         </div>
      </div>
   </div>

   <!-- Ticket Purchase CTA -->
   <div class="py-5 home-gradient-bg">
      <div class="container text-center">
         <h2 class="fw-bold mb-3" style="color: var(--dark);">Beli <span style="color: var(--primary);">Tiket</span> Sekarang!</h2>
         <p class="lead text-muted mb-4">Dapatkan akses ke semua wahana seru dengan harga terbaik</p>
         <a class="btn btn-primary-custom btn-lg px-5" href="#" role="button">
            <i class="bi bi-ticket-perforated me-2"></i>Beli Tiket
         </a>
      </div>
   </div>

   <!-- Queue System Section -->
   <div class="container my-5">
      <div class="text-center mb-5">
         <h3 class="fw-bold" style="color: var(--dark);">
            <span style="color: var(--primary);">Sudah punya tiket</span> dan mau menikmati semua wahana?
         </h3>
         <p class="lead text-muted mt-3">Yuk coba sistem antrian online kami!</p>
      </div>

      <div class="row g-4 justify-content-center">
         <div class="col-md-6 col-lg-4">
            <a href="" class="text-decoration-none">
               <div class="card card-hover h-100 text-center p-4">
                  <div class="card-body">
                     <div class="mb-3" style="color: var(--primary);">
                        <i class="bi bi-car-front-fill" style="font-size: 4rem;"></i>
                     </div>
                     <h4 class="card-title fw-bold" style="color: var(--dark);">Wahana</h4>
                     <p class="card-text text-muted">Kamu bisa ngantri disini!</p>
                     <div class="mt-3">
                        <span class="btn btn-outline-primary btn-sm">Lihat Antrian</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>
         
         <div class="col-md-6 col-lg-4">
            <a href="" class="text-decoration-none">
               <div class="card card-hover h-100 text-center p-4">
                  <div class="card-body">
                     <div class="mb-3" style="color: var(--secondary);">
                        <i class="bi bi-house-door" style="font-size: 4rem;"></i>
                     </div>
                     <h4 class="card-title fw-bold" style="color: var(--dark);">Restoran</h4>
                     <p class="card-text text-muted">Bisa juga ngantri disini!</p>
                     <div class="mt-3">
                        <span class="btn btn-outline-danger btn-sm">Lihat Antrian</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>
      </div>
   </div>
   <!-- Attractions Section -->
   <div class="container my-5">
      <div class="text-center mb-5">
         <h3 class="fw-bold" style="color: var(--dark);">
            Giliranku punya banyak <span style="color: var(--primary);">wahana</span> lho!
         </h3>
         <hr class="section-divider w-25 mx-auto">
      </div>

      <div id="wahanaCarousel" class="carousel slide position-relative" data-bs-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <!-- Mobile Layout (3 items: side-main-side) -->
               <div class="d-md-none">
                  <div class="mobile-carousel-container">
                     <div class="mobile-carousel-item side">
                        <img src="{{ asset('img/ontang-anting.jpg') }}" alt="Gambar Wahana Ontang Anting">
                        <h6 class="fw-bold" style="color: var(--dark);">Ontang Anting</h6>
                     </div>
                     <div class="mobile-carousel-item main">
                        <img src="{{ asset('img/halilintar.jpg') }}" alt="Gambar Wahana Halilintar">
                        <h6 class="fw-bold" style="color: var(--dark);">Halilintar</h6>
                     </div>
                     <div class="mobile-carousel-item side">
                        <img src="{{ asset('img/arung-jeram.jpg') }}" alt="Gambar Wahana Arung Jeram">
                        <h6 class="fw-bold" style="color: var(--dark);">Arung Jeram</h6>
                     </div>
                  </div>
               </div>

               <!-- Tablet Layout (2 items per row) -->
               <div class="d-none d-md-block d-lg-none">
                  <div class="row g-4 justify-content-center">
                     <div class="col-6">
                        <div class="text-center">
                           <div class="image-container mb-3">
                              <img src="{{ asset('img/halilintar.jpg') }}" class="img-fluid rounded-3" style="width: 180px; height: 180px; object-fit: cover;" alt="Gambar Wahana Halilintar">
                           </div>
                           <h5 class="fw-bold" style="color: var(--dark);">Halilintar</h5>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="text-center">
                           <div class="image-container mb-3">
                              <img src="{{ asset('img/arung-jeram.jpg') }}" class="img-fluid rounded-3" style="width: 180px; height: 180px; object-fit: cover;" alt="Gambar Wahana Arung Jeram">
                           </div>
                           <h5 class="fw-bold" style="color: var(--dark);">Arung Jeram</h5>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Desktop Layout (3 items per row) -->
               <div class="d-none d-lg-block">
                  <div class="row g-4 justify-content-center">
                     <div class="col-md-4">
                        <div class="text-center">
                           <div class="image-container mb-3">
                              <img src="{{ asset('img/halilintar.jpg') }}" class="img-fluid rounded-3" style="width: 200px; height: 200px; object-fit: cover;" alt="Gambar Wahana Halilintar">
                           </div>
                           <h5 class="fw-bold" style="color: var(--dark);">Halilintar</h5>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="text-center">
                           <div class="image-container mb-3">
                              <img src="{{ asset('img/arung-jeram.jpg') }}" class="img-fluid rounded-3" style="width: 200px; height: 200px; object-fit: cover;" alt="Gambar Wahana Arung Jeram">
                           </div>
                           <h5 class="fw-bold" style="color: var(--dark);">Arung Jeram</h5>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="text-center">
                           <div class="image-container mb-3">
                              <img src="{{ asset('img/bianglala.jpg') }}" class="img-fluid rounded-3" style="width: 200px; height: 200px; object-fit: cover;" alt="Gambar Wahana Bianglala">
                           </div>
                           <h5 class="fw-bold" style="color: var(--dark);">Bianglala</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="carousel-item">
               <!-- Mobile Layout (3 items: side-main-side) -->
               <div class="d-md-none">
                  <div class="mobile-carousel-container">
                     <div class="mobile-carousel-item side">
                        <img src="{{ asset('img/halilintar.jpg') }}" alt="Gambar Wahana Halilintar">
                        <h6 class="fw-bold" style="color: var(--dark);">Halilintar</h6>
                     </div>
                     <div class="mobile-carousel-item main">
                        <img src="{{ asset('img/bianglala.jpg') }}" alt="Gambar Wahana Bianglala">
                        <h6 class="fw-bold" style="color: var(--dark);">Bianglala</h6>
                     </div>
                     <div class="mobile-carousel-item side">
                        <img src="{{ asset('img/ice-age.jpg') }}" alt="Gambar Wahana Ice Age">
                        <h6 class="fw-bold" style="color: var(--dark);">Ice Age</h6>
                     </div>
                  </div>
               </div>

               <!-- Tablet Layout (2 items per row) -->
               <div class="d-none d-md-block d-lg-none">
                  <div class="row g-4 justify-content-center">
                     <div class="col-6">
                        <div class="text-center">
                           <div class="image-container mb-3">
                              <img src="{{ asset('img/bianglala.jpg') }}" class="img-fluid rounded-3" style="width: 180px; height: 180px; object-fit: cover;" alt="Gambar Wahana Bianglala">
                           </div>
                           <h5 class="fw-bold" style="color: var(--dark);">Bianglala</h5>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="text-center">
                           <div class="image-container mb-3">
                              <img src="{{ asset('img/ice-age.jpg') }}" class="img-fluid rounded-3" style="width: 180px; height: 180px; object-fit: cover;" alt="Gambar Wahana Ice Age">
                           </div>
                           <h5 class="fw-bold" style="color: var(--dark);">Ice Age</h5>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Desktop Layout (3 items per row) -->
               <div class="d-none d-lg-block">
                  <div class="row g-4 justify-content-center">
                     <div class="col-md-4">
                        <div class="text-center">
                           <div class="image-container mb-3">
                              <img src="{{ asset('img/ice-age.jpg') }}" class="img-fluid rounded-3" style="width: 200px; height: 200px; object-fit: cover;" alt="Gambar Wahana Ice Age">
                           </div>
                           <h5 class="fw-bold" style="color: var(--dark);">Ice Age</h5>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="text-center">
                           <div class="image-container mb-3">
                              <img src="{{ asset('img/kora-kora.jpg') }}" class="img-fluid rounded-3" style="width: 200px; height: 200px; object-fit: cover;" alt="Gambar Wahana Kora Kora">
                           </div>
                           <h5 class="fw-bold" style="color: var(--dark);">Kora Kora</h5>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="text-center">
                           <div class="image-container mb-3">
                              <img src="{{ asset('img/ontang-anting.jpg') }}" class="img-fluid rounded-3" style="width: 200px; height: 200px; object-fit: cover;" alt="Gambar Wahana Ontang Anting">
                           </div>
                           <h5 class="fw-bold" style="color: var(--dark);">Ontang Anting</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <!-- Fixed carousel controls -->
         <button class="carousel-control-prev position-absolute top-50 start-0 translate-middle-y" type="button" data-bs-target="#wahanaCarousel" data-bs-slide="prev">
            <div class="d-flex align-items-center justify-content-center" 
                 style="width: 50px; height: 50px; background: var(--primary); border-radius: 50%; transition: all 0.3s ease; margin-left: 15px;">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </div>
            <span class="visually-hidden">Previous</span>
         </button>

         <button class="carousel-control-next position-absolute top-50 end-0 translate-middle-y" type="button" data-bs-target="#wahanaCarousel" data-bs-slide="next">
            <div class="d-flex align-items-center justify-content-center" 
                 style="width: 50px; height: 50px; background: var(--primary); border-radius: 50%; transition: all 0.3s ease; margin-right: 15px;">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </div>
            <span class="visually-hidden">Next</span>
         </button>
      </div>
   </div>

   <!-- Restaurants Section -->
   <div class="container my-5">
      <div class="text-center mb-5">
         <h3 class="fw-bold" style="color: var(--dark);">
            Tersedia pula banyak <span style="color: var(--secondary);">tempat makan</span> disini!
         </h3>
         <hr class="section-divider w-25 mx-auto">
      </div>

      <!-- Restaurant Static Display (No Carousel) -->
      <div class="position-relative">
         <!-- Mobile Layout (3 items: side-main-side) -->
         <div class="d-md-none">
            <div class="mobile-carousel-container">
               <div class="mobile-carousel-item side">
                  <div class="restaurant-card-bg">
                     <img src="{{ asset('img/roti-o.png') }}" style="object-fit: contain; height: 80px;" alt="Gambar Restoran Roti O">
                  </div>
                  <h6 class="fw-bold" style="color: var(--dark);">Roti O</h6>
               </div>
               <div class="mobile-carousel-item main">
                  <div class="restaurant-card-bg">
                     <img src="{{ asset('img/aw.png') }}" style="object-fit: contain; height: 100px;" alt="Gambar Restoran A&W">
                  </div>
                  <h6 class="fw-bold" style="color: var(--dark);">A&W</h6>
               </div>
               <div class="mobile-carousel-item side">
                  <div class="restaurant-card-bg">
                     <img src="{{ asset('img/chatime.png') }}" style="object-fit: contain; height: 80px;" alt="Gambar Minuman Chatime">
                  </div>
                  <h6 class="fw-bold" style="color: var(--dark);">Chatime</h6>
               </div>
            </div>
         </div>

         <!-- Tablet Layout (2 items per row) -->
         <div class="d-none d-md-block d-lg-none">
            <div class="row g-4 justify-content-center">
               <div class="col-6">
                  <div class="text-center">
                     <div class="restaurant-card-bg-large">
                        <img src="{{ asset('img/aw.png') }}" class="img-fluid" style="object-fit: contain; height: 120px;" alt="Gambar Restoran A&W">
                     </div>
                     <h5 class="fw-bold" style="color: var(--dark);">A&W</h5>
                  </div>
               </div>
               <div class="col-6">
                  <div class="text-center">
                     <div class="restaurant-card-bg-large">
                        <img src="{{ asset('img/chatime.png') }}" class="img-fluid" style="object-fit: contain; height: 120px;" alt="Gambar Minuman Chatime">
                     </div>
                     <h5 class="fw-bold" style="color: var(--dark);">Chatime</h5>
                  </div>
               </div>
            </div>
         </div>

         <!-- Desktop Layout (3+ items per row) -->
         <div class="d-none d-lg-block">
            <div class="row g-4 justify-content-center">
               <div class="col-md-2">
                  <div class="text-center">
                     <div class="restaurant-card-bg-large">
                        <img src="{{ asset('img/aw.png') }}" class="img-fluid" style="object-fit: contain; height: 100px;" alt="Gambar Restoran A&W">
                     </div>
                     <h6 class="fw-bold" style="color: var(--dark);">A&W</h6>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="text-center">
                     <div class="restaurant-card-bg-large">
                        <img src="{{ asset('img/chatime.png') }}" class="img-fluid" style="object-fit: contain; height: 100px;" alt="Gambar Minuman Chatime">
                     </div>
                     <h6 class="fw-bold" style="color: var(--dark);">Chatime</h6>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="text-center">
                     <div class="restaurant-card-bg-large">
                        <img src="{{ asset('img/kfc.webp') }}" class="img-fluid" style="object-fit: contain; height: 100px;" alt="Gambar Restoran KFC">
                     </div>
                     <h6 class="fw-bold" style="color: var(--dark);">KFC</h6>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="text-center">
                     <div class="restaurant-card-bg-large">
                        <img src="{{ asset('img/mcd.png') }}" class="img-fluid" style="object-fit: contain; height: 100px;" alt="Gambar Restoran McDonald">
                     </div>
                     <h6 class="fw-bold" style="color: var(--dark);">McDonald</h6>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="text-center">
                     <div class="restaurant-card-bg-large">
                        <img src="{{ asset('img/pizza-hut.png') }}" class="img-fluid" style="object-fit: contain; height: 100px;" alt="Gambar Restoran Pizza Hut">
                     </div>
                     <h6 class="fw-bold" style="color: var(--dark);">Pizza Hut</h6>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="text-center">
                     <div class="restaurant-card-bg-large">
                        <img src="{{ asset('img/roti-o.png') }}" class="img-fluid" style="object-fit: contain; height: 100px;" alt="Gambar Restoran Roti O">
                     </div>
                     <h6 class="fw-bold" style="color: var(--dark);">Roti O</h6>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Queue Booking CTA -->
   <div class="py-5" style="background: linear-gradient(135deg, var(--primary), #3a9d94);">
      <div class="container text-center">
         <h2 class="fw-bold mb-3 text-white">Pesan <span style="color: var(--warning);">Antrianmu</span> Sekarang!</h2>
         <p class="lead text-white mb-4">Hindari antrian panjang dengan sistem booking online kami</p>
         <a class="btn btn-secondary-custom btn-lg px-5" href="#" role="button">
            <i class="bi bi-clock me-2"></i>Pesan Antrian
         </a>
      </div>
   </div>

   <!-- Fun Activities Section -->
   <div class="container my-5">
      <div class="text-center mb-5">
         <h3 class="fw-bold" style="color: var(--dark);">Kegiatan Seru Disini</h3>
         <hr class="section-divider w-25 mx-auto">
      </div>

      <div class="row g-4">
         <div class="col-12">
            <a href="" class="text-decoration-none">
               <div class="card card-hover border-0 shadow-sm">
                  <div class="row g-0">
                     <div class="col-md-6">
                        <div class="image-container">
                           <img src="{{asset('img/kegiatanseru1.jpg')}}" class="img-fluid w-100" style="height: 300px; object-fit: cover;" alt="Gambar Acara Pertunjukan Robot">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card-body d-flex flex-column justify-content-center h-100 p-4">
                           <h4 class="card-title fw-bold" style="color: var(--primary);">Robot Show Dufan</h4>
                           <p class="card-text text-muted">Saksikan pertunjukan robot yang mengagumkan dengan teknologi terdepan dan efek visual yang memukau.</p>
                           <div class="mt-3">
                              <span class="btn btn-outline-primary">Lihat Detail</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-md-4">
            <a href="" class="text-decoration-none">
               <div class="card card-hover border-0 shadow-sm h-100">
                  <div class="image-container">
                     <img src="{{asset('img/kegiatanseru2.jpg')}}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Gambar Acara Layangan Jakarta">
                  </div>
                  <div class="card-body text-center">
                     <h6 class="card-title fw-bold" style="color: var(--dark);">Bertualang Seru</h6>
                     <p class="card-text text-muted small">Petualangan seru menanti Anda</p>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-md-4">
            <a href="" class="text-decoration-none">
               <div class="card card-hover border-0 shadow-sm h-100">
                  <div class="image-container">
                     <img src="{{asset('img/kegiatanseru3.jpg')}}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Gambar Acara Layangan Jakarta">
                  </div>
                  <div class="card-body text-center">
                     <h6 class="card-title fw-bold" style="color: var(--dark);">Bermain Layangan</h6>
                     <p class="card-text text-muted small">Nikmati kebebasan di udara terbuka</p>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-md-4">
            <a href="" class="text-decoration-none">
               <div class="card card-hover border-0 shadow-sm h-100">
                  <div class="image-container">
                     <img src="{{asset('img/kegiatanseru4.jpg')}}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Gambar Acara Layangan Jakarta">
                  </div>
                  <div class="card-body text-center">
                     <h6 class="card-title fw-bold" style="color: var(--dark);">Menyelam</h6>
                     <p class="card-text text-muted small">Jelajahi keindahan bawah air</p>
                  </div>
               </div>
            </a>
         </div>
      </div>

      <div class="text-center mt-4">
         <a class="btn btn-outline-primary" href="#">
            Lihat kegiatan seru lainnya <i class="bi bi-arrow-right ms-1"></i>
         </a>
      </div>
   </div>

   <!-- Special Promotions Section -->
   <div class="container my-5">
      <div class="text-center mb-5">
         <h3 class="fw-bold" style="color: var(--dark);">Promo Spesial</h3>
         <hr class="section-divider w-25 mx-auto">
      </div>

      <div class="row g-4">
         <div class="col-md-4">
            <a href="" class="text-decoration-none">
               <div class="card card-hover border-0 shadow-sm h-100">
                  <div class="image-container">
                     <img src="{{asset('img/atlantis.jpeg')}}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Gambar Promo Atlantis">
                  </div>
                  <div class="card-body text-center">
                     <h6 class="card-title fw-bold" style="color: var(--secondary);">Berenang paling HEMAT</h6>
                     <p class="card-text text-muted">cuman di ATLANTIS!</p>
                     <div class="mt-3">
                        <span class="badge" style="background-color: var(--warning); color: var(--dark);">Promo Terbatas</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-md-4">
            <a href="" class="text-decoration-none">
               <div class="card card-hover border-0 shadow-sm h-100">
                  <div class="image-container">
                     <img src="{{asset('img/dufan.jpeg')}}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Gambar Promo Dufan">
                  </div>
                  <div class="card-body text-center">
                     <h6 class="card-title fw-bold" style="color: var(--secondary);">Main sambil belajar di</h6>
                     <p class="card-text text-muted">SEAWORLD HEMAT!</p>
                     <div class="mt-3">
                        <span class="badge" style="background-color: var(--warning); color: var(--dark);">Promo Terbatas</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-md-4">
            <a href="" class="text-decoration-none">
               <div class="card card-hover border-0 shadow-sm h-100">
                  <div class="image-container">
                     <img src="{{asset('img/seaworld.jpeg')}}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Gambar Promo Seaworld">
                  </div>
                  <div class="card-body text-center">
                     <h6 class="card-title fw-bold" style="color: var(--secondary);">Main di DUFAN,</h6>
                     <p class="card-text text-muted">HEMAT sepuasnya!</p>
                     <div class="mt-3">
                        <span class="badge" style="background-color: var(--warning); color: var(--dark);">Promo Terbatas</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>
      </div>

      <div class="text-center mt-4">
         <a class="btn btn-outline-danger" href="#">
            Lihat promo lainnya <i class="bi bi-arrow-right ms-1"></i>
         </a>
      </div>
   </div>

   <!-- Info Giliranku Section -->
   <div class="container my-5 mb-6">
      <div class="text-center mb-5">
         <h3 class="fw-bold" style="color: var(--dark);">Info Giliranku</h3>
         <hr class="section-divider w-25 mx-auto">
      </div>

      <div class="row g-4">
         <div class="col-12">
            <a href="" class="text-decoration-none">
               <div class="card card-hover border-0 shadow-sm">
                  <div class="row g-0">
                     <div class="col-md-6">
                        <div class="image-container">
                           <img src="{{asset('img/info1.jpg')}}" class="img-fluid w-100" style="height: 300px; object-fit: cover;" alt="Gambar Pantai Ancol">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card-body d-flex flex-column justify-content-center h-100 p-4">
                           <h4 class="card-title fw-bold" style="color: var(--primary);">Kenapa Harus ke Ancol?</h4>
                           <p class="card-text text-muted">Temukan alasan mengapa Ancol menjadi destinasi wisata favorit keluarga Indonesia dengan berbagai fasilitas lengkap dan wahana seru.</p>
                           <div class="mt-3">
                              <span class="btn btn-outline-primary">Baca Selengkapnya</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-md-6">
            <a href="" class="text-decoration-none">
               <div class="card card-hover border-0 shadow-sm h-100">
                  <div class="image-container">
                     <img src="{{asset('img/info2.jpg')}}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Gambar Wahana Dufan">
                  </div>
                  <div class="card-body text-center">
                     <h6 class="card-title fw-bold" style="color: var(--dark);">Klarifikasi Tornado Tutup</h6>
                     <p class="card-text text-muted">Informasi terbaru mengenai status wahana Tornado</p>
                     <div class="mt-3">
                        <span class="btn btn-outline-secondary btn-sm">Baca Selengkapnya</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-md-6">
            <a href="" class="text-decoration-none">
               <div class="card card-hover border-0 shadow-sm h-100">
                  <div class="image-container">
                     <img src="{{asset('img/info3.jpg')}}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Gambar Konser Ancol">
                  </div>
                  <div class="card-body text-center">
                     <h6 class="card-title fw-bold" style="color: var(--dark);">Merayakan Konser di Tengah Pantai Ancol</h6>
                     <p class="card-text text-muted">Pengalaman unik konser dengan pemandangan pantai yang memukau</p>
                     <div class="mt-3">
                        <span class="btn btn-outline-secondary btn-sm">Baca Selengkapnya</span>
                     </div>
                  </div>
               </div>
            </a>
         </div>
      </div>

      <div class="text-center mt-4">
         <a class="btn btn-outline-primary" href="#">
            Lihat informasi lainnya <i class="bi bi-arrow-right ms-1"></i>
         </a>
      </div>
   </div>
</div>