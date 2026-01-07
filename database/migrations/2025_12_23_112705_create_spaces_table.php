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
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type'); // meeting_room, office_space, event_space, hot_desk
            $table->integer('capacity');
            $table->string('dimensions')->nullable();
            $table->string('location')->default('Jakarta');
            $table->string('sub_location')->nullable(); // North, South, etc.

            // Pricing (Nullable because not all spaces have all rates)
            $table->decimal('price_hourly', 10, 2)->nullable();
            $table->decimal('price_daily', 10, 2)->nullable();
            $table->decimal('price_weekly', 10, 2)->nullable();
            $table->decimal('price_monthly', 10, 2)->nullable();

            $table->text('amenities')->nullable(); // JSON or comma-separated
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
