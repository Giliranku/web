<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EditStaff extends Component
{
    use WithFileUploads;

    public Staff $staff;
    public $name, $email, $password, $password_confirmation, $number, $location, $role;
    public $new_avatar;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|min:8|confirmed',
        'number' => 'required|string|max:20',
        'location' => 'required|string',
        'role' => 'required|in:admin,staff,manager',
        'new_avatar' => 'nullable|image|max:1024'
    ];

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->name = $staff->name;
        $this->email = $staff->email;
        $this->number = $staff->number;
        $this->location = $staff->location;
        $this->role = $staff->role;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $this->staff->id,
            'password' => 'nullable|min:8|confirmed',
            'number' => 'required|string|max:20',
            'location' => 'required|string',
            'role' => 'required|in:admin,staff,manager',
            'new_avatar' => 'nullable|image|max:1024'
        ]);

        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'number' => $this->number,
            'location' => $this->location,
            'role' => $this->role,
        ];

        if ($this->password) {
            $updateData['password'] = Hash::make($this->password);
        }

        if ($this->new_avatar) {
            // Delete old avatar if exists
            if ($this->staff->avatar) {
                Storage::disk('public')->delete($this->staff->avatar);
            }
            $updateData['avatar'] = $this->new_avatar->store('staff/avatars', 'public');
        }

        $this->staff->update($updateData);

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.edit-staff')
            ->layout('components.layouts.dashboard-admin');
    }
}
