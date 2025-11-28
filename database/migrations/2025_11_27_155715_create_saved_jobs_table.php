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
        Schema::create('saved_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('alumni_id')->constrained('alumnis')->onDelete('cascade');
            $table->foreignUuid('lowongan_pekerjaan_id')->constrained('lowongan_pekerjaans')->onDelete('cascade');
            $table->timestamps();

            // Prevent duplicate saves
            $table->unique(['alumni_id', 'lowongan_pekerjaan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_jobs');
    }
};
