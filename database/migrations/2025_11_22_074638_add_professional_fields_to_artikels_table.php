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
        Schema::table('artikels', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('judul');
            $table->text('excerpt')->nullable()->after('slug');
            $table->string('meta_description')->nullable()->after('excerpt');
            $table->json('tags')->nullable()->after('meta_description');
            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft')->after('tags');
            $table->timestamp('published_at')->nullable()->after('status');
            $table->integer('reading_time')->nullable()->after('published_at'); // in minutes
            $table->boolean('is_featured')->default(false)->after('reading_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'excerpt',
                'meta_description',
                'tags',
                'status',
                'published_at',
                'reading_time',
                'is_featured'
            ]);
        });
    }
};
