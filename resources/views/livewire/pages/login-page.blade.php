@push('styles')
@vite([
    'resources/css/login-page.css',
    'resources/css/register-page.css',
    // 'public/js/userprofile.js'
])
@endpush
<div class="awal">
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="d-none d-md-flex flex-row p-3" style="height: 100%;">
        <div class="position-relative w-100">
            <div class="d-flex justify-content-center" style="height: 120vh;">
                <div class="ikutSini position-relative">
                    <img class="gambar-login object-fit-fill" src="{{ asset('img/gambar_hebat.png') }}"
                        alt="Gambar-restoran">
                    <a href="/" wire:navigate>
                        <div class="position-absolute" style="top: 20px; left:20px">
                            <img src="{{ asset('img/logo-giliranku.png') }}" alt="Logo Giliranku">
                        </div>
                    </a>
                    <div class="position-absolute" id="geser">
                        <a href="/login" class="btn button-color-custom text-light">Masuk</a>
                        <a href="/register" class="btn btn-outline-light me-2">Bergabung</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="ps-3 pe-3 w-100 d-flex flex-column justify-content-center gap-5">
            <div class="d-flex align-items-center justify-content-center mb-5">
                <img src="{{ asset('img/ancol-logo.png') }}" alt="Logo Ancol">
            </div>
            <form wire:submit.prevent="login" class="d-flex flex-column align-items-center gap-4 w-100">

                {{-- Alert Error jika gagal login --}}
                @if ($error)
                    <div class="alert alert-danger w-50 text-center">
                        {{ $error }}
                    </div>
                @endif


                {{-- Bagian Input --}}
                <div class="mb-2 w-50">
                    <input type="email" class="form-control" wire:model="email" placeholder="Email">
                </div>

                @error('email')
                    <div class="alert alert-danger mt-2 w-50 text-center" style="font-size: 0.9rem;">
                        Tolong masukkan email yang sesuai atau valid.
                    </div>
                @enderror


                <div class="form-group mb-2 w-50 position-relative">
                    <input type="password" id="inputPassword" class="form-control pe-5" {{-- pe-5 agar tidak tertutup
                        icon --}} wire:model="password" placeholder="Password">

                    {{-- Ikon Mata --}}
                    <i class="bi bi-eye-slash" id="togglePassword" onclick="
            const input = document.getElementById('inputPassword');
            const icon = this;
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        " style="
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #6c757d;
        ">
                    </i>
                </div>


                <div class="mb-3 w-50 text-end">
                    <a href="#" class="text-danger small text-secondary">Lupa password?</a>
                </div>

                {{-- Tombol Masuk dengan Google (bukan submit) --}}
                <div class="d-grid gap-2 col-12 d-flex justify-content-center">
                    <button type="button" id="atur_wrapping" class="btn border border-dark w-50">
                        Masuk Dengan Google
                        <img class="ms-2" src="{{ asset('img/Google-G-logo.png') }}" style="width:18px;"
                            alt="Logo Google">
                    </button>
                </div>

                {{-- Tombol Submit --}}
                <div class="d-grid gap-2 col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-secondary w-50 rounded-pill fs-5 button-styling text-light">
                        Masuk
                    </button>
                </div>

                {{-- Link Daftar --}}
                <div class="text-center d-flex flex-row justify-content-center mb-3 gap-2">
                    <p class="mb-0 fs-6">Belum ada akun?</p>
                    <a href="#" class="text-secondary fs-6 fw-semibold">Daftar Sekarang!</a>
                </div>



            </form>



            <div class="d-flex flex-row align-items-center justify-content-center gap-2">
                <i class="bi bi-linkedin" style="font-size: 1.8rem;"></i>
                <i class="bi bi-twitter-x" style="font-size: 1.8rem;"></i>
                <i class="bi bi-facebook" style="font-size: 1.8rem;"></i>
                <i class="bi bi-instagram" style="font-size: 1.8rem;"></i>
            </div>
        </div>
    </div>


    {{-- MOBILE ONLY (xs, sm) --}}
    <div class="d-block d-md-none bg-dark">
        <div class="container-fluid px-0" style="position: relative">
            <div class="ms-3 mt-3" style="position: absolute; z-index:2;">
                <img src="{{ asset('/img/logo-giliranku.png') }}" alt="Logo" style="max-width: 7vw;">
            </div>
            <div class="w-100 " style="position: relative; z-index:1;">
                <div class="d-flex justify-content-center"
                    style=" position: relative;z-index: 1;overflow: hidden; height:50vw; width: 100%">
                    <img src="{{ asset('img/imagehape.png') }}" alt="ImageCover"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
            {{-- card --}}
            <div class="bg-light px-3 pt-3 pb-4"
                style="border-radius: 32px 32px 0 0; margin-top: -30px;position: relative; z-index:2;">
                <div class="d-flex flex-column align-items-center">

                    <img src="{{ asset('img/ancol-logo.png') }}" alt="Logo Ancol" style="height:48px;">

                    <div class="d-flex w-100 justify-content-center my-5 ">
                        <a href="/login" class="btn border border-end border-dark"
                            style="background:#60C1AA; color:#fff; min-width:110px; border-radius:10px 0 0 10px; display:inline-block; text-align:center; line-height:38px; text-decoration:none;">
                            Masuk
                        </a>
                        <a href="/register" class="btn btn-outline-light"
                            style="background:#eee; color:#222; min-width:110px; border-radius:0 10px 10px 0; border:1px solid #ccc; display:inline-block; text-align:center; line-height:38px; text-decoration:none;">
                            Bergabung
                        </a>

                    </div>


                    <form wire:submit.prevent="login" class="w-100">

                        <div class="mb-3">
                            <input type="email" class="form-control rounded-pill px-4 py-2" placeholder="Email"
                                style="font-size:1rem; min-width: 2vw;">
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" id="inputPasswordMobile"
                                class="form-control rounded-pill px-4 py-2 pe-5" placeholder="Password"
                                style="font-size:1rem;">

                            <i class="bi bi-eye-slash" onclick="
            const input = document.getElementById('inputPasswordMobile');
            const icon = this;
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        " style="
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        ">
                            </i>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="#" class="text-danger small text-secondary">Lupa password?</a>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn w-100 rounded-pill border border-dark py-2"
                                style="font-size: 1.1rem;">
                                Masuk dengan Google
                                <img class="ms-2" src="{{ asset('img/Google-G-logo.png') }}" style="width:18px;"
                                    alt="Logo Google">
                            </button>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn w-100 rounded-pill fs-5"
                                style="background:#FF4E1B; color:#fff; font-weight:600; padding: 12px 0;">Masuk</button>
                        </div>
                        <div class="text-center mb-3">
                            <span>Belum ada akun? <a href="#" class="text-danger fw-bold">Daftar
                                    sekarang!</a></span>
                        </div>
                    </form>

                    <div class="d-flex flex-row align-items-center justify-content-center gap-3 mt-2 mb-1">
                        <i class="bi bi-linkedin" style="font-size: 1.4rem;"></i>
                        <i class="bi bi-twitter-x" style="font-size: 1.4rem;"></i>
                        <i class="bi bi-facebook" style="font-size: 1.4rem;"></i>
                        <i class="bi bi-instagram" style="font-size: 1.4rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>