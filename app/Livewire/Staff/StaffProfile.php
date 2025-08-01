<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Staff;
use App\Models\UserAttraction;
use App\Models\UserRestaurant;

class StaffProfile extends Component
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
    
    // Staff info
    public $staff;
    public $location;
    public $type; // 'attraction' or 'restaurant'
    
    // Stats
    public $todayQueue;
    public $totalServed;
    public $totalWaiting;
    public $totalCancelled;
    
    public function mount()
    {
        $staffId = session('staff_id');
        if (!$staffId || !in_array(session('staff_role'), ['staff_restaurant', 'staff_attraction'])) {
            return redirect('/admin/login')->with('error', 'Silakan login sebagai staff terlebih dahulu.');
        }

        $this->staff = Staff::find($staffId);
        if (!$this->staff) {
            return redirect('/admin/login')->with('error', 'Data staff tidak ditemukan.');
        }

        $this->name = $this->staff->name;
        $this->email = $this->staff->email;
        $this->avatar = $this->staff->avatar;
        
        // Determine staff type and location
        if ($this->staff->attraction) {
            $this->type = 'attraction';
            $this->location = $this->staff->attraction;
        } elseif ($this->staff->restaurant) {
            $this->type = 'restaurant';
            $this->location = $this->staff->restaurant;
        }
        
        $this->loadStats();
    }

    public function loadStats()
    {
        if ($this->type === 'attraction') {
            $this->todayQueue = UserAttraction::where('attraction_id', $this->location->id)
                ->forDate(today())
                ->count();
            $this->totalWaiting = UserAttraction::where('attraction_id', $this->location->id)
                ->forDate(today())
                ->waiting()
                ->count();
            $this->totalServed = UserAttraction::where('attraction_id', $this->location->id)
                ->forDate(today())
                ->where('status', 'served')
                ->count();
            $this->totalCancelled = UserAttraction::where('attraction_id', $this->location->id)
                ->forDate(today())
                ->where('status', 'cancelled')
                ->count();
        } else {
            $this->todayQueue = UserRestaurant::where('restaurant_id', $this->location->id)
                ->forDate(today())
                ->count();
            $this->totalWaiting = UserRestaurant::where('restaurant_id', $this->location->id)
                ->forDate(today())
                ->waiting()
                ->count();
            $this->totalServed = UserRestaurant::where('restaurant_id', $this->location->id)
                ->forDate(today())
                ->where('status', 'served')
                ->count();
            $this->totalCancelled = UserRestaurant::where('restaurant_id', $this->location->id)
                ->forDate(today())
                ->where('status', 'cancelled')
                ->count();
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $this->staff->id,
        ]);

        $this->staff->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Profil staff berhasil diperbarui!');
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $this->staff->update([
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

            if ($this->staff->avatar && !str_contains($this->staff->avatar, 'http')) {
                Storage::disk('public')->delete($this->staff->avatar);
            }

            $path = $this->newAvatar->store('avatars/staff', 'public');
            
            $this->staff->update(['avatar' => $path]);
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
        $layoutComponent = $this->type === 'attraction' 
            ? 'components.layouts.dashboard-attraction' 
            : 'components.layouts.dashboard-restaurant';
            
        return view('livewire.staff.staff-profile')
            ->layout($layoutComponent);
    }
}
