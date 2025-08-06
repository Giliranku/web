<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

use App\Traits\StaffLayoutTrait;
use App\Models\Staff;

class TestTraitClass 
{
    use StaffLayoutTrait;
    
    public function testLayout($staffId) 
    {
        return $this->getStaffLayout($staffId);
    }
}

$test = new TestTraitClass();

// Test restaurant staff
echo "Restaurant Staff (ID 3) Layout: " . $test->testLayout(3) . PHP_EOL;

// Test attraction staff (need to find one)
$attractionStaff = Staff::where('role', 'staff_attraction')->first();
if ($attractionStaff) {
    echo "Attraction Staff (ID {$attractionStaff->id}) Layout: " . $test->testLayout($attractionStaff->id) . PHP_EOL;
} else {
    echo "No attraction staff found" . PHP_EOL;
}

// Test admin
echo "Admin Staff (ID 1) Layout: " . $test->testLayout(1) . PHP_EOL;
