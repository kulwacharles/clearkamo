<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('who_we_are', function (Blueprint $table) {
            $table->text('market_position_description')->nullable()->after('description');
            $table->string('market_position_image_path')->nullable()->after('secondary_image_path');
            $table->text('purpose_description')->nullable()->after('market_position_description');
            $table->string('purpose_image_path')->nullable()->after('market_position_image_path');
        });
    }

    public function down(): void
    {
        Schema::table('who_we_are', function (Blueprint $table) {
            $table->dropColumn([
                'market_position_description',
                'market_position_image_path',
                'purpose_description',
                'purpose_image_path',
            ]);
        });
    }
};
