<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengalaman_sertifikasi', function (Blueprint $table) {
            $table->id();
            
            // UUID untuk user_id (sesuai dengan users.id yang UUID)
            $table->uuid('user_id');
            
            $table->string('nama_sertifikasi');
            $table->string('lembaga_sertifikasi');
            $table->date('mulai_berlaku');
            $table->date('selesai_berlaku')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Foreign key ke users.id (UUID)
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            // Index untuk performa
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengalaman_sertifikasi');
    }
};