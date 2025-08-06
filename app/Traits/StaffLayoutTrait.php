<?php

namespace App\Traits;

use App\Models\Staff;

trait StaffLayoutTrait
{
    /**
     * Get the appropriate layout based on staff role
     */
    protected function getStaffLayout($staffId = null): string
    {
        $staffId = $staffId ?? session('staff_id');
        
        if (!$staffId) {
            return 'components.layouts.dashboard-attraction'; // Default fallback
        }

        $staff = Staff::find($staffId);
        
        return match($staff->role ?? 'staff_attraction') {
            'staff_attraction' => 'components.layouts.dashboard-attraction',
            'staff_restaurant' => 'components.layouts.dashboard-restaurant',
            'admin' => 'components.layouts.dashboard-admin',
            default => 'components.layouts.dashboard-attraction' // Default to attraction layout
        };
    }
}
