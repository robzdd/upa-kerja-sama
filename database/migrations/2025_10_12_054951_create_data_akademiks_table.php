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
        Schema::create('data_akademiks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('alumni_id')->constrained('alumnis')->onDelete('cascade');
            $table->string('nim')->nullable();
            $table->string('program_studi')->nullable();
            $table->integer('tahun_masuk')->nullable();
            $table->integer('tahun_lulus')->nullable();
            $table->float('ipk', 3, 2)->nullable();
            $table->string('universitas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_akademiks');
    }
};
