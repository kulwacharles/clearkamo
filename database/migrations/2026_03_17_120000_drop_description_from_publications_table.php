<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('publications') || !Schema::hasColumn('publications', 'description')) {
            return;
        }

        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('publications') || Schema::hasColumn('publications', 'description')) {
            return;
        }

        Schema::table('publications', function (Blueprint $table) {
            $table->longText('description')->nullable();
        });
    }
};

