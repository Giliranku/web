@push('styles')
@vite([
    'resources/css/user-profile-page.css'
])
@endpush

<div>
    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Desktop View --}}
    <div class="d-none d-md-flex flex-column">
        <div class="justify-content-center d-flex">
            <div>
                <img src="{{ asset('img/bgmelar.png') }}" alt="" style="width: 100%">
            </div>
        </div>

        <div class="justify-content-center d-flex flex-row">
            <!-- SIDEBAR KIRI -->
            <div class="d-flex flex-row w-50 justify-content-center" style="margin-top: -9vw;">
                <div class="d-flex flex-column align-items-center w-75">
                    <!-- Foto Profile -->
                    <div class="d-flex position-relative mb-3 flex-row" style="margin-top: 1vw;">
                        @if($avatar)
                            @if(str_contains($avatar, 'http'))
                                <img src="{{ $avatar }}" class="rounded-circle border border-2 w-100" style="object-fit:cover;">
                            @else
                                <img src="{{ asset('storage/' . $avatar) }}" class="rounded-circle border border-2 w-100" style="object-fit:cover;">
                            @endif
                        @else
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center w-100 border border-2" style="aspect-ratio: 1/1;">
                                <i class="bi bi-person-fill text-white" style="font-size: 4vw;"></i>
                            </div>
                        @endif
                        
                        <!-- Tombol edit foto: ICON PENCIL -->
                        <button class="d-flex btn position-relative" type="button"
                            style="margin-top:60%; height: 4vw; width:4vw; align-items:center; justify-content:center; border-radius:100%; box-shadow:0 0 10px #bbb;"
                            data-bs-toggle="modal" data-bs-target="#editPhotoModal" aria-label="Edit Foto">
                            <i class="bi bi-pencil" style="font-size:2vw;"></i>
                        </button>
                    </div>
                    
                    <!-- Staff Info -->
                    <div class="text-center">
                        <h4>{{ $name }}</h4>
                        <p class="text-muted">{{ $email }}</p>
                        <span class="badge bg-success">Staff</span>
                    </div>
                </div>
            </div>

            <!-- BAGIAN PROFILE EDIT -->
            <div class="d-flex ms-5 flex-column w-100 mt-3">
                <!-- Field NAMA -->
                <div x-data="{ edit: false, value: @entangle('name'), temp: @entangle('name') }"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <h3 class="ms-2">Nama</h3>
                        <!-- Display -->
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' : 'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-5 field-display transition-all"
                            style="border-radius:2vw; font-family:'Georgia', serif; top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-text="value"></span>
                        <!-- Input -->
                        <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' : 'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-5 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444; font-family:'Georgia', serif; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-model="temp" 
                            @keydown.enter="value = temp; edit = false; $wire.updateField('name')"
                            @blur="value = temp; edit = false; $wire.updateField('name')" 
                            x-ref="input">
                    </div>
                    <!-- Tombol kanan -->
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:17vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button"
                            @click="if(!edit){ temp = value; edit = true; $nextTick(() => $refs.input.focus()); } else { value = temp; edit = false; $wire.updateField('name'); }"
                            style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                :style="edit ? 'font-size:2vw; transition:all 0.2s;' : 'font-size:2vw; transition:all 0.2s;'"></i>
                        </button>
                    </div>
                </div>
                @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
                <hr class="w-75">

                <!-- Field EMAIL -->
                <div x-data="{ edit: false, value: @entangle('email'), temp: @entangle('email') }"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <h3 class="ms-2">Email</h3>
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' : 'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-5 field-display transition-all"
                            style="border-radius:2vw; font-family:'Georgia', serif; top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-text="value"></span>
                        <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' : 'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-5 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444; font-family:'Georgia', serif; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-model="temp" 
                            @keydown.enter="value = temp; edit = false; $wire.updateField('email')"
                            @blur="value = temp; edit = false; $wire.updateField('email')" 
                            x-ref="input">
                    </div>
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:17vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button"
                            @click="if(!edit){ temp = value; edit = true; $nextTick(() => $refs.input.focus()); } else { value = temp; edit = false; $wire.updateField('email'); }"
                            style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                :style="edit ? 'font-size:2vw; transition:all 0.2s;' : 'font-size:2vw; transition:all 0.2s;'"></i>
                        </button>
                    </div>
                </div>
                @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                <hr class="w-75">

                <!-- Field TELEPON -->
                <div x-data="{ edit: false, value: @entangle('number'), temp: @entangle('number') }"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <h3 class="ms-2">Nomor Telepon</h3>
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' : 'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-5 field-display transition-all"
                            style="border-radius:2vw; top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-text="value || 'Tidak ada nomor'"></span>
                        <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' : 'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-5 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444; font-family:'Georgia', serif; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-model="temp" 
                            @keydown.enter="value = temp; edit = false; $wire.updateField('number')"
                            @blur="value = temp; edit = false; $wire.updateField('number')" 
                            x-ref="input">
                    </div>
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:17vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button"
                            @click="if(!edit){ temp = value; edit = true; $nextTick(() => $refs.input.focus()); } else { value = temp; edit = false; $wire.updateField('number'); }"
                            style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                :style="edit ? 'font-size:2vw; transition:all 0.2s;' : 'font-size:2vw; transition:all 0.2s;'"></i>
                        </button>
                    </div>
                </div>
                @error('number') <div class="alert alert-danger">{{ $message }}</div> @enderror
                <hr class="w-75">

                <!-- Field LOKASI -->
                <div x-data="{ edit: false, value: @entangle('location'), temp: @entangle('location') }"
                    class="ps-3 my-2 d-flex justify-content-between flex-row w-100 align-items-center position-relative"
                    style="min-height: 4.5rem;">
                    <div class="d-flex justify-content-start flex-column field-form-group" style="width:70%">
                        <h3 class="ms-2">Lokasi</h3>
                        <span :style="edit ? 'opacity:0; pointer-events:none; z-index:0; position:absolute;' : 'opacity:1; pointer-events:auto; z-index:2; position:relative;'"
                            class="ms-2 fs-5 field-display transition-all"
                            style="border-radius:2vw; font-family:'Georgia', serif; top:2.2rem; left:0; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-text="value || 'Tidak ada lokasi'"></span>
                        <input :style="edit ? 'opacity:1; pointer-events:auto; z-index:3; position:relative;' : 'opacity:0; pointer-events:none; z-index:0; position:absolute;'"
                            class="fs-5 ms-3 field-input transition-all"
                            style="border-radius:10px; padding:6px 20px; color:#444; font-family:'Georgia', serif; min-width:220px; top:2rem; left:0; background:#fff; transition:opacity 0.4s cubic-bezier(.45,0,.55,1);"
                            x-model="temp" 
                            @keydown.enter="value = temp; edit = false; $wire.updateField('location')"
                            @blur="value = temp; edit = false; $wire.updateField('location')" 
                            x-ref="input">
                    </div>
                    <div class="justify-content-center edit-field-btn"
                        style="width:5vw; margin-right:17vw; display:flex; align-items:center; justify-content:center; z-index:4;">
                        <button class="btn" type="button"
                            @click="if(!edit){ temp = value; edit = true; $nextTick(() => $refs.input.focus()); } else { value = temp; edit = false; $wire.updateField('location'); }"
                            style="background:none;">
                            <i class="bi" :class="edit ? 'bi-check-lg text-success' : 'bi-chevron-right'"
                                :style="edit ? 'font-size:2vw; transition:all 0.2s;' : 'font-size:2vw; transition:all 0.2s;'"></i>
                        </button>
                    </div>
                </div>
                @error('location') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    {{-- Mobile View --}}
    <div class="d-block d-md-none position-relative" style="overflow-x: hidden">
        <div class="position-absolute top-5 end-0 mt-2 me-4 " style="z-index: 2">
            <button class="d-flex btn justify-content-center align-items-center" type="button"
                style="height: 10vw; width: 10vw; border-radius:100%; box-shadow:0 0 10px #bbb;"
                data-bs-toggle="modal" data-bs-target="#editPhotoModal" aria-label="Edit Foto">
                <i class="bi bi-pencil  " style="font-size:5vw;"></i>
            </button>
        </div>

        <div class="justify-content-center d-flex position-absolute" style="min-height: 30vh;max-height:75vh; z-index: -1;">
            <div>
                <img src="{{ asset('img/bgmelar.png') }}" alt="bg image" style="height:100%;width: 100%">
            </div>
        </div>

        <div class="justify-content-center d-flex flex-column position-relative mt-5">
            <div class="d-flex flex-row justify-content-center">
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
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center w-100 border border-2" style="aspect-ratio: 1/1;">
                                <i class="bi bi-person-fill text-white" style="font-size: 10vw;"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Mobile Field Edits -->
            <div class="d-flex ms-4 flex-column w-100 mt-3">
                <!-- Similar mobile fields as desktop but with mobile styling -->
                <!-- You can expand these fields as needed -->
            </div>
        </div>
    </div>

    <!-- Edit Photo Modal -->
    <div class="modal fade" id="editPhotoModal" tabindex="-1" aria-labelledby="editPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 1rem;">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPhotoModalLabel">
                        <i class="bi bi-camera me-2"></i>Edit Foto Profil Staff
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-3">
                        @if($avatar)
                            @if(str_contains($avatar, 'http'))
                                <img src="{{ $avatar }}" alt="Foto Saat Ini" class="rounded-circle mb-3 border" style="width: 120px; height:120px; object-fit:cover;">
                            @else
                                <img src="{{ asset('storage/' . $avatar) }}" alt="Foto Saat Ini" class="rounded-circle mb-3 border" style="width: 120px; height:120px; object-fit:cover;">
                            @endif
                        @else
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 border" style="width: 120px; height: 120px;">
                                <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="file" class="form-control" wire:model="newAvatar" accept="image/*">
                    </div>
                    @error('newAvatar') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    <small class="text-muted">Format JPG, PNG. Max 2MB.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" wire:click="updateAvatar" data-bs-dismiss="modal">Simpan Foto</button>
                </div>
            </div>
        </div>
    </div>
</div>
