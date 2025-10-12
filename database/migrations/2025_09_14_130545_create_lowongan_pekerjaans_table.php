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
        Schema::create('lowongan_pekerjaans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('mitra_id')->constrained('mitra_perusahaan')->onDelete('cascade');
            $table->string('judul');
            $table->string('posisi')->nullable();
            $table->text('deskripsi');
            $table->string('lokasi')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_pekerjaans');
    }
};
