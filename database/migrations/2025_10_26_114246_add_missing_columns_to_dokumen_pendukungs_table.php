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
        Schema::table('dokumen_pendukungs', function (Blueprint $table) {
            // Add missing columns that are used in the controller
            $table->string('jenis_dokumen')->nullable()->after('tipe_dokumen');
            $table->string('file_path')->nullable()->after('path_file');
            $table->string('file_name')->nullable()->after('file_path');
            $table->integer('file_size')->nullable()->after('file_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen_pendukungs', function (Blueprint $table) {
            $table->dropColumn(['jenis_dokumen', 'file_path', 'file_name', 'file_size']);
        });
    }
};
