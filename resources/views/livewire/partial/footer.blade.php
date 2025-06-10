<div>
    {{-- Make a 3 column footer using bootstrap --}}
    <div class="container-fluid p-5 vw-100">
        <footer>
            <div class="row">
                <div class="col-12 col-md-4 mb-3 mb-md-0 d-flex flex-row align-items-center justify-content-start gap-3">
                    {{-- Use asset helper to load the image --}}
                    <img src="{{ asset('img/logo-giliranku.png') }}" alt="Logo Giliranku" class="img-fluid mb-2 logo-footer">
                    <h3>Giliranku</h3>
                </div>
                <div class="col-12 col-md-6 mb-3 mb-md-0 d-flex flex-column">
                    <h5 class="fw-bold">CONTACT US</h5>
                    <ul class="list-unstyled">
                        <li><p class="m-0">Jalan Sudirman Anggrek, Jakarta, Indonesia</p></li>
                        <li><p class="m-0">+62 812-3478-2315</p></li>
                        <li><p class="m-0">support@giliranku.com</p></li>
                    </ul>
                </div>
                <div class="col-12 col-md-2 d-flex flex-column">
                    <h5 class="fw-bold">FOLLOW US</h5>
                    <div class="d-flex flex-row social-icons-card gap-4">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-linkedin"></i>
                        <i class="bi bi-facebook"></i>
                    </div>
                </div>
            </div>
        </footer>
        <hr>
        <div class="text-center text-muted">
            <p>© 2025 Giliranku. All Rights Reserved</p>
        </div>
    </div>
</div>