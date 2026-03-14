<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('core_values', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('summary');
            $table->text('details')->nullable();
            $table->string('icon')->nullable()->default('fa-star');
            $table->string('image')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('core_values');
    }
};
