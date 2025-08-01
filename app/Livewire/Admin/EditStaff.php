<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Staff;
use App\Models\Attraction;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EditStaff extends Component
{
    use WithFileUploads;

    public Staff $staff;
    public $name, $email, $password, $password_confirmation, $number, $location, $role;
    public $new_avatar;
    public $assignment_id = ''; // ID of the selected attraction or restaurant
    public $availableLocations = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|min:8|confirmed',
        'number' => 'required|string|max:20',
        'location' => 'required|string',
        'role' => 'required|in:admin,staff_restaurant,staff_attraction',
        'new_avatar' => 'nullable|image|max:1024',
        'assignment_id' => 'nullable|integer'
    ];

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->name = $staff->name;
        $this->email = $staff->email;
        $this->number = $staff->number;
        $this->location = $staff->location;
        $this->role = $staff->role;
        
        // Set current assignment based on role
        if ($staff->role === 'staff_restaurant' && $staff->restaurant) {
            $this->assignment_id = $staff->restaurant->id;
        } elseif ($staff->role === 'staff_attraction' && $staff->attraction) {
            $this->assignment_id = $staff->attraction->id;
        }
        
        $this->loadAvailableLocations();
    }
    
    public function loadAvailableLocations()
    {
        if ($this->role === 'staff_restaurant') {
            // Get restaurants without staff or currently assigned to this staff
            $this->availableLocations = Restaurant::whereNull('staff_id')
                ->orWhere('staff_id', $this->staff->id)
                ->get();
        } elseif ($this->role === 'staff_attraction') {
            // Get attractions without staff or currently assigned to this staff
            $this->availableLocations = Attraction::whereNull('staff_id')
                ->orWhere('staff_id', $this->staff->id)
                ->get();
        } else {
            $this->availableLocations = collect();
        }
    }
    
    public function updatedRole()
    {
        // When role changes, reset assignment and reload locations
        $this->assignment_id = '';
        $this->loadAvailableLocations();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $this->staff->id,
            'password' => 'nullable|min:8|confirmed',
            'number' => 'required|string|max:20',
            'location' => 'required|string',
            'role' => 'required|in:admin,staff_restaurant,staff_attraction',
            'new_avatar' => 'nullable|image|max:1024',
            'assignment_id' => 'nullable|integer'
        ]);

        // Validate assignment logic
        if ($this->assignment_id && $this->role !== 'admin') {
            if ($this->role === 'staff_attraction') {
                $attraction = Attraction::find($this->assignment_id);
                if (!$attraction) {
                    session()->flash('error', 'Wahana tidak ditemukan.');
                    return;
                }
                // Check if attraction is already assigned to another staff
                if ($attraction->staff_id && $attraction->staff_id !== $this->staff->id) {
                    session()->flash('error', 'Wahana sudah dikelola oleh staff lain.');
                    return;
                }
            } elseif ($this->role === 'staff_restaurant') {
                $restaurant = Restaurant::find($this->assignment_id);
                if (!$restaurant) {
                    session()->flash('error', 'Restoran tidak ditemukan.');
                    return;
                }
                // Check if restaurant is already assigned to another staff
                if ($restaurant->staff_id && $restaurant->staff_id !== $this->staff->id) {
                    session()->flash('error', 'Restoran sudah dikelola oleh staff lain.');
                    return;
                }
            }
        }

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

        // Handle assignment updates
        $this->updateAssignments();

        return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil diperbarui.');
    }
    
    private function updateAssignments()
    {
        // Remove current assignments
        if ($this->staff->attraction) {
            $this->staff->attraction->update(['staff_id' => null]);
        }
        if ($this->staff->restaurant) {
            $this->staff->restaurant->update(['staff_id' => null]);
        }
        
        // Set new assignment based on role and assignment_id
        if ($this->assignment_id && $this->role !== 'admin') {
            if ($this->role === 'staff_attraction') {
                Attraction::where('id', $this->assignment_id)->update(['staff_id' => $this->staff->id]);
            } elseif ($this->role === 'staff_restaurant') {
                Restaurant::where('id', $this->assignment_id)->update(['staff_id' => $this->staff->id]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.edit-staff')
            ->layout('components.layouts.dashboard-admin');
    }
}
