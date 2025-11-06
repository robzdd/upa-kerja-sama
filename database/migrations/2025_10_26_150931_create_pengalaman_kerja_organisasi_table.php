<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengalaman_kerja_organisasi', function (Blueprint $table) {
            $table->id();
            
            // UUID untuk user_id (sesuai dengan users.id yang UUID)
            $table->uuid('user_id');
            
            $table->enum('type', ['organisasi', 'perusahaan']);
            $table->string('perusahaan_organisasi');
            $table->string('posisi');
            $table->date('mulai_kerja');
            $table->date('selesai_kerja')->nullable();
            $table->text('deskripsi_piri')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  
           
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengalaman_kerja_organisasi');
    }
};