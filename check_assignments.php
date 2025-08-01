<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== RESTAURANT ASSIGNMENTS ===\n";
$restaurants = App\Models\Restaurant::with('staff')->get();
foreach($restaurants as $restaurant) {
    $staffName = $restaurant->staff ? $restaurant->staff->name : 'No staff assigned';
    echo "{$restaurant->name} -> {$staffName}\n";
}

echo "\n=== ATTRACTION ASSIGNMENTS ===\n";
$attractions = App\Models\Attraction::with('staff')->get();
foreach($attractions as $attraction) {
    $staffName = $attraction->staff ? $attraction->staff->name : 'No staff assigned';
    echo "{$attraction->name} -> {$staffName}\n";
}

echo "\n=== STAFF SUMMARY ===\n";
echo "Restaurant staff: " . App\Models\Staff::where('role', 'staff_restaurant')->count() . "\n";
echo "Attraction staff: " . App\Models\Staff::where('role', 'staff_attraction')->count() . "\n";
echo "Total restaurants: " . App\Models\Restaurant::count() . "\n";
echo "Total attractions: " . App\Models\Attraction::count() . "\n";
