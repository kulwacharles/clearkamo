<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_visits', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable()->index();
            $table->string('ip_address', 64)->nullable()->index();
            $table->string('path')->index();
            $table->string('referrer')->nullable();
            $table->string('month_key', 7)->index();
            $table->date('day')->index();
            $table->timestamp('visited_at')->index();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_visits');
    }
};
