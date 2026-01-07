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
        Schema::table('spaces', function (Blueprint $table) {
            $table->decimal('price_3_hours', 10, 2)->nullable()->after('price_hourly');
            $table->decimal('price_6_hours', 10, 2)->nullable()->after('price_3_hours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spaces', function (Blueprint $table) {
            $table->dropColumn(['price_3_hours', 'price_6_hours']);
        });
    }
};
