@push('styles')
    @vite([
        'resources/css/jesselyn.css',
        'resources/css/sorting.css',
    ])
@endpush

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-100 h-100" style="max-width: 1400px;">
        <div class="modal-content p-4 shadow rounded">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">
                    <span class="border-start border-warning border-4 ps-2">
                        <i class="fas fa-user-plus me-2"></i>Tambah Staff
                    </span>
                </h5>
                <a href="{{ route('admin.staff.index') }}" class="btn-close"></a>
            </div>

            <!-- Form -->
            <form wire:submit="save" enctype="multipart/form-data">
                <div class="row mb-4">
                    <!-- Avatar Upload -->
                    <div class="col-md-4 text-center position-relative">
                        <label for="avatar">
                            <div class="border rounded-circle d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                                style="width: 200px; height: 200px; cursor: pointer; background-color: #f9f9f9;">
                                @if ($avatar)
                                    <img src="{{ $avatar->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                @else
                                    <i class="fas fa-user fs-1 text-muted"></i>
                                @endif
                            </div>
                        </label>

                        <button type="button"
                            class="btn btn-light p-1 position-absolute"
                            style="bottom: -5px; right: 50px;"
                            onclick="document.getElementById('avatar').click()"
                            title="Unggah avatar">
                            <i class="fas fa-camera text-dark fs-5"></i>
                        </button>

                        <input type="file" wire:model="avatar" class="d-none" id="avatar" accept="image/*">
                        @error('avatar')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror

                        <p class="text-muted small mt-2">
                            Avatar staff (opsional). Format PNG, JPG. Max size 1 MB.
                        </p>
                    </div>

                    <!-- Form fields -->
                    <div class="col-md-8">
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Nama Lengkap">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input wire:model="email" type="email" class="form-control" id="email" placeholder="email@example.com">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input wire:model="password" type="password" class="form-control" id="password" placeholder="Password">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                                <input wire:model="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password">
                            </div>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="mb-3">
                            <label for="number" class="form-label fw-semibold">Nomor Telepon</label>
                            <input wire:model="number" type="text" class="form-control" id="number" placeholder="+62 812 3456 7890">
                            @error('number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-3">
                            <label for="location" class="form-label fw-semibold">Lokasi Kerja</label>
                            <select wire:model="location" class="form-select" id="location">
                                <option value="">Pilih Lokasi</option>
                                <option value="Ancol">Ancol</option>
                                <option value="Dufan Ancol">Dufan Ancol</option>
                                <option value="Sea World Ancol">Sea World Ancol</option>
                                <option value="Atlantis Ancol">Atlantis Ancol</option>
                                <option value="Samudra Ancol">Samudra Ancol</option>
                                <option value="Putri Duyung Ancol">Putri Duyung Ancol</option>
                                <option value="Jakarta Bird Land Ancol">Jakarta Bird Land Ancol</option>
                            </select>
                            @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label for="role" class="form-label fw-semibold">Role</label>
                            <select wire:model="role" class="form-select" id="role">
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="staff">Staff</option>
                            </select>
                            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Simpan Staff
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
