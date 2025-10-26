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
        Schema::table('data_akademiks', function (Blueprint $table) {
            $table->text('hard_skill')->nullable()->after('universitas');
            $table->text('soft_skill')->nullable()->after('hard_skill');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_akademiks', function (Blueprint $table) {
            $table->dropColumn(['hard_skill', 'soft_skill']);
        });
    }
};
