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
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
            $table->foreignId('staff_id')->nullable()->change()->constrained('staff')->onDelete('set null');
        });
        
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
            $table->foreignId('staff_id')->nullable()->change()->constrained('staff')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
            $table->foreignId('staff_id')->change()->constrained('staff')->onDelete('cascade');
        });
        
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
            $table->foreignId('staff_id')->change()->constrained('staff')->onDelete('cascade');
        });
    }
};
