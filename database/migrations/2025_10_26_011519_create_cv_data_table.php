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
        Schema::create('cv_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('alumni_id');
            $table->string('tipe_data'); // pendidikan, pengalaman, keahlian, prestasi, organisasi
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('periode')->nullable(); // untuk pendidikan dan pengalaman
            $table->string('instansi')->nullable(); // untuk pendidikan dan pengalaman
            $table->json('metadata')->nullable(); // untuk data tambahan
            $table->integer('urutan')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('alumni_id')->references('id')->on('alumnis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_data');
    }
};
