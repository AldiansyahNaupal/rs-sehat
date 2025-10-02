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
        Schema::create('health_checks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('age');
            $table->enum('gender', ['male', 'female']);
            $table->decimal('height', 5, 2); // dalam cm
            $table->decimal('weight', 5, 2); // dalam kg
            $table->decimal('bmi', 4, 2)->nullable();
            $table->json('symptoms'); // array gejala yang dipilih
            $table->json('lifestyle'); // data gaya hidup
            $table->json('medical_history'); // riwayat medis
            $table->integer('stress_level')->default(1); // 1-10
            $table->integer('sleep_hours')->default(8); // jam tidur per hari
            $table->enum('exercise_frequency', ['never', 'rarely', 'sometimes', 'often', 'daily'])->default('sometimes');
            $table->enum('smoking_status', ['never', 'former', 'current'])->default('never');
            $table->enum('alcohol_consumption', ['never', 'rarely', 'moderate', 'heavy'])->default('never');
            $table->text('recommendations')->nullable(); // rekomendasi hasil
            $table->enum('risk_level', ['low', 'moderate', 'high'])->nullable(); // tingkat risiko
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_checks');
    }
};
