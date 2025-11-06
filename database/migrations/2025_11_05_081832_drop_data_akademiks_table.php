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
        Schema::dropIfExists('data_akademiks');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('data_akademiks', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->string('nim')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('universitas')->nullable();
            $table->year('tahun_masuk')->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};