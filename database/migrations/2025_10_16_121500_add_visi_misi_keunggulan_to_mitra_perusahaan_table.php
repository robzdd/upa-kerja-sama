<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('mitra_perusahaan', function (Blueprint $table) {
            if (!Schema::hasColumn('mitra_perusahaan', 'visi')) {
                $table->longText('visi')->nullable()->after('tentang');
            }
            if (!Schema::hasColumn('mitra_perusahaan', 'misi')) {
                $table->longText('misi')->nullable()->after('visi');
            }
            if (!Schema::hasColumn('mitra_perusahaan', 'keunggulan')) {
                $table->json('keunggulan')->nullable()->after('misi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mitra_perusahaan', function (Blueprint $table) {
            if (Schema::hasColumn('mitra_perusahaan', 'keunggulan')) {
                $table->dropColumn('keunggulan');
            }
            if (Schema::hasColumn('mitra_perusahaan', 'misi')) {
                $table->dropColumn('misi');
            }
            if (Schema::hasColumn('mitra_perusahaan', 'visi')) {
                $table->dropColumn('visi');
            }
        });
    }
};


