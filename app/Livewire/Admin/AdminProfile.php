<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Staff;
use App\Models\Ticket;
use App\Models\Invoice;
use App\Models\Attraction;
use App\Models\Restaurant;

class AdminProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $avatar;
    public $newAvatar;
    public $uploading = false;
    public $activeTab = 'profile';
    
    // Stats
    public $totalUsers;
    public $totalStaff;
    public $totalTickets;
    public $totalRevenue;
    public $totalAttractions;
    public $totalRestaurants;
    
    public function mount()
    {
        // Check session-based admin authentication
        if (!session('staff_id') || session('staff_role') !== 'admin') {
            return redirect('/admin/login')->with('error', 'Silakan login sebagai admin terlebih dahulu.');
        }

        // Get admin data from Staff model using session
        $admin = Staff::find(session('staff_id'));
        if (!$admin) {
            return redirect('/admin/login')->with('error', 'Data admin tidak ditemukan.');
        }

        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->avatar = $admin->avatar ?? null;
        
        // Load statistics
        $this->loadStats();
    }

    public function loadStats()
    {
        // Count regular users (customers) - all users in users table are customers
        $this->totalUsers = User::count();
        
        // Count staff (admin + staff) from staff table
        $this->totalStaff = Staff::count();
        
        $this->totalTickets = Ticket::count();
        $this->totalRevenue = Invoice::where('status', 'paid')->sum('total_price');
        $this->totalAttractions = Attraction::count();
        $this->totalRestaurants = Restaurant::count();
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . session('staff_id'),
        ]);

        $admin = Staff::find(session('staff_id'));
        if (!$admin) {
            session()->flash('error', 'Data admin tidak ditemukan.');
            return;
        }

        $admin->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Update session data
        session(['staff_name' => $this->name, 'staff_email' => $this->email]);

        session()->flash('message', 'Profil admin berhasil diperbarui!');
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = Staff::find(session('staff_id'));
        if (!$admin) {
            session()->flash('error', 'Data admin tidak ditemukan.');
            return;
        }

        $admin->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['password', 'password_confirmation']);
        session()->flash('message', 'Password berhasil diperbarui!');
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

            $admin = Staff::find(session('staff_id'));
            if (!$admin) {
                session()->flash('error', 'Data admin tidak ditemukan.');
                return;
            }

            if ($admin->avatar && !str_contains($admin->avatar, 'http')) {
                Storage::disk('public')->delete($admin->avatar);
            }

            $path = $this->newAvatar->store('avatars/admin', 'public');
            
            $admin->update(['avatar' => $path]);
            $this->avatar = $path;
            
            session()->flash('message', 'Foto profil berhasil diperbarui!');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal mengupload foto: ' . $e->getMessage());
        } finally {
            $this->uploading = false;
            $this->reset('newAvatar');
        }
    }
    
    public function render()
    {
        return view('livewire.admin.admin-profile')
            ->layout('components.layouts.dashboard-admin');
    }
}
