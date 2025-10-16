<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('mitra_perusahaan', function (Blueprint $table) {
            if (!Schema::hasColumn('mitra_perusahaan', 'alamat')) {
                $table->text('alamat')->nullable()->after('tautan');
            }
            if (!Schema::hasColumn('mitra_perusahaan', 'tentang')) {
                $table->longText('tentang')->nullable()->after('alamat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mitra_perusahaan', function (Blueprint $table) {
            if (Schema::hasColumn('mitra_perusahaan', 'tentang')) {
                $table->dropColumn('tentang');
            }
            if (Schema::hasColumn('mitra_perusahaan', 'alamat')) {
                $table->dropColumn('alamat');
            }
        });
    }
};


