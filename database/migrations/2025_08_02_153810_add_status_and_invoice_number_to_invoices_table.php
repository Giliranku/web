<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Add status column if it doesn't exist
            if (!Schema::hasColumn('invoices', 'status')) {
                $table->enum('status', ['pending', 'paid', 'cancelled', 'refunded'])
                      ->default('pending')
                      ->after('total_price');
            }
            
            // Add invoice_number column if it doesn't exist
            if (!Schema::hasColumn('invoices', 'invoice_number')) {
                $table->string('invoice_number')
                      ->unique()
                      ->nullable()
                      ->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['status', 'invoice_number']);
        });
    }
};