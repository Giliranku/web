<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateInvoiceTicketsQuantitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing invoice_tickets records to have default quantity values
        DB::table('invoice_tickets')
            ->whereNull('quantity')
            ->orWhere('quantity', 0)
            ->update([
                'quantity' => 5, // Set default quantity to 5 for existing records
                'used_quantity' => 0 // Set used_quantity to 0 for existing records
            ]);
    }
}
