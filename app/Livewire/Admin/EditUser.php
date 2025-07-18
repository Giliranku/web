<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditUser extends Component
{
    use WithFileUploads;

    public User $user;
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

    // Remove the automatic updatedNewAvatar method to prevent infinite loading
    // public function updatedNewAvatar() { ... }

    public function updatedNewAvatar()
    {
        // Auto upload when file is selected
        if ($this->newAvatar) {
            $this->updateAvatar();
        }
    }

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->number = $this->user->number;
        $this->location = $this->user->location;
        $this->avatar = $this->user->avatar;
    }

    public function updateField($field)
    {
        $this->validateOnly($field);
        
        $this->user->update([
            $field => $this->$field
        ]);
        
        session()->flash('success', ucfirst($field) . ' berhasil diperbarui!');
    }

    public function updateAvatar()
    {
        $this->uploading = true;
        
        try {
            $this->validate([
                'newAvatar' => 'required|image|max:2048'
            ]);

            // Delete old avatar if exists and not from Google
            if ($this->user->avatar && !str_contains($this->user->avatar, 'googleusercontent.com') && !str_contains($this->user->avatar, 'http')) {
                Storage::disk('public')->delete($this->user->avatar);
            }

            // Store new avatar
            $path = $this->newAvatar->store('avatars', 'public');
            
            $this->user->update([
                'avatar' => $path
            ]);

            $this->avatar = $path;
            
            session()->flash('success', 'Foto profil berhasil diperbarui!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', 'File tidak valid: ' . $e->getMessage());
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengupload foto: ' . $e->getMessage());
        } finally {
            // Reset states
            $this->uploading = false;
            $this->reset('newAvatar');
        }
    }

    public function render()
    {
        return view('livewire.admin.edit-user')
            ->layout('components.layouts.dashboard-admin');
    }
}
