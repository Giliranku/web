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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // Nomor tiket bantuan
            $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade'); // Staff yang membuat keluhan
            $table->string('subject'); // Subjek keluhan
            $table->text('description'); // Deskripsi keluhan
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // Prioritas
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open'); // Status tiket
            $table->text('admin_response')->nullable(); // Respon dari admin
            $table->timestamp('responded_at')->nullable(); // Kapan admin merespon
            $table->foreignId('responded_by')->nullable()->constrained('staff')->onDelete('set null'); // Admin yang merespon
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
