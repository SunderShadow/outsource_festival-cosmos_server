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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();

            // Thumbnail
            $table->string('thumbnail_mobile')->nullable();
            $table->string('thumbnail_desktop')->nullable();
            $table->string('thumbnail_card')->nullable();

            // Slug
            $table->string('slug')->unique();

            // Main info
            $table->string('title')->unique();
            $table->string('phone')->nullable();
            $table->string('chef_name')->nullable();
            $table->string('min_cost')->nullable();
            $table->string('location')->nullable();
            $table->string('map_link')->comment('Example: https://some.external/site')->nullable();
            $table->string('external_website_link')->comment('Example: https://some.external/site')->nullable();
            $table->boolean('published')->default(false);
            $table->text('description')->nullable();

            // Worktime
            $table->string('open_time', 5)->comment('Format: HH:mm')->nullable();
            $table->string('close_time', 5)->comment('Format: HH:mm')->nullable();

            // Rating
            $table->unsignedTinyInteger('rating_atmosphere')->default(5)->nullable();
            $table->unsignedTinyInteger('rating_taste')->default(5)->nullable();
            $table->unsignedTinyInteger('rating_serving')->default(5)->nullable();
            $table->unsignedTinyInteger('rating_service')->default(5)->nullable();

            $table->boolean('verified')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
