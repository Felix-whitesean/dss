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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique(); // Added unique for security
            $table->string('password'); // Hashed case password

            // Personal Info
            $table->string('fullname')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->default('other');
            $table->string('age_range')->nullable();

            // Contact Info (Grouped logic in form)
            $table->string('phone_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('guardian_phone_number')->nullable();

            // Identification
            $table->string('national_id')->nullable();
            $table->string('passport_number')->nullable();

            // Incident Details
            $table->string('tfgbv_type')->nullable();
            $table->string('platform_of_abuse')->nullable();
            $table->string('new_platform_name')->nullable();
            $table->string('evidence_url')->nullable();
            $table->text('description')->nullable();

            // Perpetrator Info
            $table->string('relationship_with_perpetrator');

            // Location & Needs
            $table->string('disability_status')->nullable();

            // Actions & Evidence
            $table->string('report_to_police')->nullable();
            $table->string('recommend_counselling')->nullable();
            $table->string('evidence_of_abuse')->nullable(); // Path to file if uploaded

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
