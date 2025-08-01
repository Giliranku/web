<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class StaffProfilePage extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $number;
    public $location;
    public $avatar;
    public $newAvatar;
    public $uploading = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'number' => 'nullable|string|max:24',
        'location' => 'nullable|string|max:255',
        'newAvatar' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $staff = Session::get('staff');
        if (!$staff) {
            return redirect('/admin/login');
        }

        $this->name = $staff->name;
        $this->email = $staff->email;
        $this->number = $staff->number ?? '';
        $this->location = $staff->location ?? '';
        $this->avatar = $staff->avatar ?? '';
    }

    public function updateField($field)
    {
        $this->validateOnly($field);
        
        $staff = Session::get('staff');
        
        $staff->update([
            $field => $this->$field
        ]);
        
        // Update session
        Session::put('staff', $staff->fresh());
        
        session()->flash('success', ucfirst($field) . ' berhasil diperbarui!');
    }

    public function updatedNewAvatar()
    {
        if ($this->newAvatar) {
            $this->updateAvatar();
        }
    }

    public function updateAvatar()
    {
        $this->uploading = true;
        
        try {
            $this->validate([
                'newAvatar' => 'required|image|max:2048'
            ]);

            $staff = Session::get('staff');

            // Delete old avatar if exists
            if ($staff->avatar && !str_contains($staff->avatar, 'http')) {
                Storage::disk('public')->delete($staff->avatar);
            }

            // Store new avatar
            $path = $this->newAvatar->store('avatars', 'public');
            
            $staff->update([
                'avatar' => $path
            ]);

            // Update session
            Session::put('staff', $staff->fresh());

            $this->avatar = $path;
            
            session()->flash('success', 'Foto profil berhasil diperbarui!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', 'File tidak valid: ' . $e->getMessage());
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengupload foto: ' . $e->getMessage());
        } finally {
            $this->uploading = false;
            $this->reset('newAvatar');
        }
    }

    public function render()
    {
        return view('livewire.pages.staff-profile-page')->layout('components.layouts.dashboard-admin');
    }
}
