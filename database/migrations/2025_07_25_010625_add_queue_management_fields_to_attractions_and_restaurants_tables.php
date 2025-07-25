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
        // Add new fields to attractions table
        Schema::table('attractions', function (Blueprint $table) {
            $table->integer('players_per_round')->default(1)->after('time_estimation');
            $table->integer('estimated_time_per_round')->default(10)->after('players_per_round'); // in minutes
        });

        // Add new fields to restaurants table
        Schema::table('restaurants', function (Blueprint $table) {
            $table->integer('players_per_round')->default(1)->after('time_estimation');
            $table->integer('estimated_time_per_round')->default(30)->after('players_per_round'); // in minutes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropColumn(['players_per_round', 'estimated_time_per_round']);
        });

        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['players_per_round', 'estimated_time_per_round']);
        });
    }
};
