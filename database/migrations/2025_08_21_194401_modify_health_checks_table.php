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
        Schema::table('health_checks', function (Blueprint $table) {
            // Drop unused columns
            $table->dropColumn(['lifestyle', 'medical_history']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('health_checks', function (Blueprint $table) {
            // Restore the dropped columns
            $table->json('lifestyle')->nullable();
            $table->json('medical_history')->nullable();
        });
    }
};
