<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->ulid('id')->primary();

            // Guest Info (No User Relation)
            $table->string('guest_name');
            $table->string('guest_email');
            $table->string('guest_whatsapp');
            $table->string('company_name')->nullable();

            // Relasi ke space
            $table->foreignId('space_id')->constrained()->cascadeOnDelete();

            // Booking Details
            $table->date('booking_date');       // e.g., 2025-12-24
            $table->time('start_time');         // e.g., 13:00
            $table->dateTime('end_time');       // Keep this for backend logic overlap checks
            $table->integer('duration');        // e.g., 2
            $table->string('duration_unit');    // e.g., 'hour', 'day', 'month'
            $table->integer('total_guests');    // Number of people

            $table->decimal('total_price', 12, 2);

            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
