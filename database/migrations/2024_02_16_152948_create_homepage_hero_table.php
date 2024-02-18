<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_hero', function (Blueprint $table) {
            $table->text('central_block_text');
            $table->text('central_block_link_text');
            $table->text('central_block_link_url');
            $table->text('left_block_text');
            $table->text('left_block_link_text');
            $table->text('left_block_text_link_url');
            $table->text('top_middle_block_text');
            $table->text('top_middle_block_link_text');
            $table->text('top_middle_block_link_url');
            $table->text('top_right_block_text');
            $table->text('top_right_block_link_text');
            $table->text('top_right_block_link_url');
            $table->text('bottom_right_block_text');
            $table->text('bottom_right_block_link_text');
            $table->text('bottom_right_block_link_url');
            $table->text('bottom_middle_block_text');
            $table->text('bottom_middle_block_link_text');
            $table->text('bottom_middle_block_link_url');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_hero');
    }
};
