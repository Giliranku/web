@push('styles')
<style>
/* === Color Palette === */
:root {
   --primary: #4ABDAC;
   --secondary: #FC4A1A; 
   --warning: #F7B733;
   --light: #FFFFFF;
   --dark: #2c3e50;
   --gray-light: #f8f9fa;
   --gray-medium: #6c757d;
   --gradient-primary: linear-gradient(135deg, #4ABDAC, #3a9d94);
   --gradient-secondary: linear-gradient(135deg, #FC4A1A, #e03d0f);
}

/* === Page Hero Section === */
.page-hero {
   background: var(--gradient-primary);
   padding: 3rem 0 2rem;
   color: white;
}

.page-title {
   font-size: clamp(1.75rem, 4vw, 2.5rem);
   font-weight: 600;
   margin-bottom: 0.5rem;
   text-align: center;
}

.page-subtitle {
   font-size: clamp(1rem, 2vw, 1.1rem);
   font-weight: 300;
   opacity: 0.9;
   margin-bottom: 2.5rem;
   text-align: center;
}

/* ===== MINIMALIST ABOUT US STYLES ===== */

/* === Base Reset === */
* {
    box-sizing: border-box;
}

/* === Simple Animations === */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* === Simple Buttons === */
.btn-minimal {
    padding: 12px 32px;
    border: 2px solid #4ABDAC;
    border-radius: 12px;
    background: transparent;
    color: #4ABDAC;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}

.btn-minimal:hover {
    background: #4ABDAC;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(74, 189, 172, 0.3);
}

.btn-minimal-primary {
    background: #4ABDAC;
    color: white !important;
    border-radius: 12px;
}

.btn-minimal-primary:hover {
    background: #3a9d94;
    border-color: #3a9d94;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(74, 189, 172, 0.4);
}

/* === Stats Section - Clean === */
.stats-section {
    padding: 4rem 0;
    /* background: #f8f9fa; */
}

.stat-item {
    text-align: center;
    padding: 2rem 1rem;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #4ABDAC;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1rem;
    /* color: #2c3e50; */
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.stat-desc {
    font-size: 0.9rem;
    /* color: #6c757d; */
}

/* === Content Sections === */
.content-section {
    padding: 4rem 0;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 300;
    /* color: #2c3e50; */
    margin-bottom: 1rem;
    text-align: center;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    text-align: center;
    max-width: 600px;
    margin: 0 auto 3rem;
    font-weight: 300;
}

/* === Service Cards - Minimal === */
.service-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin-top: 3rem;
}

@media (max-width: 992px) {
    .service-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
}

@media (max-width: 576px) {
    .service-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

.service-item {
    padding: 2rem;
    /* background: white; */
    border: 1px solid #e9ecef;
    border-radius: 16px;
    text-align: center;
    transition: all 0.3s ease;
}

.service-item:hover {
    border-color: #4ABDAC;
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border-radius: 20px;
}

.service-icon {
    width: 60px;
    height: 60px;
    background: #4ABDAC;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 1.5rem;
}

.service-title {
    font-size: 1.25rem;
    font-weight: 500;
    /* color: #2c3e50; */
    margin-bottom: 1rem;
}

.service-desc {
    /* color: #6c757d; */
    line-height: 1.6;
    font-size: 0.95rem;
}

/* === Values Section === */
.values-section {
    /* background: #f8f9fa; */
    padding: 4rem 0;
}

.value-item {
    text-align: center;
    padding: 1.5rem;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.value-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.value-icon {
    width: 50px;
    height: 50px;
    background: #4ABDAC;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
}

.value-title {
    font-weight: 500;
    /* color: #2c3e50; */
    margin-bottom: 0.5rem;
}

.value-desc {
    /* color: #6c757d; */
    font-size: 0.9rem;
}

/* === CTA Section === */
.cta-section {
    padding: 5rem 0;
    /* background: white; */
    text-align: center;
    border-top: 1px solid #e9ecef;
}

.cta-title {
    font-size: 2rem;
    font-weight: 300;
    /* color: #2c3e50; */
    margin-bottom: 1rem;
}

.cta-desc {
    color: #6c757d;
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* === Responsive === */
@media (max-width: 768px) {
    .hero-section {
        padding: 4rem 0 3rem;
    }
    
    .content-section,
    .stats-section,
    .values-section,
    .cta-section {
        padding: 3rem 0;
    }
    
    .service-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

/* === Utility Classes === */
.fade-in {
    animation: fadeIn 0.8s ease-out;
}

.text-muted-light {
    color: #6c757d !important;
}
</style>
@endpush

<div class="about-us-page">
    {{-- ===== PAGE HERO SECTION ===== --}}
    <section class="page-hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="page-title">🎡 Tentang Giliranku</h1>
                    <p class="page-subtitle">Destinasi hiburan modern yang menghadirkan pengalaman tak terlupakan dengan teknologi inovatif dan pelayanan terbaik untuk seluruh keluarga</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== STATS SECTION ===== --}}
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item fade-in">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Pengunjung Bahagia</div>
                        <div class="stat-desc">Setiap tahunnya</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item fade-in">
                        <div class="stat-number">25+</div>
                        <div class="stat-label">Wahana Seru</div>
                        <div class="stat-desc">Pilihan beragam</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item fade-in">
                        <div class="stat-number">5</div>
                        <div class="stat-label">Tahun Beroperasi</div>
                        <div class="stat-desc">Pengalaman terpercaya</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item fade-in">
                        <div class="stat-number">4.8</div>
                        <div class="stat-label">Rating Kepuasan</div>
                        <div class="stat-desc">Dari pengunjung</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== SERVICES SECTION ===== --}}
    <section class="content-section">
        <div class="container">
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-subtitle">
                Teknologi modern untuk pengalaman yang lebih baik
            </p>
            
            <div class="service-grid">
                <div class="service-item fade-in">
                    <div class="service-icon">
                        <i class="bi bi-clock"></i>
                    </div>
                    <h3 class="service-title">Queue Management</h3>
                    <p class="service-desc">
                        Sistem antrian digital yang memungkinkan Anda menikmati wahana tanpa menunggu lama.
                    </p>
                </div>
                
                <div class="service-item fade-in">
                    <div class="service-icon">
                        <i class="bi bi-cart"></i>
                    </div>
                    <h3 class="service-title">Online Ticketing</h3>
                    <p class="service-desc">
                        Beli tiket secara online dengan mudah dan aman. Pembayaran yang terpercaya.
                    </p>
                </div>
                
                <div class="service-item fade-in">
                    <div class="service-icon">
                        <i class="bi bi-universal-access"></i>
                    </div>
                    <h3 class="service-title">Accessibility</h3>
                    <p class="service-desc">
                        Fasilitas ramah disabilitas dengan fitur aksesibilitas untuk semua pengunjung.
                    </p>
                </div>
                
                <div class="service-item fade-in">
                    <div class="service-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h3 class="service-title">Customer Support</h3>
                    <p class="service-desc">
                        Tim dukungan siap membantu Anda dengan berbagai pertanyaan dan kendala.
                    </p>
                </div>
                
                <div class="service-item fade-in">
                    <div class="service-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="service-title">Safety First</h3>
                    <p class="service-desc">
                        Standar keselamatan internasional dengan protokol keamanan yang ketat.
                    </p>
                </div>
                
                <div class="service-item fade-in">
                    <div class="service-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    <h3 class="service-title">Premium Experience</h3>
                    <p class="service-desc">
                        Pengalaman premium dengan fasilitas VIP dan layanan personal terbaik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== VALUES SECTION ===== --}}
    <section class="values-section">
        <div class="container">
            <h2 class="section-title">Nilai-Nilai Kami</h2>
            <p class="section-subtitle">
                Komitmen kami terhadap sustainability dan community
            </p>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-item fade-in">
                        <div class="value-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h4 class="value-title">Kesehatan & Kesejahteraan</h4>
                        <p class="value-desc">Menjamin kesehatan dan kesejahteraan untuk semua pengunjung</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-item fade-in">
                        <div class="value-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <h4 class="value-title">Pekerjaan Layak</h4>
                        <p class="value-desc">Menciptakan lapangan kerja dan mendukung pertumbuhan ekonomi</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-item fade-in">
                        <div class="value-icon">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <h4 class="value-title">Inovasi & Teknologi</h4>
                        <p class="value-desc">Menggunakan teknologi inovatif dalam pelayanan digital</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-item fade-in">
                        <div class="value-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h4 class="value-title">Inklusi Sosial</h4>
                        <p class="value-desc">Menyediakan akses yang setara untuk semua kalangan</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-item fade-in">
                        <div class="value-icon">
                            <i class="bi bi-tree"></i>
                        </div>
                        <h4 class="value-title">Lingkungan Hijau</h4>
                        <p class="value-desc">Menerapkan sistem ramah lingkungan dan energi bersih</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="value-item fade-in">
                        <div class="value-icon">
                            <i class="bi bi-globe"></i>
                        </div>
                        <h4 class="value-title">Komunitas Global</h4>
                        <p class="value-desc">Membangun hubungan kuat dengan masyarakat sekitar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CTA SECTION ===== --}}
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2 class="cta-title fade-in">
                        Siap Memulai Petualangan?
                    </h2>
                    <p class="cta-desc fade-in">
                        Bergabunglah dengan ribuan pengunjung yang telah merasakan pengalaman tak terlupakan di Giliranku.
                    </p>
                    
                    <div class="d-flex justify-content-center gap-3 flex-wrap fade-in">
                        <a href="{{ route('tickets') }}" class="btn-minimal btn-minimal-primary" wire:navigate>
                            Beli Tiket Sekarang
                        </a>
                        <a href="{{ route('attractions') }}" class="btn-minimal" wire:navigate>
                            Lihat Semua Wahana
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
