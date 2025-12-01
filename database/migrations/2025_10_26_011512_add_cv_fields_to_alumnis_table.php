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
        Schema::table('alumnis', function (Blueprint $table) {
            $table->text('pendidikan')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('keahlian')->nullable();
            $table->text('prestasi')->nullable();
            $table->text('organisasi')->nullable();
            $table->string('cv_uri')->nullable()->unique();
            $table->boolean('cv_public')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropColumn([
                'pendidikan',
                'pengalaman_kerja',
                'keahlian',
                'prestasi',
                'organisasi',
                'cv_uri',
                'cv_public'
            ]);
        });
    }
};
