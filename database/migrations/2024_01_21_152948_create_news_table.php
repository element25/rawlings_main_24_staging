<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('summary');
            $table->longText('content')->nullable();
            $table->longText('content_2017')->nullable();
            $table->string('slug');
            $table->string('html_title');
            $table->text('meta_desc');
            $table->string('related_1')->nullable();
            $table->string('related_2')->nullable();
            $table->integer('image_hero')->nullable();
            $table->text('image_index')->nullable();
            $table->string('status');
            $table->date('published_at')->nullable();
            $table->smallInteger('version');
            $table->foreignId('user_id');
            $table->integer('order_column')->nullable();
            $table->timestamps();
        });

        Schema::create('news_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('icon');
        });

        Schema::create('news_category', function (Blueprint $table) {
            $table->integer('news_id');
            $table->integer('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_category');
        Schema::dropIfExists('news_categories');
        Schema::dropIfExists('news');
    }
};
