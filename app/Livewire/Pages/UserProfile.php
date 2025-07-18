<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $number;
    public $location;
    public $avatar;
    public $newAvatar;
    public $uploading = false;
    public function mount()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login'); // jika belum login
        }

        $this->name = $user->name;
        $this->email = $user->email;
        $this->number = $user->number;
        $this->location = $user->location;
        $this->avatar = $user->avatar;
    }
    public function updateProfile()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required|digits_between:10,12|regex:/^[0-9]+$/',
            'location' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'number' => $this->number,
            'location' => $this->location,
        ]);

        session()->flash('message', 'Profil berhasil diperbarui!');
    }

    public function updatedNewAvatar()
    {
        // Auto upload when file is selected
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

            $user = Auth::user();

            // Delete old avatar if exists and not from Google
            if ($user->avatar && !str_contains($user->avatar, 'googleusercontent.com') && !str_contains($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $path = $this->newAvatar->store('avatars', 'public');
            
            $user->update([
                'avatar' => $path
            ]);

            $this->avatar = $path;
            
            session()->flash('message', 'Foto profil berhasil diperbarui!');
            
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
        return view('livewire.pages.user-profile');
    }
}
