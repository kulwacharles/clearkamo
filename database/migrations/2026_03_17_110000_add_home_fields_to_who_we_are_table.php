<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('who_we_are')) {
            return;
        }

        Schema::table('who_we_are', function (Blueprint $table) {
            if (!Schema::hasColumn('who_we_are', 'secondary_image_path')) {
                $table->string('secondary_image_path')->nullable()->after('image_path');
            }
            if (!Schema::hasColumn('who_we_are', 'years_of_experience')) {
                $table->unsignedInteger('years_of_experience')->nullable()->after('secondary_image_path');
            }
            if (!Schema::hasColumn('who_we_are', 'youtube_url')) {
                $table->string('youtube_url')->nullable()->after('years_of_experience');
            }
        });

        if (!Schema::hasTable('abouts')) {
            return;
        }

        if (DB::table('who_we_are')->exists()) {
            return;
        }

        $about = DB::table('abouts')->orderBy('id')->first();
        if (!$about) {
            return;
        }

        DB::table('who_we_are')->insert([
            'title' => $about->title ?? 'Who We Are',
            'description' => $about->description ?? '',
            'image_path' => $about->image ?? null,
            'secondary_image_path' => $about->image2 ?? null,
            'years_of_experience' => $about->ex_years ?? 0,
            'youtube_url' => (Schema::hasColumn('abouts', 'youtube_url') ? ($about->youtube_url ?? null) : null),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        if (!Schema::hasTable('who_we_are')) {
            return;
        }

        Schema::table('who_we_are', function (Blueprint $table) {
            if (Schema::hasColumn('who_we_are', 'youtube_url')) {
                $table->dropColumn('youtube_url');
            }
            if (Schema::hasColumn('who_we_are', 'years_of_experience')) {
                $table->dropColumn('years_of_experience');
            }
            if (Schema::hasColumn('who_we_are', 'secondary_image_path')) {
                $table->dropColumn('secondary_image_path');
            }
        });
    }
};

