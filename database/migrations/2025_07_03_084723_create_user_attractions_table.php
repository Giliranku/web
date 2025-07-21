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
        Schema::create('user_attractions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('attraction_id')->constrained('attractions')->onDelete('cascade');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->integer('slot_number');
            $table->integer('queue_position')->nullable();
            $table->date('reservation_date');
            $table->time('reservation_time')->nullable();
            $table->enum('status', ['waiting', 'called', 'served', 'cancelled'])->default('waiting');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->index(['attraction_id', 'reservation_date', 'queue_position'], 'user_attractions_queue_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_attractions');
    }
};
