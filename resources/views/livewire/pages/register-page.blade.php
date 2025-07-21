@push('styles')
@vite([
    'resources/css/login-page.css',
    'resources/css/register-page.css',
    // 'public/js/userprofile.js'
])
@endpush
<div class="awalregister">
    {{-- The whole world belongs to you. --}}
    <div class="d-none d-md-flex flex-row p-3">
        <div class="position-relative w-100">
            <div class="d-flex justify-content-center" style="height: 120vh;">
                <div class="ikutSini position-relative">
                    <img class="gambar-login object-fit-fill" src="{{ asset('img/gambar_hebat.png') }}"
                        alt="Gambar-restoran">
                    <div class="position-absolute top-0 start-0" style="margin-top: 30px; margin-left: 60px">
                        <img src="{{ asset('img/logo-giliranku.png') }}" alt="Logo Giliranku">
                    </div>
                    <div class="position-absolute" id="geserregister">
                        <a href="/login" class="btn btn-outline-light me-2">Masuk</a>
                        <a href="/register" class="btn button-color-custom text-light">Bergabung</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="ps-3 pe-3 w-100 d-flex flex-column justify-content-center gap-4" style="margin-top: -31vh">
            <div class="d-flex align-items-center justify-content-center mb-5">
                <img src="{{ asset('img/ancol-logo.png') }}" alt="Logo Ancol">
            </div>
            <form wire:submit="register" class="justify-content-center align-items-center d-flex flex-column">
                <div class="mb-3 w-50 h-100">
                    <input type="text" class="form-control" wire:model="name" placeholder="Username">
                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3 w-50 h-100">
                    <input type="email" class="form-control" wire:model="email" placeholder="Email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3 w-50 h-100">
                    <input type="tel" wire:model="number" class="form-control" placeholder="Nomor HP">
                    @error('number') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="form-group mb-3 w-50 position-relative">
                    <input type="password" id="registerPassword" class="form-control pe-5" wire:model="password"
                        placeholder="Password">


                    <i class="bi bi-eye-slash" id="toggleRegisterPassword" onclick="
        const input = document.getElementById('registerPassword');
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


                <div class="d-flex flex-column gap-3 mt-4">
                    <div class="d-grid gap-5 align-items-center d-flex flex-column justify-content-center">

                        <div class="d-grid gap-2 col-12 d-flex justify-content-center">
                            <button type="submit"
                                class="btn btn-secondary w-75 rounded-pill fs-5 button-styling text-light">
                                Daftar
                            </button>

                        </div>

                    </div>
                    <div class="mb-3 text-center d-flex flex-row justify-content-center">
                        <p class="text-start fs-6">Sudah Punya Akun?</p>
                        <a href="#" class="text-end text-secondary fs-6 ">Daftar Sekarang!</a>
                    </div>
                </div>
            </form>



            <div class="d-flex flex-row align-items-center justify-content-center gap-3 mt-0 mb-1">
                <i class="bi bi-linkedin" style="font-size: 1.4rem;"></i>
                <i class="bi bi-twitter-x" style="font-size: 1.4rem;"></i>
                <i class="bi bi-facebook" style="font-size: 1.4rem;"></i>
                <i class="bi bi-instagram" style="font-size: 1.4rem;"></i>
            </div>
        </div>
    </div>

    {{-- mobile --}}
    <div class="d-block d-md-none bg-dark">
        <div class="container-fluid px-0" style="position: relative">
            <div class="ms-3 mt-3" style="position: absolute; z-index:2;">
                <a href="/" wire:navigate>
                    <img src="{{ asset('/img/logo-giliranku.png') }}" alt="Logo" style="max-width: 7vw;">
                </a>
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
                        <a href="/login" class="btn btn-outline-light" wire:navigate
                            style="background:#eee; color:#222; min-width:110px; border-radius: 10px 0 0 10px  ; border:1px solid #ccc; display:inline-block; text-align:center; line-height:38px; text-decoration:none;">
                            Masuk
                        </a>
                        <a href="/register" class="btn border border-end border-dark" wire:navigate
                            style="background:#ffee00; color:#000000; min-width:110px; border-radius:  0  10px 10px 0  ; display:inline-block; text-align:center; line-height:38px; text-decoration:none;">
                            Bergabung
                        </a>


                    </div>

                    <form wire:submit="register" class="w-100">
                        <div class="mb-3">
                            <input type="text" wire:model="username" class="form-control rounded-pill px-4 py-2"
                                placeholder="Username">
                            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <input type="email" wire:model="email" class="form-control rounded-pill px-4 py-2"
                                placeholder="Email Baru">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" wire:model="password" class="form-control rounded-pill px-4 py-2"
                                placeholder="Password">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn w-100 rounded-pill fs-5"
                                style="background:#FF4E1B; color:#fff; font-weight:600; padding: 12px 0;">Daftar</button>
                        </div>
                    </form>


                    <div class="d-flex flex-row align-items-center justify-content-center gap-3 mt-2 ">
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