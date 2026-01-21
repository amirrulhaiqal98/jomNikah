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
        Schema::table('users', function (Blueprint $table) {
            // CRITICAL SECURITY: Use restrict (not cascade) to prevent accidental user deletion
            // If wedding is deleted, user account should remain intact
            $table->foreignId('wedding_id')->nullable()->constrained()->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['wedding_id']);
            $table->dropColumn('wedding_id');
        });
    }
};
