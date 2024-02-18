<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('related_title');
            $table->string('html_title');
            $table->text('meta_desc');
            $table->text('brief');
            $table->text('approach');
            $table->text('result');
            $table->text('quote');
            $table->text('homepage_text');
            $table->text('study_list_text');
            $table->string('client')->nullable();
            $table->text('logo_html')->nullable();
            //            $table->string('image_hero')->nullable();
            //            $table->string('image_half_1')->nullable();
            //            $table->string('image_half_2')->nullable();
            //            $table->string('image_full_top')->nullable();
            //            $table->string('image_full_bottom')->nullable();
            $table->string('url')->nullable();
            //            $table->string('categories');
            $table->integer('order_column')->nullable();
            $table->integer('related')->nullable();
            $table->integer('article_1')->nullable();
            $table->integer('article_2')->nullable();
            $table->integer('article_3')->nullable();
            //            $table->integer('related_2')->nullable();
            //            $table->integer('related_3')->nullable();
            //            $table->foreignId('user_id')->constrained();
            $table->string('status'); //array_column(StudyStatus::cases(), 'value')
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('studies');
    }
};
