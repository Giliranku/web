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
                        <i class="fas fa-user-edit me-2"></i>Edit Staff
                    </span>
                </h5>
                <a href="{{ route('admin.staff.index') }}" class="btn-close"></a>
            </div>

            <!-- Form -->
            <form wire:submit="update" enctype="multipart/form-data">
                <div class="row mb-4">
                    <!-- Avatar Upload -->
                    <div class="col-md-4 text-center position-relative">
                        <label for="avatar">
                            <div class="border rounded-circle d-flex justify-content-center align-items-center mx-auto overflow-hidden"
                                style="width: 200px; height: 200px; cursor: pointer; background-color: #f9f9f9;">
                                @if ($new_avatar)
                                    <img src="{{ $new_avatar->temporaryUrl() }}" alt="Preview" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                @elseif($staff->avatar)
                                    <img src="{{ asset('storage/' . $staff->avatar) }}" alt="Current Avatar" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                @else
                                    <i class="fas fa-user fs-1 text-muted"></i>
                                @endif
                            </div>
                        </label>

                        <button type="button"
                            class="btn btn-light p-1 position-absolute"
                            style="bottom: -5px; right: 50px;"
                            onclick="document.getElementById('avatar').click()"
                            title="Ubah avatar">
                            <i class="fas fa-camera  fs-5"></i>
                        </button>

                        <input type="file" wire:model="new_avatar" class="d-none" id="avatar" accept="image/*">
                        @error('new_avatar')
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

                        <!-- Password (Optional for Edit) -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold">Password Baru (Opsional)</label>
                                <input wire:model="password" type="password" class="form-control" id="password" placeholder="Kosongkan jika tidak ingin mengubah">
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
                            <select wire:model.live="role" class="form-select" id="role">
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="staff_restaurant">Staff Restaurant</option>
                                <option value="staff_attraction">Staff Attraction</option>
                            </select>
                            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Current Assignments Display -->
                        @if($staff->attraction || $staff->restaurant)
                            <div class="mb-3">
                                <div class="alert alert-info">
                                    <h6 class="alert-heading"><i class="fas fa-info-circle me-1"></i>Penugasan Saat Ini:</h6>
                                    @if($staff->attraction)
                                        <p class="mb-0"><i class="fas fa-star me-1"></i>Mengelola Wahana: <strong>{{ $staff->attraction->name }}</strong></p>
                                    @endif
                                    @if($staff->restaurant)
                                        <p class="mb-0"><i class="fas fa-utensils me-1"></i>Mengelola Restoran: <strong>{{ $staff->restaurant->name }}</strong></p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Assignment Management -->
                        @if($role === 'staff_restaurant' || $role === 'staff_attraction')
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-tasks me-1"></i>
                                        Penugasan {{ $role === 'staff_restaurant' ? 'Restoran' : 'Wahana' }}
                                    </h6>
                                    <small class="text-muted">Satu staff hanya dapat mengelola satu {{ $role === 'staff_restaurant' ? 'restoran' : 'wahana' }}</small>
                                </div>
                                <div class="card-body">
                                    <!-- Assignment Selection -->
                                    <div class="mb-3">
                                        <label for="assignment_id" class="form-label fw-semibold">
                                            Pilih {{ $role === 'staff_restaurant' ? 'Restoran' : 'Wahana' }}
                                        </label>
                                        <select wire:model="assignment_id" class="form-select" id="assignment_id">
                                            <option value="">Tidak Ada Penugasan</option>
                                            @foreach($availableLocations as $location)
                                                <option value="{{ $location->id }}">
                                                    {{ $location->name }}
                                                    @if($location->staff_id && $location->staff_id !== $staff->id)
                                                        (Sudah dikelola)
                                                    @elseif($location->staff_id === $staff->id)
                                                        (Saat ini dikelola)
                                                    @else
                                                        (Tersedia)
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('assignment_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    @if($availableLocations->isEmpty())
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            Tidak ada {{ $role === 'staff_restaurant' ? 'restoran' : 'wahana' }} yang tersedia untuk penugasan.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Update Staff
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
