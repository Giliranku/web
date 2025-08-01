<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AddStaff extends Component
{
    use WithFileUploads;

    public $name, $email, $password, $password_confirmation, $number, $location, $role, $avatar;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:staff,email',
        'password' => 'required|min:8|confirmed',
        'number' => 'required|string|max:20',
        'location' => 'required|string',
        'role' => 'required|in:admin,staff_restaurant,staff_attraction',
        'avatar' => 'nullable|image|max:1024'
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        'number.required' => 'Nomor telepon wajib diisi.',
        'location.required' => 'Lokasi wajib diisi.',
        'role.required' => 'Role wajib dipilih.',
        'avatar.image' => 'Avatar harus berupa gambar.',
        'avatar.max' => 'Ukuran avatar maksimal 1MB.',
    ];

    public function save()
    {
        $this->validate();

        $avatarPath = null;
        if ($this->avatar) {
            $avatarPath = $this->avatar->store('staff/avatars', 'public');
        }

        Staff::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'number' => $this->number,
            'location' => $this->location,
            'role' => $this->role,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.admin.add-staff')
            ->layout('components.layouts.dashboard-admin');
    }
}
