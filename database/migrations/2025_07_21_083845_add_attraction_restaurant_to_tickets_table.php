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
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('attraction_id')->nullable()->constrained('attractions')->onDelete('cascade');
            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['attraction_id']);
            $table->dropForeign(['restaurant_id']);
            $table->dropColumn(['attraction_id', 'restaurant_id']);
        });
    }
};
