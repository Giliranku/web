<?php
require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

use App\Models\User;
use App\Models\Invoice;

try {
    $user = User::first();
    echo "User found: " . $user->name . "\n";
    
    $invoice = Invoice::create([
        'user_id' => $user->id,
        'total_price' => 100000,
        'payment_method' => 'mastercard',
        'status' => 'paid'
    ]);
    
    echo "Invoice created successfully!\n";
    echo "ID: " . $invoice->id . "\n";
    echo "Invoice Number: " . $invoice->invoice_number . "\n";
    echo "Status: " . $invoice->status . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
