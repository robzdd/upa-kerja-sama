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
        Schema::create('dokumen_pendukungs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('alumni_id')->constrained('alumnis')->onDelete('cascade');
            $table->string('tipe_dokumen'); // ijazah, transkrip, sertifikat, dll
            $table->string('nama_dokumen');
            $table->string('path_file');
            $table->integer('ukuran_file'); // dalam byte
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pendukungs');
    }
};
