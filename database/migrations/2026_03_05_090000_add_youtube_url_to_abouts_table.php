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
        if (!Schema::hasTable('abouts') || Schema::hasColumn('abouts', 'youtube_url')) {
            return;
        }

        Schema::table('abouts', function (Blueprint $table) {
            $table->string('youtube_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('abouts') || !Schema::hasColumn('abouts', 'youtube_url')) {
            return;
        }

        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn('youtube_url');
        });
    }
};
