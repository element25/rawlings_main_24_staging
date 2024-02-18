<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('study_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name');
            $table->string('colour')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order_column');
            $table->timestamps();
        });

        Schema::create('study_category', function (Blueprint $table) {
            $table->integer('study_id');
            $table->integer('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_category');
        Schema::dropIfExists('study_categories');
    }
};
