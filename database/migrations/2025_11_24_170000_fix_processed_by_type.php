<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable foreign key constraints to avoid errors during drop
        Schema::disableForeignKeyConstraints();

        try {
            // Try to drop the foreign key explicitly using raw SQL if the array syntax failed
            DB::statement('ALTER TABLE mitra_registration_requests DROP FOREIGN KEY mitra_registration_requests_processed_by_foreign');
        } catch (\Exception $e) {
            // Ignore if FK doesn't exist
        }

        Schema::table('mitra_registration_requests', function (Blueprint $table) {
            // Drop the column if it exists
            $table->dropColumn('processed_by');
        });

        Schema::table('mitra_registration_requests', function (Blueprint $table) {
            // Re-add as UUID foreign key matching users.id
            $table->foreignUuid('processed_by')->nullable()->constrained('users')->nullOnDelete();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mitra_registration_requests', function (Blueprint $table) {
            $table->dropForeign(['processed_by']);
            $table->dropColumn('processed_by');
            // Revert back to uuid column (if needed)
            $table->uuid('processed_by')->nullable();
            $table->foreign('processed_by')->references('id')->on('users')->nullOnDelete();
        });
    }
};
