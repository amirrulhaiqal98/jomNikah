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
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->string('subdomain')->nullable()->unique(); // For future Story 2.2
            $table->enum('package_tier', ['standard', 'premium'])->default('standard'); // For future Story 1.3
            $table->boolean('wish_present_enabled')->default(false); // For future Story 1.4
            $table->boolean('digital_ang_pow_enabled')->default(false); // For future Story 1.4
            $table->string('bride_name')->nullable(); // For future Story 2.4
            $table->string('groom_name')->nullable(); // For future Story 2.4
            $table->dateTime('wedding_date')->nullable(); // For future Story 2.4
            $table->string('venue')->nullable(); // For future Story 2.4
            $table->string('template')->nullable(); // For future Story 2.3
            $table->unsignedInteger('setup_progress')->default(0); // For future Story 2.6
            $table->timestamps();

            // CRITICAL: Multi-tenancy - all future tables will have wedding_id foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
