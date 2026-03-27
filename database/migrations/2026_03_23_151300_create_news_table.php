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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail_mobile')->nullable();
            $table->string('thumbnail_desktop')->nullable();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->tinyText('excerpt');
            $table->json('social_links')->comment('[{href: string, icon: string}]')->nullable();
            $table->text('body')->comment('Основной контент')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
