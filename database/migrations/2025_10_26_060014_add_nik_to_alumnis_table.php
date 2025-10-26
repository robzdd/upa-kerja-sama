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
        // Only add nik column if it doesn't exist
        if (!Schema::hasColumn('alumnis', 'nik')) {
            Schema::table('alumnis', function (Blueprint $table) {
                $table->string('nik')->nullable()->after('nim');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropColumn('nik');
        });
    }
};
