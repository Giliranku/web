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
        // Add fast pass fields to tickets table
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum('ticket_type', ['regular', 'fast_pass'])->default('regular')->after('location');
            $table->decimal('fast_pass_price_multiplier', 3, 2)->default(1.00)->after('ticket_type');
            // Multiplier for fast pass pricing (e.g., 1.5 = 150% of regular price)
        });

        // Add priority fields to user_attractions table
        Schema::table('user_attractions', function (Blueprint $table) {
            $table->boolean('is_fast_pass')->default(false)->after('status');
            $table->integer('priority_level')->default(2)->after('is_fast_pass'); 
            // 1 = Fast Pass Priority, 2 = Regular Priority
        });

        // Add priority fields to user_restaurants table  
        Schema::table('user_restaurants', function (Blueprint $table) {
            $table->boolean('is_fast_pass')->default(false)->after('status');
            $table->integer('priority_level')->default(2)->after('is_fast_pass');
            // 1 = Fast Pass Priority, 2 = Regular Priority
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['ticket_type', 'fast_pass_price_multiplier']);
        });

        Schema::table('user_attractions', function (Blueprint $table) {
            $table->dropColumn(['is_fast_pass', 'priority_level']);
        });

        Schema::table('user_restaurants', function (Blueprint $table) {
            $table->dropColumn(['is_fast_pass', 'priority_level']);
        });
    }
};
