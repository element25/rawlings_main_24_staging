<?php

namespace App\Console\Commands\Migrate;

use App\Models\HomepageHero;
use Illuminate\Console\Command;

class MigrateHomepageHero extends Command
{
    protected $signature = 'migrate:homepage-hero';

    protected $description = 'Migrate the text and images for the homepage hero block';

    public function handle(): void
    {
        HomepageHero::truncate();

        HomepageHero::create([
            'central_block_text' => '', 'central_block_link_text' => '', 'central_block_link_url' => '',
            'left_block_text' => '', 'left_block_link_text' => '', 'left_block_text_link_url' => '',
            'top_middle_block_text' => '', 'top_middle_block_link_text' => '', 'top_middle_block_link_url' => '',
            'top_right_block_text' => '', 'top_right_block_link_text' => '', 'top_right_block_link_url' => '',
            'bottom_right_block_text' => '', 'bottom_right_block_link_text' => '', 'bottom_right_block_link_url' => '',
            'bottom_middle_block_text' => '', 'bottom_middle_block_link_text' => '', 'bottom_middle_block_link_url' => '',
        ]);

    }
}
