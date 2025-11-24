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
        Schema::create('kategori_dokumen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('icon')->nullable(); // Font Awesome icon name
            $table->string('color')->default('blue'); // Color for badge/card
            $table->integer('urutan')->default(0); // For ordering
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_dokumen');
    }
};
