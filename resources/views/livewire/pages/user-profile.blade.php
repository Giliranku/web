@push('styles')
@vite([
    'resources/css/user-profile-page.css'
    // 'public/js/userprofile.js'
])
@endpush
<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="d-none d-md-flex flex-column">
        <div class="justify-content-center d-flex">
            <div>
                <img src="{{ asset('img/bgmelar.png') }}" alt="" style="width: 100%">
            </div>
        </div>

        <div class="justify-content-center d-flex flex-row">
            <!-- SIDEBAR KIRI -->
            <div class="d-flex flex-row w-50 justify-content-center" style="margin-top: -9vw;">
                                <!-- SIDEBAR KIRI -->
                <div class="d-flex flex-column align-items-center w-50">
                    <!-- Foto Profile -->
                    <div class="d-flex position-relative mb-3 flex-row" style="margin-top: 1vw; margin-left: 2vw;">
                        @if($avatar)
                            @if(str_contains($avatar, 'http'))
                                <img src="{{ $avatar }}" class="rounded-circle border border-2 w-100" style="object-fit:cover;">
                            @else
                                <img src="{{ asset('storage/' . $avatar) }}" class="rounded-circle border border-2 w-100" style="object-fit:cover;">
                            @endif
                        @else
                            <div class="rounded-circle d-flex align-items-center justify-content-center w-100 border border-2" style="aspect-ratio: 1/1;">
                                <i class="bi bi-person-fill text-muted" style="font-size: 4vw;"></i>
                            </div>
                        @endif
                        <!-- Tombol edit foto: ICON PENCIL -->
            <button class="d-flex btn position-absolute" type="button"
                style="margin-left: 14vw; margin-top:5vw; height: 5vw; width: 5vw; align-items:center; justify-content:center; border-radius:100%; box-shadow:0 0 10px #bbb;"
                onclick="document.getElementById('avatarInputMobile').click()" aria-label="Edit Foto">

                <i class="bi bi-pencil" style="font-size:3vw;"></i>
            </button>
            
            <!-- Hidden file input for mobile -->
            <input type="file" id="avatarInputMobile" wire:model="newAvatar" accept="image/*" style="display: none;">
            
            <!-- Loading spinner for avatar upload (mobile) -->
            @if($uploading)
                <div class="position-absolute d-flex align-items-center justify-content-center" 
                     style="top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.8); border-radius: 50%;">
                    <span class="spinner-border text-primary" role="status"></span>
                </div>
            @endif
                    </div>
                    <!-- SIDEBAR Profil Aktivitas -->
                    <div class="w-100 d-flex flex-column align-items-center">
                        <div class="accordion w-100" id="profileAccordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button border border-dark rounded"
                                        style="background:#f9d778; color:#444;" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-activity" aria-expanded="true">
                                        Aktivitas Anda
                                    </button>
                                </h2>
                                <div id="flush-activity" class="accordion-collapse collapse show">
                                    <div class="accordion-body p-0 ">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item rounded-bottom-3 shadow "
                                                style="background: #ffe8ad;">
                                                <a href="#"
                                                    class="text-decoration-none  d-flex justify-content-between align-items-center">
                                                    Wahana
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </li>
                                            <li class="list-group-item" style="background: #ffe8ad;">
                                                <a href="#"
                                                    class="text-decoration-none  d-flex justify-content-between align-items-center">
                                                    Restoran
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </li>
                                            <li class="list-group-item" style="background: #ffe8ad;">
                                                <a href="#"
                                                    class="text-decoration-none  d-flex justify-content-between align-items-center">
                                                    Aksesibilitas
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BAGIAN PROFILE EDIT -->
            <div class="d-flex ms-5 flex-column w-100 mt-3">
                <!-- Field Email -->
                <div x-data="{ edit: false }" x-init="$watch('edit', value => {
                        if(value) $nextTick(() => $refs.input.focus())
                    })"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <h3 class="ms-2">Nama</h3>

                        <!-- Display -->
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                    'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-5 field-display transition-all"
                            style="border-radius:2vw; font-family:'Georgia', serif; top:2.2rem; left:0; transition:opacity 0.4s;"
                            x-text="$wire.name"></span>

                        <!-- Input -->
                        <input type="text" x-ref="input" wire:model.defer="name" :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                    'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-5 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444; font-family:'Georgia', serif; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s;"
                            @keydown.enter="$wire.updateProfile(); edit = false"
                            @blur="$wire.updateProfile(); edit = false">
                    </div>

                    <!-- Tombol kanan -->
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:17vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button" @click="edit = !edit" style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                style="font-size:2vw; transition:all 0.2s;"></i>
                        </button>
                    </div>
                </div>

                <hr class="w-75">

                <!-- Field EMAIL -->
                <div x-data="{ edit: false }" x-init="$watch('edit', value => {
                        if(value) $nextTick(() => $refs.input.focus())
                    })"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <h3 class="ms-2">Email</h3>

                        <!-- Display -->
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                    'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-5 field-display transition-all"
                            style="border-radius:2vw; font-family:'Georgia', serif; top:2.2rem; left:0; transition:opacity 0.4s;"
                            x-text="$wire.email"></span>

                        <!-- Input -->
                        <input type="text" x-ref="input" wire:model.defer="email" :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                    'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-5 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444; font-family:'Georgia', serif; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s;"
                            @keydown.enter="$wire.updateProfile(); edit = false"
                            @blur="$wire.updateProfile(); edit = false">
                    </div>

                    <!-- Tombol kanan -->
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:17vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button" @click="edit = !edit" style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                style="font-size:2vw; transition:all 0.2s;"></i>
                        </button>
                    </div>
                </div>

                <hr class="w-75">

                <!-- Field TELEPON -->
                <div x-data="{ edit: false }" x-init="$watch('edit', value => {
                                        if(value) $nextTick(() => $refs.input.focus())
                                    })"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <h3 class="ms-2">No. Telepon</h3>

                        <!-- Display -->
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                                    'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-5 field-display transition-all"
                            style="border-radius:2vw; font-family:'Georgia', serif; top:2.2rem; left:0; transition:opacity 0.4s;"
                            x-text="$wire.number"></span>

                        <!-- Input -->
                        <input type="text" x-ref="input" wire:model.defer="number" :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                                    'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-5 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444; font-family:'Georgia', serif; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s;"
                            @keydown.enter="$wire.updateProfile(); edit = false"
                            @blur="$wire.updateProfile(); edit = false">
                    </div>

                    <!-- Tombol kanan -->
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:17vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button" @click="edit = !edit" style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                style="font-size:2vw; transition:all 0.2s;"></i>
                        </button>
                    </div>
                </div>
                <hr class="w-75">

                <!-- Field LOKASI -->
                <div x-data="{ edit: false }" x-init="$watch('edit', value => {
                                        if(value) $nextTick(() => $refs.input.focus())
                                    })"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <h3 class="ms-2">Lokasi</h3>

                        <!-- Display -->
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                                    'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-5 field-display transition-all"
                            style="border-radius:2vw; font-family:'Georgia', serif; top:2.2rem; left:0; transition:opacity 0.4s;"
                            x-text="$wire.location"></span>

                        <!-- Input -->
                        <input type="text" x-ref="input" wire:model.defer="location" :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                                    'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-5 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444; font-family:'Georgia', serif; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s;"
                            @keydown.enter="$wire.updateProfile(); edit = false"
                            @blur="$wire.updateProfile(); edit = false">
                    </div>

                    <!-- Tombol kanan -->
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:17vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button" @click="edit = !edit" style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                style="font-size:2vw; transition:all 0.2s;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile --}}
    <div class="d-block d-md-none position-relative" style="overflow-x: hidden">

        <div class="position-absolute top-5 end-0 mt-2 me-4 " style="z-index: 2">
            <button class="d-flex btn justify-content-center align-items-center" type="button"
                style="  height: 10vw; width: 10vw;  border-radius:100%; box-shadow:0 0 10px #bbb;"
                onclick="document.getElementById('avatarInputMobile').click()" aria-label="Edit Foto">

                <i class="bi bi-pencil  " style="font-size:5vw;"></i>
            </button>
        </div>

        <div class="justify-content-center d-flex position-absolute"
            style="min-height: 30vh;max-height:75vh; z-index: -1;">
            <div>
                <img src="{{ asset('img/bgmelar.png') }}" alt="bg image" style="height:100%;width: 100%">
            </div>
        </div>

        <div class="justify-content-center d-flex flex-column position-relative">
            <!-- SIDEBAR KIRI -->


            <div class="d-flex flex-row justify-content-center" style="">
                <div class="d-flex flex-column align-items-center w-50">
                    <!-- Foto Profile -->
                    <div class="d-flex position-relative mb-3 flex-row" style="margin-top: 1vw; margin-left: 2vw;">
                        @if($avatar)
                            @if(str_contains($avatar, 'http'))
                                <img src="{{ $avatar }}" class="rounded-circle border border-2 w-100" style="object-fit:cover;">
                            @else
                                <img src="{{ asset('storage/' . $avatar) }}" class="rounded-circle border border-2 w-100" style="object-fit:cover;">
                            @endif
                        @else
                            <div class="rounded-circle d-flex align-items-center justify-content-center w-100 border border-2" style="aspect-ratio: 1/1;">
                                <i class="bi bi-person-fill text-muted" style="font-size: 10vw;"></i>
                            </div>
                        @endif
                        
                        <!-- Loading spinner for avatar upload (mobile) -->
                        @if($uploading)
                            <div class="position-absolute d-flex align-items-center justify-content-center" 
                                 style="top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.8); border-radius: 50%;">
                                <span class="spinner-border text-primary" role="status"></span>
                            </div>
                        @endif
                    </div>

                    <!-- SIDEBAR Profil Aktivitas -->
                    <div class="w-100 d-flex flex-column align-items-center">
                        <div class="accordion w-100" id="profileAccordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button border border-dark rounded"
                                        style="background:#f9d778; color:#444;" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-activity" aria-expanded="true">
                                        Aktivitas Anda
                                    </button>
                                </h2>
                                <div id="flush-activity" class="accordion-collapse collapse show">
                                    <div class="accordion-body p-0 ">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item rounded-bottom-3 shadow "
                                                style="background: #ffe8ad;">
                                                <a href="#"
                                                    class="text-decoration-none  d-flex justify-content-between align-items-center">
                                                    Wahana
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </li>
                                            <li class="list-group-item" style="background: #ffe8ad;">
                                                <a href="#"
                                                    class="text-decoration-none  d-flex justify-content-between align-items-center">
                                                    Restoran
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </li>
                                            <li class="list-group-item" style="background: #ffe8ad;">
                                                <a href="#"
                                                    class="text-decoration-none  d-flex justify-content-between align-items-center">
                                                    Aksesibilitas
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BAGIAN PROFILE EDIT -->
            <div class="d-flex ms-5 flex-column w-100 mt-3 ">
                <!-- Field NAMA -->
                <div x-data="{ edit: false, value: 'Riyadth Bierskert', temp: 'Riyadth Bierskert' }"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <span class="ms-2 fs-6 fw-bold">Nama</span>
                        <!-- Display -->
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-6 field-display transition-all"
                            style="border-radius:2vw;  top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-text="value"></span>
                        <!-- Input -->
                        <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-6 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444;  min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-model="temp" @keydown.enter="value = temp; edit = false"
                            @blur="value = temp; edit = false" x-ref="input">
                    </div>
                    <!-- Tombol kanan -->
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:25vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button" @click="
                            if(!edit){
                                temp = value;
                                edit = true;
                                $nextTick(() => $refs.input.focus());
                            } else {
                                value = temp;
                                edit = false;
                            }
                        " style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                :style="edit ? 'font-size:5vw; transition:all 0.2s;' : 'font-size:5vw; transition:all 0.2s;'"></i>
                        </button>
                    </div>
                </div>
                <hr class="w-75">

                <!-- Field EMAIL -->
                <div x-data="{ edit: false, value: 'riyadthbierskert@gmail.com', temp: 'riyadthbierskert@gmail.com' }"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:50%;">
                        <span class="ms-2 fs-6 fw-bold">Email</span>
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                'opacity:1; pointer-events:auto; z-index:2; position:relative;word-break:break-all;'"
                            class="ms-2 fs-6 field-display transition-all"
                            style="border-radius:2vw;  top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-text="value"></span>
                        <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-6 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-model="temp" @keydown.enter="value = temp; edit = false"
                            @blur="value = temp; edit = false" x-ref="input">
                    </div>
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:25vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button" @click="
                            if(!edit){
                                temp = value;
                                edit = true;
                                $nextTick(() => $refs.input.focus());
                            } else {
                                value = temp;
                                edit = false;
                            }
                        " style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                :style="edit ? 'font-size:5vw; transition:all 0.2s;' : 'font-size:5vw; transition:all 0.2s;'"></i>
                        </button>
                    </div>
                </div>
                <hr class="w-75">

                <!-- Field TELEPON -->
                <div x-data="{ edit: false, value: '+086 - 7819381', temp: '+086 - 7819381' }"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <span class="ms-2 fs-6 fw-bold">Nomor Telepon</span>
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-6 field-display transition-all"
                            style="border-radius:2vw; top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-text="value"></span>
                        <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-6 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-model="temp" @keydown.enter="value = temp; edit = false"
                            @blur="value = temp; edit = false" x-ref="input">
                    </div>
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:25vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button" @click="
                            if(!edit){
                                temp = value;
                                edit = true;
                                $nextTick(() => $refs.input.focus());
                            } else {
                                value = temp;
                                edit = false;
                            }
                        " style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                :style="edit ? 'font-size:5vw; transition:all 0.2s;' : 'font-size:5vw; transition:all 0.2s;'"></i>
                        </button>
                    </div>
                </div>
                <hr class="w-75">

                <!-- Field LOKASI -->
                <div x-data="{ edit: false, value: 'Respsijg, India', temp: 'Respsijg, India' }"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <span class="ms-2 fs-6 fw-bold">Lokasi</span>
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' :
                                'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-6 field-display transition-all"
                            style="border-radius:2vw;  top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-text="value"></span>
                        <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' :
                                'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-6 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444;  min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-model="temp" @keydown.enter="value = temp; edit = false"
                            @blur="value = temp; edit = false" x-ref="input">
                    </div>
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:25vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button" @click="
                            if(!edit){
                                temp = value;
                                edit = true;
                                $nextTick(() => $refs.input.focus());
                            } else {
                                value = temp;
                                edit = false;
                            }
                        " style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                :style="edit ? ' font-size:5vw; transition:all 0.2s;' : ' font-size:5vw; transition:all 0.2s;'"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>