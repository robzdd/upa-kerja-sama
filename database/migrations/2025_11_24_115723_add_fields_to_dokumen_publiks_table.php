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
        Schema::table('dokumen_publiks', function (Blueprint $table) {
            $table->foreignUuid('kategori_dokumen_id')->nullable()->after('user_id')->constrained('kategori_dokumen')->nullOnDelete();
            $table->text('deskripsi')->nullable()->after('judul');
            $table->string('file_type', 10)->nullable()->after('file_path'); // PDF, XLS, XLSX
            $table->unsignedBigInteger('file_size')->nullable()->after('file_type'); // in bytes
            $table->unsignedInteger('download_count')->default(0)->after('file_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen_publiks', function (Blueprint $table) {
            $table->dropForeign(['kategori_dokumen_id']);
            $table->dropColumn(['kategori_dokumen_id', 'deskripsi', 'file_type', 'file_size', 'download_count']);
        });
    }
};
