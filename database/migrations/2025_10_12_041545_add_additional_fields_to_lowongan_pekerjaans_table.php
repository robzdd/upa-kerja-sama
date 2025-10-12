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
        Schema::table('lowongan_pekerjaans', function (Blueprint $table) {
            $table->string('jenis_pekerjaan')->nullable(); // Full-time, Part-time, Contract, etc.
            $table->string('jenjang_pendidikan')->nullable(); // D3, D4, S1, etc.
            $table->json('jurusan_diizinkan')->nullable(); // Array of allowed majors
            $table->json('persyaratan_dokumen')->nullable(); // Array of required documents
            $table->text('rincian_lowongan')->nullable(); // Detailed job description
            $table->integer('jumlah_pelamar')->default(0); // Number of applicants
            $table->boolean('status_aktif')->default(true); // Active status
            $table->date('tanggal_penerimaan_lamaran')->nullable(); // Application deadline
            $table->date('tanggal_pengumuman')->nullable(); // Announcement date
            $table->string('gaji_min')->nullable(); // Minimum salary
            $table->string('gaji_max')->nullable(); // Maximum salary
            $table->string('pengalaman_minimal')->nullable(); // Minimum experience
            $table->json('skill_required')->nullable(); // Required skills
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lowongan_pekerjaans', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_pekerjaan',
                'jenjang_pendidikan',
                'jurusan_diizinkan',
                'persyaratan_dokumen',
                'rincian_lowongan',
                'jumlah_pelamar',
                'status_aktif',
                'tanggal_penerimaan_lamaran',
                'tanggal_pengumuman',
                'gaji_min',
                'gaji_max',
                'pengalaman_minimal',
                'skill_required'
            ]);
        });
    }
};
